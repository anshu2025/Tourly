
   <?php
session_start();
include 'connect.php';

$loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true;
$role = $_SESSION['role'] ?? 'user';

$result = $conn->query("SELECT * FROM packages");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Discover Destination</title>
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
<style>
  
.navbar-list{
  background-color: transparent;
}

.logo{
  width: 90px;
  height: auto;
  object-fit: contain;
  box-shadow: none;
}
.logo:hover{
  transform: scale(1.1);
  transition: 0.3s;
}


@media (max-width: 991px) {


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

           

            <button class="nav-close-btn" aria-label="Close Menu" data-nav-close-btn>
              <ion-icon name="close-outline"></ion-icon>
            </button>

          </div>

          <ul class="navbar-list">

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
<style>
/* 🌍 Title */
.title {
    text-align: center;
    margin: 20px;
    font-size: 32px;
}

/* 📦 Container */
.package-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    padding: 30px;
}

/* 🧱 Card */
.package-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    height: 100%;
    transition: 0.3s;
    position: relative;
}

.package-card:hover {
    transform: translateY(-10px) scale(1.02);
}

/* 🖼 Image */
.package-card img {
    width: 100%;
    height: 220px;
    object-fit: contain;
    background: #f5f5f5;
    transition: 0.3s;
}

.package-card:hover img {
    transform: scale(1.1);
}

/* 📄 Content */
.card-body {
    padding: 15px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.card-body h3 {
    margin: 10px 0;
}

.card-body p {
    font-size: 14px;
    color: #555;
    height: 60px;
    overflow: hidden;
    flex-grow: 1; 
}

/* 💰 Price */
.price-box {
    margin: 10px 0;
}

.old-price {
    text-decoration: line-through;
    color: gray;
    font-size: 14px;
}

.new-price {
    color: #28a745;
    font-size: 20px;
    font-weight: bold;
}

/* 🔥 Popular Badge */
.badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: red;
    color: white;
    padding: 5px 10px;
    font-size: 12px;
    border-radius: 5px;
}

/* 💥 Discount Badge (RIGHT TOP) */
.discount-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: linear-gradient(45deg, #ff0000, #ff7300);
    color: white;
    padding: 6px 12px;
    font-size: 13px;
    border-radius: 20px;
    font-weight: bold;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
}

/* 🔘 Buttons */
.btn-book {
    width: 50%;
    padding: 12px;
    background: linear-gradient(45deg, #ff5722, #ff9800);
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.btn-book:hover {
    background: linear-gradient(45deg, #e64a19, #f57c00);
}

.btn-login {
    width: 70%;
    padding: 12px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 8px;
}

.btn-edit {
    background: orange;
    color: white;
    padding: 6px 10px;
    border-radius: 5px;
    margin-right: 5px;
}

.btn-delete {
    background: red;
    color: white;
    padding: 6px 10px;
    border-radius: 5px;
}

/* 📱 Responsive */
@media(max-width:600px){
    .card-body p{
        height: auto;
    }
}

</style>

<h1 class="title">🌍 Tour Packages</h1>

<div class="package-container">

<?php while($row = $result->fetch_assoc()){ ?>

<?php
    // 🔥 Random Discount
    $discount = rand(10,70);
    $original = $row['price'];
    $final = $original - ($original * $discount / 100);
?>

<div class="package-card">

    <!-- 🔥 LEFT: Popular -->
    <span class="badge">🔥 Popular</span>

    <!-- 🔥 RIGHT: Discount -->
    <span class="discount-badge"><?php echo $discount; ?>% OFF</span>

    <!-- Image -->
    <img src="./assets/images/<?php echo $row['image']; ?>">

    <div class="card-body">

        <h3><?php echo $row['name']; ?></h3>

        <p><?php echo $row['description']; ?></p>

        <!-- 💰 Price Box -->
        <div class="price-box">
            <div class="old-price">₹<?php echo $original; ?></div>
            <div class="new-price">₹<?php echo round($final); ?></div>
        </div>

        <?php if($role == 'admin'){ ?>

            <a href="admin/edit_package.php?id=<?php echo $row['package_id']; ?>" class="btn-edit">✏️ Edit</a>
            <a href="admin/delete_package.php?id=<?php echo $row['package_id']; ?>" class="btn-delete">❌ Delete</a>

        <?php } else { ?>

            <?php if($loggedin){ ?>
                <form action="booking.php" method="GET">
                    <input type="hidden" name="package_id" value="<?php echo $row['package_id']; ?>">
                    <button class="btn-book">Explore Now 🚀</button>
                </form>
            <?php } else { ?>
                <a href="login.php?role=user">
                    <button class="btn-login">Login to Book</button>
                </a>
            <?php } ?>

        <?php } ?>

    </div>
</div>

<?php } ?>

</div>

  <?php if($role == 'admin'){ ?>
    <div class="add-package-container">
        <a href="admin/add_package.php" class="btn-add">➕ Add New Package</a>
    </div>
<?php } ?>
</body>
</html>
<script src="./assets/js/script.js"></script>

<script type="module"
src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js">
</script>

<script nomodule
src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js">
</script>
</body>