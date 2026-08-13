
<?php
session_start();
include 'hotel_connect.php';

$loggedin = isset($_SESSION['email']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Explore Destinations</title>
<link rel="shortcut icon" href="./assets/images/titleLogo.png" type="image/svg+xml">

<style>
body::before{
  content:"";
  position:fixed;
  width:400px;
  height:400px;
  background:rgba(22, 206, 215, 0.3);
  filter:blur(100px);
  top:20%;
  left:30%;
  z-index:-1;
}

body{
  font-family: Arial, sans-serif;
background: linear-gradient(135deg, #435d8d, #083568);
  margin:0;
  color:white;
}



h1{
  text-align:center;
  padding:20px;
}

/* Grid */
.destinations{
  display:flex;
  flex-wrap:wrap;
  justify-content:center;
  gap:20px;
  padding:20px;
}

/* Card */
.card{
  width:250px;
  background: rgba(255,255,255,0.2);
  backdrop-filter: blur(10px);
  border-radius:15px;
  overflow:hidden;
  text-align:center;
  box-shadow:0 8px 20px rgba(0,0,0,0.3);
  transition:0.3s;
}

.card:hover{
  transform: translateY(-5px);
}

.card img{
  width:100%;
  height:200px;
  object-fit:cover;
}

.card h3{
  margin:10px 0;
}

.card p{
  font-size:14px;
  padding:0 10px;
}

/* Button */
.card a{
  display:inline-block;
  margin:10px;
  padding:8px 15px;
  background:#ff7a18;
  color:white;
  text-decoration:none;
  border-radius:8px;
}

.card a:hover{
  background:#ff4b2b;
}
.marquee-alert {
    background: linear-gradient(90deg, #3a53b8, #24a0d1);
    color: white;
    font-size: 18px;
    padding: 10px;
    font-weight: bold;
    border-radius: 5px;
    box-shadow: 10px 10px 10px rgba(25, 115, 150, 0.3);
}
</style>

</head>
<body>
<?php if(!$loggedin){ ?>
<marquee behavior="alternate" direction="left" class="marquee-alert">
    ⚠️ Please login to see destinations
</marquee>
</p>
<?php } ?>
<h1>🌍 Explore Indian Destinations</h1>

<div class="destinations">

<!-- Destination Cards -->

<div class="card">
  <img src="assets/images/goa.jpg">
  <h3>Goa</h3>
  <p>Beaches, nightlife & water sports.</p>
  <?php if($loggedin){ ?>
    <a href="route.php?to=Goa">Explore</a>
<?php } else { ?>
    <a href="#" onclick="loginAlert()">Explore</a>
<?php } ?>
</div>

<div class="card">
  <img src="assets/images/varansi.png">
  <h3>Varanasi</h3>
  <p>Spiritual city of Ganga.</p>
  <?php if($loggedin){ ?>
    <a href="route.php?to=Varanasi">Explore</a>
<?php } else { ?>
    <a href="#" onclick="loginAlert()">Explore</a>
<?php } ?>
</div>
<div class="card">
  <img src="assets/images/sangam.jpg">
  <h3>Prayagraj</h3>
  <p>Holy Triveni Sangam.</p>

  <!-- 🔗 Pass destination in URL -->
 <?php if($loggedin){ ?>
    <a href="route.php?to=Prayagraj">Explore</a>
<?php } else { ?>
    <a href="#" onclick="loginAlert()">Explore</a>
<?php } ?>
</div>

<div class="card">
  <img src="assets/images/chitrakoot.jpg">
  <h3>Chitrakoot</h3>
  <p>Peaceful hills & religious sites.</p>
  <?php if($loggedin){ ?>
    <a href="route.php?to=Chitrakoot">Explore</a>
<?php } else { ?>
    <a href="#" onclick="loginAlert()">Explore</a>
<?php } ?>
</div>

<div class="card">
  <img src="assets/images/ice.png">
  <h3>Jammu</h3>
  <p>Snow mountains & temples.</p>
  <a href="route.html?to=Jammu">Explore</a>
</div>

<div class="card">
  <img src="assets/images/lakshdweep.jpg">
  <h3>Lakshadweep</h3>
  <p>Crystal clear beaches & islands.</p>
  <?php if($loggedin){ ?>
    <a href="route.php?to=Lakshadweep">Explore</a>
<?php } else { ?>
    <a href="#" onclick="loginAlert()">Explore</a>
<?php } ?>
</div>

<div class="card">
  <img src="assets/images/delhi.jpg">
  <h3>Delhi</h3>
  <p>Capital city with history.</p>
  <?php if($loggedin){ ?>
    <a href="route.php?to=Delhi">Explore</a>
<?php } else { ?>
    <a href="#" onclick="loginAlert()">Explore</a>
<?php } ?>
</div>

<div class="card">
  <img src="assets/images/mumbai.jpg">
  <h3>Mumbai</h3>
  <p>City of dreams.</p>
  <?php if($loggedin){ ?>
    <a href="route.php?to=Mumbai">Explore</a>
<?php } else { ?>
    <a href="#" onclick="loginAlert()">Explore</a>
<?php } ?>
</div>

<div class="card">
  <img src="assets/images/jaipur.jpg">
  <h3>Jaipur</h3>
  <p>Pink city of India.</p>
  <?php if($loggedin){ ?>
    <a href="route.php?to=Jaipur">Explore</a>
<?php } else { ?>
    <a href="#" onclick="loginAlert()">Explore</a>
<?php } ?>
</div>

<div class="card">
  <img src="assets/images/manali2.jpg">
  <h3>Manali</h3>
  <p>Snow mountains & adventure.</p>
  <?php if($loggedin){ ?>
    <a href="route.php?to=Manali">Explore</a>
<?php } else { ?>
    <a href="#" onclick="loginAlert()">Explore</a>
<?php } ?>
</div>

<div class="card">
  <img src="assets/images/shimla.jpg">
  <h3>Shimla</h3>
  <p>Hill station beauty.</p>
  <?php if($loggedin){ ?>
    <a href="route.php?to=Shimla">Explore</a>
<?php } else { ?>
    <a href="#" onclick="loginAlert()">Explore</a>
<?php } ?>
</div>

<div class="card">
  <img src="assets/images/udaipur.jpg">
  <h3>Udaipur</h3>
  <p>City of lakes.</p>
  <?php if($loggedin){ ?>
    <a href="route.php?to=Udaipur">Explore</a>
<?php } else { ?>
    <a href="#" onclick="loginAlert()">Explore</a>
<?php } ?>
</div>

<div class="card">
  <img src="assets/images/kerala.jpg">
  <h3>Kerala</h3>
  <p>Backwaters & greenery.</p>
  <?php if($loggedin){ ?>
    <a href="route.php?to=Kerala">Explore</a>
<?php } else { ?>
    <a href="#" onclick="loginAlert()">Explore</a>
<?php } ?>
</div>

<div class="card">
  <img src="assets/images/darjeeling.jpg">
  <h3>Darjeeling</h3>
  <p>Tea gardens & mountains.</p>
  <?php if($loggedin){ ?>
    <a href="route.php?to=Darjeeling">Explore</a>
<?php } else { ?>
    <a href="#" onclick="loginAlert()">Explore</a>
<?php } ?>
</div>

<div class="card">
  <img src="assets/images/agra.jpg">
  <h3>Agra</h3>
  <p>Home of Taj Mahal.</p>
  <?php if($loggedin){ ?>
    <a href="route.php?to=Agra">Explore</a>
<?php } else { ?>
    <a href="#" onclick="loginAlert()">Explore</a>
<?php } ?>
</div>

</div>

</body>
<script>
function loginAlert() {
    alert("⚠️ Please login to explore routes");
    window.location.href = "login.php";
}
</script>
</html>