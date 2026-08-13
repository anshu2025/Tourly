<?php
session_start();
include 'connect.php';

if(!isset($_SESSION['email'])){
    header("location: login.php");
    exit;
}

$loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true;
$role = $_SESSION['role'] ?? 'user';
$email = $_SESSION['email'];


// 👑 Admin → sab bookings
if($role == 'admin'){
   $result = $conn->query("
SELECT b.*, p.name AS pname, p.price, p.description
FROM bookings b
LEFT JOIN packages p ON b.package_id = p.package_id
WHERE b.package_id IS NOT NULL
");
}
else {
    // 👤 User → sirf apni bookings
$stmt = $conn->prepare("
SELECT b.*, p.name AS pname, p.price, p.description
FROM bookings b
LEFT JOIN packages p ON b.package_id = p.package_id
WHERE b.email=?
AND b.package_id IS NOT NULL
");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
}
/* 🌍 ROUTE BOOKINGS QUERY */
$routeQuery = $conn->prepare("
SELECT * FROM route_bookings
WHERE email=?
");

$routeQuery->bind_param("s", $email);
$routeQuery->execute();

$routeResult = $routeQuery->get_result();

/* 🏨 HOTEL BOOKINGS QUERY */
$hotelQuery = $conn->prepare("
SELECT * FROM bookings
WHERE email=?
AND hotel_name != ''
AND package_id IS NULL
");

$hotelQuery->bind_param("s", $email);
$hotelQuery->execute();

$hotelResult = $hotelQuery->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Discover Destination</title>
  <style>
body{
    margin:0;
    padding:0;
    overflow-x:hidden;
}

/* ===== BOOKINGS SECTION ===== */

.my-bookings{
    width:100%;
    margin:40px auto;
    text-align:center;
    overflow-x:auto;
    padding:0 10px;
}

.my-bookings h2{
    font-size:28px;
    margin-bottom:20px;
    color:#222;
}

/* ===== TABLE ===== */

.my-bookings table{
    width:100%;
    min-width:1000px;
    margin:0 auto;
    border-collapse:collapse;
    background:#fff;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
    border-radius:8px;
    overflow:hidden;
}

.my-bookings th{
    background:#4CAF50;
    color:#fff;
    padding:14px;
    font-size:16px;
    text-transform:uppercase;
    white-space:nowrap;
}

.my-bookings td{
    padding:12px;
    border-bottom:1px solid #ddd;
    font-size:15px;
    color:#333;
    white-space:nowrap;
}

.my-bookings tr:hover{
    background:#f5f5f5;
}

.my-bookings td[colspan]{
    padding:20px;
    font-size:16px;
    color:#777;
}

/* ===== LINKS ===== */

a{
    text-decoration:none;
}

a[href*="##"]{
    background:red;
    color:white;
    padding:6px 12px;
    border-radius:5px;
}

/* ===== LOGO ===== */

.logo{
    width:90px;
    height:auto;
    object-fit:contain;
    cursor:pointer;
    transition:.3s;
}

.logo:hover{
    transform:scale(1.05);
}

/* ===== HEADER FIX ===== */

.header-top .container,
.header-bottom .container{
    display:flex;
    align-items:center;
    justify-content:space-between;
    flex-wrap:wrap;
}

/* ===== MOBILE ===== */

@media(max-width:768px){

    .logo{
        width:65px;
    }

    .my-bookings h2{
        font-size:22px;
    }

    .my-bookings th,
    .my-bookings td{
        font-size:12px;
        padding:8px;
    }

    .btn-primary{
        padding:8px 12px;
        font-size:12px;
    }

    .social-list{
        display:none;
    }

    .helpline-box{
        display:none;
    }

    .header-top .container,
    .header-bottom .container{
        gap:10px;
    }

}

/* ===== SMALL MOBILE ===== */

@media(max-width:480px){

    .my-bookings{
        padding:0 5px;
    }

    .my-bookings h2{
        font-size:20px;
    }

    .my-bookings th,
    .my-bookings td{
        font-size:11px;
        padding:6px;
    }

}

@media(max-width:991px){

 .navbar{
    background: var(--bright-navy-blue);
  }

 
  .navbar-link {
    color: #fff;
    padding: 15px 20px;
  }

  .navbar-link:hover,
  .navbar-link:focus {
    color: #4fc3f7;
  }
 .navbar-list{
     background:#111;
  }
  .navbar-list li {
    border-bottom: 1px solid rgba(255,255,255,0.1);
  }
 .overlay,
  .overlay.active{
    display: none !important;
    opacity: 0 !important;
    pointer-events: none !important;
  }

}
</style>

  <!-- 
    - favicon
  -->
 <link rel="shortcut icon" href="./assets/images/titleLogo.png" type="image/svg+xml">


  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet">
</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>

    <div class="overlay" data-overlay></div>

    <div class="header-top">
      <div class="container">

        <a href="tel:+01123456790" class="helpline-box">

          <div class="icon-box">
            <ion-icon name="call-outline"></ion-icon>
          </div>

          <div class="wrapper">
            <p class="helpline-title">For Further Inquires :</p>

            <p class="helpline-number">+01 (123) 4567 90</p>
          </div>

        </a>

        <a href="#" >
          <img src="./assets/images/TourlyLogo.png" class="logo" alt="Tourly logo">
        </a>

        <div class="header-btn-group">

          
          <button class="nav-open-btn" aria-label="Open Menu" data-nav-open-btn>
            <ion-icon name="menu-outline"></ion-icon>
          </button>

        </div>

      </div>
    </div>

    <div class="header-bottom">
      <div class="container">

        <ul class="social-list">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </li>

        </ul>

        <nav class="navbar" data-navbar>

          <div class="navbar-top">

            <a href="#home">
              <img src="./assets/images/TourlyLogo.png"  class="logo" alt="Tourly logo">
            </a>

            <button class="nav-close-btn" aria-label="Close Menu" data-nav-close-btn>
              <ion-icon name="close-outline"></ion-icon>
            </button>

          </div>

          <ul class="navbar-list" style="background-color: transparent;" >

            <li>
              <a href="index.php" class="navbar-link" data-nav-link>home</a>
            </li>

            <li>
              <a href="about.php" class="navbar-link" data-nav-link>about us</a>
            </li>

            <li>
              <a href="index.php#destination" class="navbar-link" data-nav-link>destination</a>
            </li>

            <li>
              <a href="package.php" class="navbar-link" data-nav-link>packages</a>
            </li>

            <li>
              <a href="index.php#gallery" class="navbar-link" data-nav-link>gallery</a>
            </li>
            <li>
              <a href="index.php#contact" class="navbar-link" data-nav-link>contact us</a>
            </li>

          </ul>

        </nav>

      <?php if(!$loggedin){ ?>
    
    <a href="login.php">
        <button class="btn btn-primary">Log In</button>
    </a>

    <a href="login.php?role=user">
        <button class="btn btn-primary">Sign Up</button>
    </a>

<?php } else { ?>

    <span style="color:white; margin-right:10px;">
        Welcome, <?php echo $_SESSION['name']; ?>
    </span>

    <a href="profile.php">
        <button class="btn btn-primary">My Profile</button>
    </a>

    <a href="logout.php">
        <button class="btn btn-primary">Logout</button>
    </a>

<?php } ?>

      </div>
    </div>

  </header>
  <main>
    <article>

      <!-- 
        - #HERO
      -->
      <section class="heroabout" id="home">
        

          
      </section>
<body>



<div class="my-bookings">

<h2>My Bookings</h2>

<table>
<tr>
<th>Sr. No.</th>
<th>Package ID</th>
<th>Package Name</th>
<th>Price</th>
<th>Description</th>
<th>Date</th>
<th>Validity</th>
<th>Action</th>
</tr>

<?php
if($result->num_rows > 0){

    $count = 1;

    while($row = $result->fetch_assoc()){
     date_default_timezone_set("Asia/Kolkata");

$booking_date = strtotime($row['booking_date']);
$current_date = strtotime(date("Y-m-d H:i:s"));

$days = floor(($current_date - $booking_date) / 86400);

if($days < 0){
    $days = 0;
}

        echo "<tr>
        <td>".$count."</td>
        <td>{$row['package_id']}</td>
        <td>{$row['pname']}</td>
<td>₹{$row['price']}</td>
<td>" . substr($row['description'], 0, 50) . "...</td>
        <td>{$row['booking_date']}</td>
        <td>" . floor($days) . " days ago</td>
        <td>";

      if($_SESSION['role'] == 'admin'){
    echo "<a href='delete_booking.php?id={$row['booking_id']}'
    onclick=\"return confirm('Delete this booking?');\">
    ❌ Delete
    </a>";
}
else{

    // ⏱ 10 din ke andar
   if($days <= 10){
    echo "<a href='##'
    onclick=\"confirmCancel(event, {$row['booking_id']})\">
    🗑 Cancel
    </a>";
} else {
    echo "<a href='##'
    onclick=\"confirmDelete(event, {$row['booking_id']})\">
    ❌ Delete
    </a>";
}
}

        echo "</td></tr>";

        $count++;
    }

} else {
    echo "<tr><td colspan='5'>No bookings found</td></tr>";
}
?>

</table>

</div>
<div class="my-bookings">

<h2>Route Bookings</h2>

<table>
<tr>
<th>Sr. No.</th>
<th>From</th>
<th>To</th>
<th>Cost</th>
<th>Mode</th>
<th>Date</th>
<th>Validity</th>
<th>Action</th>
</tr>

<?php

if($routeResult->num_rows > 0){

$count = 1;

while($row = $routeResult->fetch_assoc()){

date_default_timezone_set("Asia/Kolkata");

$booking_date = strtotime($row['booking_date']);
$current_date = time();

$days = floor(($current_date - $booking_date) / 86400);

if($days < 0){
    $days = 0;
}

echo "<tr>

<td>".$count."</td>

<td>{$row['from_location']}</td>

<td>{$row['to_location']}</td>

<td>₹{$row['cost']}</td>

<td>{$row['mode']}</td>

<td>{$row['booking_date']}</td>

<td>";

if($days == 0){
    echo "Today";
}
else{
    echo $days . " days ago";
}

echo "</td>

<td>";

if($days <= 10){

echo "<a href='##'
onclick=\"confirmRouteCancel(event, {$row['id']})\">
🗑 Cancel
</a>";

}
else{

echo "<a href='##'
onclick=\"confirmRouteDelete(event, {$row['id']})\">
❌ Delete
</a>";

}

echo "</td></tr>";

$count++;

}

}
else{

echo "<tr>
<td colspan='8'>No route bookings found</td>
</tr>";

}
?>

</table>

</div>
<div class="my-bookings">

<h2>Booked Hotels</h2>

<table>
<tr>
<th>Sr. No.</th>
<th>Hotel Name</th>
<th>Persons</th>
<th>Days</th>
<th>Amount</th>
<th>Booking Date</th>
<th>Check In</th>
<th>Check Out</th>
<th>Action</th>
</tr>

<?php

if($hotelResult->num_rows > 0){

$count = 1;
while($row = $hotelResult->fetch_assoc()){

$booking_date = strtotime($row['booking_date']);
$current_date = time();

$days = floor(($current_date - $booking_date) / 86400);

if($days < 0){
    $days = 0;
}

echo "<tr>

<td>".$count."</td>

<td>{$row['hotel_name']}</td>

<td>{$row['persons']}</td>

<td>{$row['total_days']}</td>

<td>₹{$row['amount']}</td>

<td>{$row['booking_date']}</td>

<td>{$row['checkin_date']}</td>

<td>{$row['checkout_date']}</td>

<td>";

if($days <= 10){

    echo "<a href='##'
    onclick=\"confirmHotelCancel(event, {$row['booking_id']})\">
    🗑 Cancel
    </a>";

}
else{

    echo "<a href='##'
    onclick=\"confirmHotelDelete(event, {$row['booking_id']})\">
    ❌ Delete
    </a>";

}

echo "</td></tr>";

$count++;

}

}
else{

echo "<tr>
<td colspan='6'>No hotel bookings found</td>
</tr>";

}

?>

</table>

</div>
<script type="module"
src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js">
</script>

<script nomodule
src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js">
</script>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    
function confirmCancel(e, id){
    e.preventDefault();

    Swal.fire({
    title: 'Are you sure?',
    text: 'You will receive only 82% refund (18% cancellation charges will be deducted).',
    icon: 'warning',
    showCancelButton: true,

    confirmButtonText: 'Yes',
    cancelButtonText: 'No',

    confirmButtonColor: '#e74c3c',   // 🔴 red button
    cancelButtonColor: '#6c757d'     // ⚫ grey button
}).then((result) => {
    if(result.isConfirmed){
        window.location.href = 'delete_booking.php?id=' + id;
    }
});
}

function confirmDelete(e, id){
    e.preventDefault();

    Swal.fire({
        title: 'Delete this booking?',
        text: 'Are you sure you want to delete this booking?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
         confirmButtonColor: '#e74c3c',   // 🔴 red button
    cancelButtonColor: '#6c757d'
    

    }).then((result) => {
        if(result.isConfirmed){
            window.location.href = 'delete_booking.php?id=' + id;
        }
    });
}

function confirmRouteCancel(e, id){
    e.preventDefault();

    Swal.fire({
        title: 'Are you sure?',
        text: 'You will receive only 82% refund.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        confirmButtonColor: '#e74c3c',
        cancelButtonColor: '#0e7ee0'

    }).then((result) => {

        if(result.isConfirmed){
            window.location.href = 'delete_route_booking.php?id=' + id;
        }

    });
}

function confirmRouteDelete(e, id){
    e.preventDefault();

    Swal.fire({
        title: 'Delete this route booking?',
        text: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        confirmButtonColor: '#e74c3c',
        cancelButtonColor: '#1181e4'

    }).then((result) => {

        if(result.isConfirmed){
            window.location.href = 'delete_route_booking.php?id=' + id;
        }

    });
}

function confirmHotelCancel(e, id){
    e.preventDefault();

    Swal.fire({
        title: 'Are you sure?',
        text: 'You will receive only 82% refund (18% cancellation charges deducted).',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        confirmButtonColor: '#e74c3c',
        cancelButtonColor: '#6c757d'
    }).then((result) => {

        if(result.isConfirmed){
            window.location.href = 'delete_hotel_booking.php?id=' + id;
        }

    });
}

function confirmHotelDelete(e, id){
    e.preventDefault();

    Swal.fire({
        title: 'Delete this hotel booking?',
        text: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        confirmButtonColor: '#e74c3c',
        cancelButtonColor: '#6c757d'
    }).then((result) => {

        if(result.isConfirmed){
            window.location.href = 'delete_hotel_booking.php?id=' + id;
        }

    });
}

</script>


</html>