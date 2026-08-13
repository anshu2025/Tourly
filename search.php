
<?php
session_start();
include 'hotel_connect.php';
$loggedin = isset($_SESSION['email']);
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form values safely
    $destination = trim($_POST['destination']);
    $people      = trim($_POST['people']);
    $checkin     = trim($_POST['checkin']);
    $checkout    = trim($_POST['checkout']);

    // Basic validation
    if (empty($destination)) {
        echo "<h3>Destination is required!</h3>";
        exit;
    }

    // 🔥 DB Query
   $people = empty($people) ? 1 : $people;

$sql = "SELECT * FROM hotels 
        WHERE LOWER(city) LIKE LOWER('%$destination%') 
        AND persons >= '$people'";

$result = mysqli_query($conn, $sql);

if(!$result){
  die("Query Error: " . mysqli_error($conn));
}}
else {
    header("Location: index.php");
    exit;
}

// 🖼️ Destination Image System (same as yours)
$destinationImages = [
    'Goa' => './assets/images/goa.jpg',
    'Varanasi' => './assets/images/varansi.png',
    'Jammu' => './assets/images/ice.png',
    'Chitrakoot' => './assets/images/chitrakoot.jpg',
    'Lakshadweep' => './assets/images/lakshdweep.jpg',
    'Prayagraj' => './assets/images/sangam.jpg'
];

$imagePath = $destinationImages[$destination] ?? './assets/images/default.jpg';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Hotel Search Result</title>
<link rel="shortcut icon" href="./assets/images/titleLogo.png" type="image/svg+xml">

<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f6f8;
}

/* Main Box */
.result-box {
    max-width: 700px;
    margin: 40px auto;
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    text-align: center;
}

/* Image */
.destination-image {
    width: 100%;
    height: 220px;
    margin: 15px 0 20px;
    border-radius: 10px;
    overflow: hidden;
}

.destination-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Info */
.info {
    font-size: 15px;
    margin: 6px 0;
}

/* Hotel List */
.hotel-list {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: center;
    margin-top: 20px;
}

/* Hotel Card */
.hotel-card {
    width: 200px;
    background: #fff;
    border-radius: 10px;
    padding: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    text-align: center;
}

.hotel-card img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
}

.hotel-card h4 {
    margin: 8px 0;
}

.hotel-card button {
    background: #2b7cff;
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 5px;
    cursor: pointer;
}

.hotel-card button:hover {
    background: #1a5fd0;
}

/* Button */
.btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 18px;
    background: #ff7a00;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
}
</style>

</head>
<body>

<div class="result-box">

    <h2>Hotel Search Details</h2>

    <!-- Destination Image -->
    <div class="destination-image">
        <img src="<?php echo $imagePath; ?>" alt="">
    </div>

    <div class="info"><strong>Destination:</strong> <?php echo htmlspecialchars($destination); ?></div>
    <div class="info"><strong>No. of People:</strong> <?php echo $people ?: 'Not specified'; ?></div>
    <div class="info"><strong>Check-in:</strong> <?php echo $checkin ?: 'Not specified'; ?></div>
    <div class="info"><strong>Check-out:</strong> <?php echo $checkout ?: 'Not specified'; ?></div>

    <p>🔍 Showing hotels in <b><?php echo htmlspecialchars($destination); ?></b></p>

    <!-- 🔥 HOTEL LIST -->
    <h3>Available Hotels</h3>

    <div class="hotel-list">

    <?php
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
    ?>

       <div class="hotel-card">
    <img src="./assets/images/<?php echo $row['image']; ?>" alt="">
    
    <h4><?php echo $row['name']; ?></h4>

    <p>Capacity: <?php echo $row['persons']; ?> persons</p>

    <p>Price: ₹<?php echo number_format($row['price']); ?></p>

    <?php if($loggedin){ ?>

   <button onclick="window.location.href='booking.php?hotel=<?php echo urlencode($row['name']); ?>&price=<?php echo $row['price']; ?>&persons=<?php echo $people; ?>&checkin=<?php echo $checkin; ?>&checkout=<?php echo $checkout; ?>'">
Book Now
</button>

    <?php } else { ?>

    <button onclick="alert('Please login first!')">
        Login to Book
    </button>

    <?php } ?>

</div>

    <?php
        }
    } else {
        echo "<p>No hotels found for this search</p>";
    }
    ?>

    </div>

    <a href="index.php" class="btn">Search Again</a>

</div>

</body>
</html>