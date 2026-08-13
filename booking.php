<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    echo "<script>
        alert('Please login first!');
        window.location.href='login.php?role=user';
    </script>";
    exit;
}
include 'connect.php';
$package_id = $_GET['package_id'] ?? '';

$package = null;

if(!empty($package_id)){
    
    $sql = "SELECT * FROM packages WHERE package_id='$package_id'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        $package = mysqli_fetch_assoc($result);

        $price = $package['price'];
    }
}
$hotel = $_GET['hotel'] ?? "";
?>
<?php
$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$type = $_GET['type'] ?? '';
$distance = $_GET['distance'] ?? '';
$cost = $_GET['cost'] ?? '';
if(empty($price)){
    $price = $_GET['price'] ?? 0;
}

$package_id = $_GET['package_id'] ?? '';
$showRoute = ($from && $to && $distance && $cost);
$persons = $_GET['persons'] ?? '';

$checkin = $_GET['checkin'] ?? '';
$checkout = $_GET['checkout'] ?? '';

$days = '';

if(!empty($checkin) && !empty($checkout)){

    $checkinDate = new DateTime($checkin);
    $checkoutDate = new DateTime($checkout);

    $interval = $checkinDate->diff($checkoutDate);

    $days = $interval->days;

    if($days <= 0){
        $days = 1;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Book Hotel</title>
<link rel="shortcut icon" href="./assets/images/titleLogo.png" type="image/svg+xml">
<style>
body{
  font-family: Arial, sans-serif;
  background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
  margin:0;
  color:white;
}

.container{
  max-width:600px;
  margin:40px auto;
  background:rgba(255,255,255,0.1);
  backdrop-filter: blur(15px);
  padding:30px;
  border-radius:15px;
  box-shadow:0 10px 30px rgba(0,0,0,0.4);
}

h2{
  text-align:center;
  margin-bottom:20px;
}

form{
  display:flex;
  flex-direction:column;
  gap:12px;
}

input, select{
  padding:12px;
  border:none;
  border-radius:8px;
  outline:none;
}

label{
  font-size:14px;
}

.book-now-btn, button{
  margin-top:10px;
  padding:12px;
  background:#ff7a18;
  color:white;
  border:none;
  border-radius:8px;
  cursor:pointer;
  font-size:16px;
}

.book-now-btn:hover{
  background:#ff4b2b;
}

.back{
  display:block;
  text-align:center;
  margin-top:15px;
  color:#ccc;
  text-decoration:none;
}
</style>

</head>
<body>

<div class="container">

<h2>🏨 Book: <?php echo $hotel; ?></h2>
<?php if($showRoute){ ?>
<div style="background:#222; padding:10px; border-radius:8px; margin-bottom:15px;">
    <b>From:</b> <?php echo $from; ?> <br>
    <b>To:</b> <?php echo $to; ?> <br>
    <b>Mode:</b> <?php echo $type; ?> <br>
    <b>Distance:</b> <?php echo $distance; ?> km <br>
    <b style="color:#f9d423;">💰 Cost: ₹<?php echo $cost; ?></b>
</div>
<?php } ?>
<?php if($package){ ?>

<div style="background:#222;padding:15px;border-radius:8px;margin-bottom:15px;">

<h3>🌍 Package Details</h3>

<p><b>Package:</b> <?php echo $package['name']; ?></p>

<p><b>Description:</b> <?php echo $package['description']; ?></p>

<p><b>Price:</b> ₹<?php echo $package['price']; ?></p>

</div>

<?php } ?>

<?php if($package){ ?>

<h3 style="text-align:center;color:#f9d423;">
🌍 Package Price: ₹<?php echo $price; ?>
</h3>

<?php } else { ?>

<h3 style="text-align:center;color:#f9d423;">
🏨 Hotel Price per person: ₹<?php echo $price; ?>
</h3>

<?php } ?>
<form action="pay.php" method="POST">


<label>👤 Full Name</label>
<input type="text" name="name" required>

<label>📍 Address</label>
<input type="text" name="address" required>

<label>📧 Email</label>
<input type="email" name="email" required>

<label>📱 Mobile Number</label>
<input type="text" name="mobile" required>

<label>🆔 Aadhaar Number</label>
<input type="text" name="aadhaar" required>
<label>👥 Number of Persons</label>
<input type="number"
name="persons"
value="<?php echo $persons; ?>"
<?php echo !empty($persons) ? 'readonly' : 'required'; ?>
min="1">
<label>📅 Number of Days</label>
<input type="number"
name="days"
value="<?php echo $days; ?>"
<?php echo !empty($days) ? 'readonly' : 'required'; ?>
min="1">
<input type="hidden" name="from" value="<?php echo $from; ?>">
<input type="hidden" name="to" value="<?php echo $to; ?>">
<input type="hidden" name="type" value="<?php echo $type; ?>">
<input type="hidden" name="distance" value="<?php echo $distance; ?>">
<input type="hidden" name="cost" value="<?php echo $cost; ?>">
<input type="hidden" name="price" value="<?php echo $price; ?>">
<input type="hidden" name="checkin" value="<?php echo $_GET['checkin'] ?? ''; ?>">

<input type="hidden" name="checkout" value="<?php echo $_GET['checkout'] ?? ''; ?>">
<?php if(!empty($package_id)){ ?>
<input type="hidden" name="package_id" value="<?php echo $package_id; ?>">
<?php } ?>
<input type="hidden" name="hotel" value="<?php echo $hotel; ?>">

<?php if($package){ ?>

<input type="hidden" name="package_name"
value="<?php echo $package['name']; ?>">

<input type="hidden" name="package_id"
value="<?php echo $package['package_id']; ?>">

<?php } ?>

<input type="submit" class="book-now-btn" value="Confirm Booking">

</form>

<button onclick="history.back()">⬅ Back</button>

</div>

</body>
</html>