<?php
session_start();

$txn = "TXN" . rand(100000,999999);
?>

<h2 style="text-align:center;">✅ Booking Confirmed</h2>

<div style="width:400px;margin:20px auto;padding:20px;border:1px solid #ccc;">

<p><b>Transaction ID:</b> <?php echo $txn; ?></p>
<p><b>Name:</b> <?php echo $_POST['name']; ?></p>
<p><b>Email:</b> <?php echo $_POST['email']; ?></p>
<p><b>Mobile:</b> <?php echo $_POST['mobile']; ?></p>
<p><b>Persons:</b> <?php echo $_POST['persons']; ?></p>
<p><b>Days:</b> <?php echo $_POST['days']; ?></p>

<p><b>From:</b> <?php echo $_POST['from']; ?></p>
<p><b>To:</b> <?php echo $_POST['to']; ?></p>
<p><b>Distance:</b> <?php echo $_POST['distance']; ?> km</p>

<p><b>Amount Paid:</b> ₹<?php echo $_POST['amount']; ?></p>
<p><b>Method:</b> <?php echo $_POST['method']; ?></p>

</div>