<?php
session_start();
include 'connect.php';

// 🔴 Login check
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    echo "<script>
        alert('Please login first!');
        window.location.href='login.php?role=user';
    </script>";
    exit;
}

$email = $_SESSION['email'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // 🔹 All form data
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
   $persons = intval($_POST['persons'] ?? 0);

$days = intval($_POST['days'] ?? 0);

$distance = intval($_POST['distance'] ?? 0);

$amount = floatval($_POST['amount'] ?? 0);
    $from = $_POST['from'];
    $to = $_POST['to'];
     $method = $_POST['method'];
    $package_id = $_POST['package_id'] ?? '';
    $hotel = $_POST['hotel'] ?? '';
    $checkin = $_POST['checkin'] ?? '';
$checkout = $_POST['checkout'] ?? '';
$checkin_sql = !empty($checkin) ? "'$checkin'" : "NULL";
$checkout_sql = !empty($checkout) ? "'$checkout'" : "NULL";

    // 🔹 Fake transaction ID
    $txn = "TXN" . rand(100000,999999);

    // 🔒 Secure values
    $email_safe = mysqli_real_escape_string($conn, $email);
  $package_id_safe = !empty($package_id)
? intval($package_id)
: NULL;
    // 🔹 Insert (simple version)
 if(!empty($hotel) || !empty($package_id)){

   $hotel_safe = mysqli_real_escape_string($conn, $hotel);
$sql = "INSERT INTO bookings
(
email,
package_id,
hotel_name,
persons,
total_days,
amount,
checkin_date,
checkout_date
)
VALUES
(
'$email_safe',
" . ($package_id_safe === NULL ? "NULL" : $package_id_safe) . ",
'$hotel_safe',
'$persons',
'$days',
'$amount',
$checkin_sql,
$checkout_sql
)";

    $conn->query($sql);
}

if(isset($_POST['type']) && !empty($from) && !empty($to)){

    $type = mysqli_real_escape_string($conn, $_POST['type']);

    $route_sql = "INSERT INTO route_bookings
    (email, from_location, to_location, mode, distance, cost)
    VALUES
    (
    '$email_safe',
    '$from',
    '$to',
    '$type',
    '$distance',
    '$amount'
    )";

    $conn->query($route_sql);
}

   $success = true;

if($success){
?>
<!DOCTYPE html>
<html>
<head>
<title>Booking Success</title>
<link rel="shortcut icon" href="./assets/images/titleLogo.png" type="image/svg+xml">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
body{
  font-family:Arial;
  background:#0f2027;
  color:white;
}

.box{
  width:420px;
  margin:30px auto;
  padding:20px;
  background:#1c1c1c;
  border-radius:10px;
}.btn-home{
  padding:10px 20px;
  background:#4CAF50;
  color:white;
  border:none;
  border-radius:6px;
  font-weight:bold;
  cursor:pointer;
}

.btn-home:hover{
  background:#45a049;
}
</style>

</head>
<body>

<script>
Swal.fire({
    title: '🎉 Booking Successful!',
    text: 'Payment completed successfully',
    icon: 'success',
    confirmButtonText: 'OK'
});
</script>

<div class="box">

<h2 style="text-align:center;">✅ Booking Confirmed</h2>

<p><b>Transaction ID:</b> <?php echo $txn; ?></p>
<p><b>Name:</b> <?php echo $name; ?></p>
<p><b>Email:</b> <?php echo $email; ?></p>
<p><b>Mobile:</b> <?php echo $mobile; ?></p>
<p><b>Persons:</b> <?php echo $persons; ?></p>
<p><b>Days:</b> <?php echo $days; ?></p>
<?php if(!empty($hotel)){ ?>

<hr>

<h3 style="color:#f9d423;">🏨 Hotel Booking Details</h3>

<p><b>Hotel Name:</b> <?php echo $hotel; ?></p>

<p><b>Check-in Date:</b> <?php echo $checkin; ?></p>

<p><b>Check-out Date:</b> <?php echo $checkout; ?></p>

<?php } ?>
<p><b>From:</b> <?php echo $from; ?></p>
<p><b>To:</b> <?php echo $to; ?></p>
<p><b>Distance:</b> <?php echo $distance; ?> km</p>

<p><b>Amount Paid:</b> ₹<?php echo $amount; ?></p>
<p><b>Method:</b> <?php echo $method; ?></p>

</div>
<div style="text-align:center; margin-top:20px;">
  <button onclick="goHome()" class="btn-home">🏠 Continue</button>
</div>
</body>
<script>
function goHome(){
    Swal.fire({
        title: '🎉 Are YOU Sure to Continue?',
        text: 'Your booking is successful, click below to go to home page',
        icon: 'success',
        confirmButtonText: 'Go to Home'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'index.php';
        }
    });
}
</script>
</html>

<?php
    } else {
        echo "Booking Failed!";
    }
}

$conn->close();
?>