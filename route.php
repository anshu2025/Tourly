<?php
session_start();

if(!isset($_SESSION['name'])){
    echo "<script>
        alert('⚠️ Please login first');
        window.location.href='login.php';
    </script>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Tourly</title>
  <meta charset="UTF-8">
 <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
 <link rel="shortcut icon" href="./assets/images/titleLogo.png" type="image/svg+xml">

</head>
<style>
    /* 🌐 Global Styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Noto Sans', sans-serif;
}

body {
  background: linear-gradient(135deg, #575784, #2c3e50);
  color: white;
  min-height: 100vh;
  padding-bottom: 50px;
}

/* 🔝 Header */
header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 30px;
  background: rgba(83, 160, 202, 0.4);
  backdrop-filter: blur(10px);
  box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

header h2 {
  font-size: 24px;
  color: #f9d423;
  animation: glow 2s infinite alternate;
}

/* ✨ Glow animation */
@keyframes glow {
  from { text-shadow: 0 0 5px #f9d423; }
  to { text-shadow: 0 0 20px #ff4e50; }
}

/* 🔗 Navbar */
nav a {
  margin: 0 10px;
  text-decoration: none;
  color: white;
  font-weight: bold;
  position: relative;
  transition: 0.3s;
}

nav a::after {
  content: "";
  position: absolute;
  width: 0%;
  height: 2px;
  background: #f9d423;
  left: 0;
  bottom: -5px;
  transition: 0.3s;
}

nav a:hover::after {
  width: 100%;
}

nav a:hover {
  color: #f9d423;
}

/* 🌙 Toggle Switch */
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}

.switch input {
  display: none;
}

.slider {
  position: absolute;
  background: #ccc;
  border-radius: 50px;
  width: 100%;
  height: 100%;
  cursor: pointer;
  transition: 0.4s;
}

.slider::before {
  content: "";
  position: absolute;
  height: 18px;
  width: 18px;
  background: white;
  border-radius: 50%;
  top: 3px;
  left: 4px;
  transition: 0.4s;
}

input:checked + .slider {
  background: #f9d423;
}

input:checked + .slider::before {
  transform: translateX(24px);
}

/* 🧭 Title */
h1 {
  text-align: center;
  margin: 30px 0;
  font-size: 32px;
  animation: fadeIn 1s ease-in-out;
}

/* ✨ Fade animation */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-20px); }
  to { opacity: 1; transform: translateY(0); }
}

/* 🔍 Search Box */
input, select {
  display: block;
  width: 90%;
  max-width: 400px;
  margin: 10px auto;
  padding: 12px;
  border-radius: 8px;
  border: none;
  outline: none;
  font-size: 16px;
  transition: 0.3s;
}

input:focus, select:focus {
  transform: scale(1.05);
  box-shadow: 0 0 10px #f9d423;
}

/* 🔘 Button */
button {
  display: block;
  margin: 15px auto;
  padding: 12px 30px;
  border: none;
  border-radius: 25px;
  background: linear-gradient(90deg, #ff4e50, #f9d423);
  color: white;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s;
}

button:hover {
  transform: scale(1.1);
  box-shadow: 0 0 15px rgba(255,78,80,0.7);
}

/* 📦 Results */
#results {
  margin-top: 20px;
  text-align: center;
  animation: fadeIn 1s ease;
}

/* 📦 Wrapper - Center Fix */
.map-wrapper {
  width: 90%;
  max-width: 1000px;
  margin: 30px auto;   /* ✅ this keeps it centered */
  display: flex;
  flex-direction: column;
  align-items: center; /* ✅ center content inside */
  gap: 15px;
}

/* 🔝 Top Layout */
.top-section {
  width: 90%;
  max-width: 1100px;
  margin: 30px auto;
  display: flex;
  gap: 20px;
}

/* 🧾 Form Box */
.form-box {
  flex: 1;
  background: rgba(0,0,0,0.5);
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 0 15px rgba(0,0,0,0.4);
  animation: fadeIn 0.8s ease;
}

.form-box h2 {
  margin-bottom: 15px;
  color: #f9d423;
}

/* 📊 Info Box */
.info-box {
  flex: 1;
  background: rgba(0,0,0,0.6);
  padding: 20px;
  border-radius: 12px;
  line-height: 1.6;
  box-shadow: 0 0 15px rgba(0,0,0,0.4);
  animation: fadeIn 1s ease;
}

/* 🗺️ Bottom Map */
.map-bottom {
  width: 90%;
  max-width: 1100px;
  margin: 20px auto;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 0 25px rgba(0,0,0,0.6);
}

#map {
  width: 100%;
  height: 500px; /* 🔥 big map */
  border: none;
}

/* 📱 Responsive */
@media (max-width: 768px) {
  .top-section {
    flex-direction: column;
  }

  #map {
    height: 350px;
  }
}

/* 🗺️ Map Container */
.map-container {
  width: 100%;   /* ✅ same width as info box */
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(0,0,0,0.5);
}




/* 📱 Responsive */
/* 🌙 Dark Mode */
.dark-mode {
  background: #f5f5f5;
  color: black;
}

.dark-mode header {
  background: #ffffff;
}

.dark-mode nav a {
  color: black;
}

.dark-mode input,
.dark-mode select {
  background: #eee;
  color: black;
}
</style>
<body>

<header>
  <h2>Tourly</h2>

  <nav>
    <a href="profile.php">My Bookings</a>
    <a href="logout.php">Logout</a>
  </nav>

  <!-- 🌙 Dark Mode Button -->
 <label class="switch">
  <input type="checkbox" onchange="toggleMode()">
  <span class="slider"></span>
</label>
</header>

<h1>Search Flights & Buses</h1>
<!-- 🔝 Top Section -->
<div class="top-section">

  <!-- 🧾 Left: Form -->
  <div class="form-box">
    <h2>Plan Your Trip</h2>

    <input id="from" placeholder="From">
    <input id="to" placeholder="To">

    <select id="type">
      <option value="flight">Flight</option>
      <option value="bus">Bus</option>
    </select>

    <button onclick="search()">Search</button>
  </div>

  <!-- 📊 Right: Info -->
  <div class="info-box" id="mapInfo">
    Enter details to see route info
  </div>

</div>

<!-- 🗺️ Bottom Map -->
<div class="map-bottom">
  <iframe id="map"></iframe>
</div>

<script>
window.onload = function () {
    let params = new URLSearchParams(window.location.search);
    let destination = params.get("to");

    if (destination) {
        document.getElementById("to").value = destination;
    }
};
// 🔍 Search Function
function search() {
    let from = document.getElementById("from").value;
    let to = document.getElementById("to").value;
    let type = document.getElementById("type").value;

    if (!from || !to) {
        alert("Please enter both locations");
        return;
    }

    // 🗺️ Map Embed URL (Google Maps)
    let mapUrl = `https://www.google.com/maps?q=${from}+to+${to}&output=embed`;

    document.getElementById("map").src = mapUrl;

    // 📏 Distance Calculation (Approx using API-free trick)
    getDistance(from, to, type);
}
// 📏 Distance + Info + Cost
async function getDistance(from, to, type) {
    try {
        // 🌍 Get coordinates
        let url = `https://nominatim.openstreetmap.org/search?format=json&q=${from}`;
        let res1 = await fetch(url);
        let data1 = await res1.json();

        url = `https://nominatim.openstreetmap.org/search?format=json&q=${to}`;
        let res2 = await fetch(url);
        let data2 = await res2.json();

        if (!data1.length || !data2.length) {
            document.getElementById("mapInfo").innerHTML = "❌ Location not found";
            return;
        }

        let lat1 = data1[0].lat;
        let lon1 = data1[0].lon;
        let lat2 = data2[0].lat;
        let lon2 = data2[0].lon;

        let distance = calculateDistance(lat1, lon1, lat2, lon2);

        // ⏱️ Speed
        let speed = (type === "flight") ? 800 : 60;
        let time = (distance / speed).toFixed(2);

        // 💰 Cost Calculation
        let costPerKm;
        if (type === "flight") {
            costPerKm = 6; // avg ₹6/km
        } else {
            costPerKm = 1.5; // avg ₹1.5/km
        }

        let totalCost = (distance * costPerKm).toFixed(0);

        // 🎯 Dynamic pricing (weekend surge example)
        let day = new Date().getDay(); // 0=Sunday
        if (day === 0 || day === 6) {
            totalCost = (totalCost * 1.2).toFixed(0); // +20%
        }

 function bookNow(from, to, type, distance, cost) {
    let url = `booking.php?from=${encodeURIComponent(from)}
    &to=${encodeURIComponent(to)}
    &type=${type}
    &distance=${distance}
    &cost=${cost}`;

    window.location.href = url;
}document.getElementById("mapInfo").innerHTML = `
    <b>From:</b> ${from} <br>
    <b>To:</b> ${to} <br>
    <b>Distance:</b> ${distance.toFixed(2)} km <br>
    <b>Mode:</b> ${type} <br>
    <b>Estimated Time:</b> ${time} hrs <br>
    <b style="color:#f9d423;">💰 Estimated Cost: ₹${totalCost}</b>

    <br><br>

    <a href="booking.php?from=${encodeURIComponent(from)}&to=${encodeURIComponent(to)}&type=${type}&distance=${distance.toFixed(2)}&cost=${totalCost}" 
   style="text-decoration: none;">

    <button style="padding:10px 20px; background:#28a745; color:white; border:none; border-radius:5px; cursor:pointer;">
        🚀 Book Now
    </button>

</a>
`;

    } catch (err) {
        document.getElementById("mapInfo").innerHTML = "⚠️ Error loading data";
    }
}


// 📐 Haversine Formula (Distance Calculation)
function calculateDistance(lat1, lon1, lat2, lon2) {
    let R = 6371; // Earth radius in km

    let dLat = (lat2 - lat1) * Math.PI / 180;
    let dLon = (lon2 - lon1) * Math.PI / 180;

    let a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(lat1 * Math.PI / 180) *
        Math.cos(lat2 * Math.PI / 180) *
        Math.sin(dLon / 2) *
        Math.sin(dLon / 2);

    let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

    return R * c;
}


// 🌙 Dark Mode Toggle
function toggleMode() {
    document.body.classList.toggle("dark-mode");
}
</script>
</body>
</html>