<?php
session_start();

$data = $_POST;

// cost auto
$price   = floatval($_POST['price'] ?? 0);
$persons = intval($_POST['persons'] ?? 1);
$days    = intval($_POST['days'] ?? 1);
$cost    = floatval($_POST['cost'] ?? 0);
if(!empty($_POST['package_id'])){
    $total = $price + $cost;
}else{
    $total = ($price * $persons * $days) + $cost;
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Dummy Payment</title>
<link rel="shortcut icon" href="./assets/images/titleLogo.png" type="image/svg+xml">

<style>
body{
  font-family: Arial;
  background:#0f2027;
  color:white;
  text-align:center;
}

.box{
  width:400px;
  margin:80px auto;
  background:#1c1c1c;
  padding:25px;
  border-radius:10px;
}

input, select{
  width:100%;
  padding:10px;
  margin:10px 0;
  border:none;
  border-radius:6px;
}

button{
  padding:12px;
  width:100%;
  background:#ff7a18;
  border:none;
  border-radius:8px;
  color:white;
  font-size:16px;
  cursor:pointer;
}
</style>

<script>
function toggleFields(){
  let method = document.getElementById("method").value;
  
  document.getElementById("upiBox").style.display = (method=="UPI") ? "block" : "none";
  document.getElementById("cardBox").style.display = (method=="CARD") ? "block" : "none";
}
</script>

</head>
<body>

<div class="box">
<h2 style="text-align:center;">💳 Payment Panel</h2>
<h3>💰 Total Amount: ₹<?php echo $total; ?></h3>
<?php if(!empty($_POST['hotel'])){ ?>

<h3>🏨 Hotel Booking</h3>

<p>Hotel: <?php echo $_POST['hotel']; ?></p>
<p>Check-in: <?php echo $_POST['checkin']; ?></p>
<p>Check-out: <?php echo $_POST['checkout']; ?></p>

<?php } ?><?php if(!empty($_POST['package_id'])){ ?>

<p>🌍 Package Price: ₹<?php echo $price; ?></p>

<?php } elseif(!empty($_POST['hotel'])){ ?>

<p>🏨 Hotel Price: ₹<?php echo $price; ?> / person</p>

<?php } ?>
<p>Persons: <?php echo $persons; ?></p>
<p>Days: <?php echo $days; ?></p>
<p>Travel Cost: ₹<?php echo $cost; ?></p>
<?php if(!empty($_POST['from']) && !empty($_POST['to'])){ ?>

<hr>

<h3>🚌 Route Details</h3>

<p>From: <?php echo $_POST['from']; ?></p>
<p>To: <?php echo $_POST['to']; ?></p>
<p>Mode: <?php echo $_POST['type']; ?></p>
<p>Distance: <?php echo $_POST['distance']; ?> km</p>
<p>Travel Cost: ₹<?php echo $_POST['cost']; ?></p>

<?php } ?>
<?php if(!empty($_POST['package_id'])){ ?>

<hr>

<h3>🌍 Package Details</h3>

<p>Package ID: <?php echo $_POST['package_id']; ?></p>

<?php if(!empty($_POST['package_name'])){ ?>
<p>Package Name: <?php echo $_POST['package_name']; ?></p>
<?php } ?>

<p>Package Price: ₹<?php echo $price; ?></p>

<?php } ?>
<form action="book.php" method="POST">

<!-- 🔥 PURE FORM DATA FORWARD -->
<?php
foreach($data as $key => $value){
    echo "<input type='hidden' name='$key' value='$value'>";
}
?>

<input type="hidden" name="amount" value="<?php echo $total; ?>">
<hr>

<h3>📋 Booking Summary</h3>

<p>Persons: <?php echo $persons; ?></p>

<p>Days: <?php echo $days; ?></p>

<p>Total Amount: ₹<?php echo $total; ?></p>
<label>Select Payment Method</label>
<select name="method" id="method" onchange="toggleFields()" required>
  <option value="">-- Select --</option>
  <option value="UPI">UPI</option>
  <option value="CARD">Card</option>
  <option value="CASH">Cash</option>
</select>

<!-- UPI -->
<div id="upiBox" style="display:none;">
  <input type="text" name="upi" placeholder="Enter UPI ID">
</div>

<!-- Card -->
<div id="cardBox" style="display:none;">
  <input type="text" placeholder="Card Number">
  <input type="text" placeholder="Expiry">
  <input type="text" placeholder="CVV">
</div>

<button type="submit">Pay Now</button>

</form>

</div>

</body>
</html>