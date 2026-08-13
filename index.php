<?php
session_start();
include 'hotel_connect.php';

$loggedin = isset($_SESSION['email']);
$name = $_SESSION['name'] ?? '';
$role = $_SESSION['role'] ?? '';
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


.logo{
  position: fixed;       /* screen pe fix rahe */
  top: 5px;             /* upar se gap */
  right: 20px;           /* right corner */
  
  width: 100px;
  height: 70px;
  object-fit: cover;

  box-shadow: 0 2px 8px rgba(0,0,0,0.3);

  cursor: pointer;
  z-index: 9999;     /* sabke upar rahe */    
}
.logo:hover{
  transform: scale(1.1);
  transition: 0.3s;
}
@media (max-width:768px){

  .logo{
    width:70px;
    height:50px;
    right:50px;
    top:10px;
  }

}
.marquee-alert {
    background: linear-gradient(90deg, #3a53b8, #24a0d1);
    color: red;
    font-size: 18px;
    padding: 10px;
    font-weight: bold;
    border-radius: 5px;
    box-shadow: 20px 20px 20px rgba(25, 115, 150, 0.3);
}

.btn-warning {
    background: orange;
    color: white;
}

.btn-warning:hover {
    background: darkorange;
}

.btn-danger {
    background: red;
    color: white;
}
/* Gallery Grid Upgrade */

/* 🔥 Scroll ke baad navbar text fix */
.header.active .navbar-link {
  color: #222 !important; /* dark text */
}

.header.active .navbar-link:hover {
  color: var(--bright-navy-blue);
}

/* 🔥 Username / user text fix */
.header.active .user-name {
  color: #222 !important;
  background: rgba(0,0,0,0.05);
}

/* 🔥 Icons (search, menu) fix */
.header.active .header-btn-group {
   color: #222;
   background: rgba(0,0,0,0.05);
}

.header.active .social-link {
  color: var(--onyx);
  border-color: rgba(0,0,0,0.2);
}

/* ================= USER NAME ================= */
.user-name {
  font-size: 14px;
  font-weight: 600;
  color: white;
  margin-left: 10px;
  padding: 5px 10px;
  border-radius: 20px;
  background: rgba(255,255,255,0.1);
  transition: 0.3s;
  text-transform: capitalize;
}

/* Hover effect */
.user-name:hover {
  background: rgba(255,255,255,0.3);
}
/*-----------------------------------*\
 * #GALLERY
\*-----------------------------------*/

.gallery-list {
  display: flex;
  width: max-content;
  animation: scroll 25s linear infinite;
animation-timing-function: ease-in-out;
}

.slider {
  overflow-x: hidden;  /* sirf horizontal hide */
  overflow-y: visible; /* 🔥 vertical zoom allow */
  width: 100%;
  position: relative;
  padding: 60px 0; /* 🔥 extra space for zoom */
}

/* Card */
.gallery-item {
  position: relative;
  border-radius: 15px;
  overflow: visible; /* 🔥 IMPORTANT (zoom bahar aaye) */
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
  list-style: none;
  margin-right: 20px;
  flex-shrink: 0;
  transition: transform 0.4s ease, box-shadow 0.4s ease;
}

/* Image wrapper */
.gallery-image {
  overflow: visible;
   display: flex;
  border-radius: 10px;
}

/* Image */
.gallery-image img {
  height: 200px;
  width: 300px;
  object-fit: contain;
  border-radius: 10px;
  transition: transform 0.4s ease;
}
.gallery-item:hover {
  transform: scale(1.25); /* पूरा card zoom */
  z-index: 999; /* 🔥 upar aa jaye */
  box-shadow: 0 25px 60px rgba(0,0,0,0.5);
}

/* 🔥 HOVER EFFECT */
.gallery-item:hover img {
  transform: scale(1.3);
  filter: brightness(1.1);
}

/* 🔥 Pause ONLY when hovering item (not full list) */
.gallery-item:hover ~ * {
  animation-play-state: paused;
}

/* Better: pause whole slider */
.slider:hover .gallery-list {
  animation-play-state: paused;
}
@media (max-width:768px){

 .gallery-item:hover{
    transform:none;
 }

 .gallery-item:hover img{
    transform:none;
 }

}
/* Animation */
@keyframes scroll {
  0% { transform: translateX(0); }
  100% { transform: translateX(-100%); }
}


.upload-btn {
  text-align: center;
  margin-bottom: 20px;
}

.upload-btn button {
  padding: 10px 20px;
  background: linear-gradient(45deg, #007bff, #00c6ff);
  border: none;
  color: white;
  border-radius: 8px;
  cursor: pointer;
}/* 🔴 Delete button style */
.delete-btn {
  position: absolute;
  top: 10px;
  right: 10px;
  background: red;
  color: white;
  padding: 5px 8px;
  border-radius: 50%;
  font-size: 14px;
  display: none; /* by default hidden */
  text-decoration: none;
  z-index: 999; /* 🔥 sabse important */
  cursor: pointer;
}

/* Hover effect */
.delete-btn:hover {
  background: darkred;
}

.gallery-item:hover .delete-btn {
  display: block;
}
/* Overlay Stylish */
.overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 15px;
  color: #fff;
  font-size: 14px;
  background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
  opacity: 0;
  transition: 0.3s;
}

/* Show Overlay */
.gallery-item:hover .overlay {
  opacity: 1;
}

/* Smooth Fade Effect */
.gallery-item::after {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,0.1);
  opacity: 0;
  transition: 0.3s;
}

.gallery-item:hover::after {
  opacity: 1;
}

/* Section spacing improve */
.gallery {
  padding: 60px 0;
}


/* Title polish */
.section-title {
  font-size: 32px;
  margin-bottom: 10px;
}

.section-text {
  max-width: 600px;
  margin: auto;
  color: #666;
  margin-bottom: 30px;
}
.modal {
  display: none; /* by default hidden */
  position: fixed;
  z-index: 9999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.7);
   backdrop-filter: blur(8px);
}

.modal-content {
  width: 360px;
  margin: 6% auto;
  padding: 25px;
  border-radius: 20px;
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(15px);
  box-shadow: 0 20px 50px rgba(0,0,0,0.3);
  text-align: center;
  color: #fff;
  animation: popUp 0.4s ease;
}
@keyframes popUp {
  from {
    transform: scale(0.7);
    opacity: 0;
  }
  to {
    transform: scale(1);
    opacity: 1;
  }
}
.close {
  position: absolute;
  right: 20px;
  top: 15px;
  font-size: 22px;
  cursor: pointer;
  color: white;
}

.close:hover {
  color: #ff4d4d;
}

/* 📸 Title */
.modal-content h3 {
  margin-bottom: 15px;
  font-size: 22px;
}

/* 📁 File upload box */
.modal-content input[type="file"] {
  width: 100%;
  padding: 12px;
  border: 2px dashed #00c6ff;
  border-radius: 12px;
  background: rgba(255,255,255,0.1);
  color: #fff;
  cursor: pointer;
  margin-bottom: 15px;
}

/* 🖼️ Preview image */
#preview {
  width: 100%;
  border-radius: 12px;
  margin-bottom: 15px;
  display: none;
}

/* 🚀 Upload button */
.modal-content button {
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 12px;
  background: linear-gradient(45deg, #00c6ff, #0072ff);
  color: white;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s;
}

.modal-content button:hover {
  transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0, 114, 255, 0.5);
}

.navbar-list{
  background-color: transparent;
}
@media (max-width:768px){

.header-btn-group{
   flex-wrap:wrap;
   justify-content:center;
}

.user-name{
   margin-top:8px;
}

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
<!-- 🔥 RIGHT SIDE BUTTONS -->

<div class="header-btn-group">

<?php if(!$loggedin){ ?>

  <a href="login.php"><button class="btn btn-primary">Log In</button></a>
  <a href="login.php"><button class="btn btn-primary">Sign Up</button></a>

<?php } else { ?>

  <!-- USER NAME -->
  <span class="user-name">
  👋 Hello, <strong><?php echo $name; ?></strong> 😎
</span>

  <?php if($role == 'admin'){ ?>
    <a href="admin/dashboard.php"><button class="btn btn-warning">Dashboard</button></a>
  <?php } else { ?>
    <a href="profile.php"><button class="btn btn-primary">My Profile</button></a>
  <?php } ?>

  <a href="logout.php"><button class="btn btn-danger">Logout</button></a>

  <!-- SWITCH -->
  <a href="login.php?role=<?php echo $role == 'admin' ? 'user' : 'admin'; ?>&switch=true">
    <button class="btn btn-warning">🔄 Switch</button>
  </a>

<?php } ?>

</div>
      </div>
    </div>

  </header>
 <!-- #region --><main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="hero" id="home">
        <div class="container">

          <h2 class="h1 hero-title">Discover Destination</h2>

          <p class="hero-text">
            "Travel far enough, you meet yourself."
          </p>

          <div class="btn-group">
            
           <a href="package.php">
  <button class="btn btn-secondary">Book Now</button></a>
          </div>

        </div>
      </section>


<?php if(!$loggedin){ ?>
<marquee behavior="alternate" direction="left" class="marquee-alert">
    ⚠️ Please login to see destinations
</marquee>
<?php } ?>


      <!-- 
        - #TOUR SEARCH
      -->

      <section class="tour-search">
        <div class="container">
          <div class="hotel">
            <h3>Popular Hotels </h3>
          </div>
          
          <form action="search.php" method="POST" class="tour-search-form">
          
          
            <div class="input-wrapper">
              <label for="destination" class="input-label">Search Destination*</label>

              <input type="text" name="destination" id="destination" required placeholder="Enter Destination"
                class="input-field">
                
                </div>
                
            <div class="input-wrapper">
              <label for="people" class="input-label">Pax Number</label>

              <input type="number" name="people" id="people" placeholder="No.of People" class="input-field" required>
            </div>

            <div class="input-wrapper">
              <label for="checkin" class="input-label">Checkin Date</label>

              <input type="date" name="checkin" id="checkin"  class="input-field" required>
            </div>

            <div class="input-wrapper">
              <label for="checkout" class="input-label">Checkout Date</label>

              <input type="date" name="checkout" id="checkout"  class="input-field" required>
            </div>
            
            <button type="submit" class="btn btn-secondary">Inquire now</button>

          </form>
          
        </div>
      </section>
      <!-- 
        - #POPULAR
      -->

      <section class="popular" id="destination">
        <div class="container">

          <p class="section-subtitle">Uncover place</p>

          <h2 class="h2 section-title">Popular destination</h2>

          <p class="section-text">
          Discover Our Most Sought-After Destinations: Explore Stunning Landscapes, Vibrant Cultures, and Unforgettable Experiences Await Your Journey!
          </p>

          <ul class="popular-list">

            <li>
              <div class="popular-card">

                <figure class="card-img">
                  <img src="./assets/images/amritsar.jpg" alt="San miguel, italy" loading="lazy">
                </figure>

                <div class="card-content">

                  <div class="card-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                  </div>

                  <p class="card-subtitle">
                    <a href="#">India</a>
                  </p>

                  <h3 class="h3 card-title">
                    <a href="#">Golden Temple India  </a>
                  </h3>

                  <p class="card-text">
                    Known as Golden Temple 
                  </p>

                </div>

              </div>
            </li>

            <li>
              <div class="popular-card">

                <figure class="card-img">
                  <img src="./assets/images/lakshdweep.jpg" alt="Burj khalifa, dubai" loading="lazy">
                </figure>

                <div class="card-content">

                  <div class="card-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                  </div>

                  <p class="card-subtitle">
                    <a href="#">India</a>
                  </p>

                  <h3 class="h3 card-title">
                    <a href="#">lakshdweep</a>
                  </h3>

                  <p class="card-text">
                   India Island
                  </p>

                </div>

              </div>
            </li>

            <li>
              <div class="popular-card">

                <figure class="card-img">
                  <img src="./assets/images/jammu.jpg" alt="jammu,INDIA" loading="lazy">
                </figure>

                <div class="card-content">

                  <div class="card-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                  </div>

                  <p class="card-subtitle">
                    <a href="#">india</a>
                  </p>

                  <h3 class="h3 card-title">
                    <a href="#">jammu</a>
                  </h3>

                  <p class="card-text">
                    Explore Jammu 
                  </p>

                </div>

              </div>
            </li>

          </ul>

          <button class="btn btn-primary" onclick="window.location.href='destinations.php'">
  More Destination
</button>

        </div>
      </section>
 <!-- 
        - #GALLERY -->

<section class="gallery" id="gallery">
  <div class="container">

    <p class="section-subtitle">Photo Gallery</p>

    <h2 class="h2 section-title">Photo's From Travellers</h2>

    <p class="section-text">
      Capturing the Essence of Travel...
    </p>

    <!-- ✅ Upload button (only user) -->
    <div class="upload-btn">
     <?php if(isset($_SESSION['loggedin']) && $_SESSION['role'] == 'user'){ ?>
        <button onclick="openUploadModal()">+ Add Your Memory</button>
      <?php } ?>
    </div>

    <!-- ✅ Static Gallery (ONLY YOUR IMAGES) -->
     <div class="slider">
    <ul class="gallery-list">

  <!-- ✅ Static Images -->
  <li class="gallery-item">
    <figure class="gallery-image">
      <img src="./assets/images/member2.png">
      <?php if(isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin'){ ?> <a href="delete.php?img=assets/images/member2.png" class="delete-btn">❌</a> <?php } ?>
    </figure>
  </li>

  <li class="gallery-item">
    <figure class="gallery-image">
      <img src="./assets/images/I3.jpg">
      <?php if(isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin'){ ?> <a href="delete.php?img=assets/images/I3.jpg" class="delete-btn">❌</a> <?php } ?>
    </figure>
  </li>

<li class="gallery-item"> <figure class="gallery-image"> <img src="./assets/images/member1.png"> 
<?php if(isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin'){ ?> <a href="delete.php?img=./assets/images/member1.png" class="delete-btn">❌</a> <?php } ?> </figure> </li>

<li class="gallery-item"> <figure class="gallery-image"> <img src="./assets/images/gallery-1.jpg"> <?php if(isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin'){ ?> <a href="delete.php?img=./assets/images/gallery-1.jpg" class="delete-btn">❌</a> <?php } ?> </figure> </li> <li class="gallery-item"> <figure class="gallery-image"> <img src="./assets/images/gallery-2.jpg"> <?php if(isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin'){ ?> <a href="delete.php?img=./assets/images/gallery-2.jpg" class="delete-btn">❌</a> <?php } ?> </figure> </li> <li class="gallery-item"> <figure class="gallery-image"> <img src="./assets/images/gallery-3.jpg"> <?php if(isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin'){ ?> <a href="delete.php?img=./assets/images/gallery-3.jpg" class="delete-btn">❌</a> <?php } ?> </figure> </li> <li class="gallery-item"> <figure class="gallery-image"> <img src="./assets/images/gallery-5.jpg"> <?php if(isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin'){ ?> <a href="delete.php?img=./assets/images/gallery-5.jpg" class="delete-btn">❌</a> <?php } ?> </figure> </li>
  <!-- 🔥 ONLY UPLOADED IMAGES -->
  <?php
  $folder = "assets/uploads/";
  $files = glob($folder . "*");

  foreach($files as $img){
  ?>
    <li class="gallery-item">
  <figure class="gallery-image">
    <img src="<?php echo $img; ?>">

    <?php if(isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin'){ ?>
     <a href="delete.php?img=<?php echo ltrim($img, './'); ?>" 
   class="delete-btn"
   onclick="return confirm('Are you sure you want to delete this image?')">
   ❌
</a>
    <?php } ?>

  </figure>
</li>
  <?php } ?>

</ul>
</div>
  </div>
</section>
<!-- tumhari gallery section ke baad -->

<!-- Upload Modal -->
<?php if(isset($_SESSION['loggedin']) && $_SESSION['role'] == 'user'){ ?>

<div id="uploadModal" class="modal">
  <div class="modal-content">

    <span onclick="closeUploadModal()" class="close">&times;</span>

    <h3>📸 Upload Your Travel Memory</h3>

    <form action="upload.php" method="POST" enctype="multipart/form-data">

      <input type="file" name="image" onchange="previewImage(event)" required>

      <img id="preview">

      <button type="submit">Upload Photo</button>

    </form>

  </div>
</div>
<?php } ?>

 <!-- 
        - #CTA
      -->

      <section class="cta" id="contact">
        <div class="container">

          <div class="cta-content">
            <p class="section-subtitle">Call To Action</p>

            <h2 class="h2 section-title">Ready For Unforgatable Travel. Remember Us!</h2>

            <p class="section-text">
            Share Your Thoughts: Let Us Know How We're Doing! Get in Touch: Reach Out for Questions, Bookings, or Just to Say Hello! We're Here to Help.
            </p>
          </div>
          <div class="containerf">
        <h2>Feedback Form</h2>
              <style>
               .containerf{
              width:400px;
                 max-width:100%;
                 margin:0;
              padding: 16px;
              background-color: #fff;
              border-radius: 5px;
              box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
          }
          @media (max-width:768px){
             .containerf{
                 width:100%;
                    margin-top:30px;
                   }}
          .form-groupx {
              margin-bottom: 20px;
          }
          .form-groupx label {
              display: block;
              font-weight: bold;
              margin-bottom: 5px;
          }
          .form-groupx input,
          .form-groupx textarea {
              width: 100%;
              padding: 8px;
              margin-left: -2px;
              border: 1px solid #ccc;
              border-radius: 3px;
          }
          .form-groupx textarea {
              resize: vertical;
          }
          .btn-submitf {
              background-color: #007bff;
              color: #fff;
              border: none;
              padding: 10px 20px;
              border-radius: 3px;
              cursor: pointer;
          }
          .btn-submitf:hover {
              background-color: #0056b3;
          }
          </style>
        <form action="feedback.php" method="POST">
            <div class="form-groupx">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-groupx">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-groupx">
                <label for="comment">Comment:</label>
                <textarea id="comment" name="comment" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn-submitf">Submit Feedback</button>
        </form>
    </div>
         

        </div>
      </section>

      

    </article>
  </main>
<!-- 
    - #FOOTER
  -->

  <footer class="footer">

    <div class="footer-top">
      <div class="container">

        <div class="footer-brand">

          <a href="#">
            <img src="./assets/images/TourlyLogo.png"  class="Clogo" alt="Tourly logo">
          </a>

          <p class="footer-text">
          “DISCOVER DESTINATION” is website that provide a convenient way for a customer to tour packages and to book hotels, trains, cabs and bus for tour purposes.
          </p>

        </div>

        <div class="footer-contact">

          <h4 class="contact-title">Contact Us</h4>

          <p class="contact-text">
            Feel free to contact and reach us !!
          </p>

          <ul>

            <li class="contact-item">
              <ion-icon name="call-outline"></ion-icon>

              <a href="tel:+01123456790" class="contact-link">+01 (123) 4567 90</a>
            </li>

            <li class="contact-item">
              <ion-icon name="mail-outline"></ion-icon>

              <a href="mailto:info.tourly.com" class="contact-link">info.tourly.com</a>
            </li>

            <li class="contact-item">
              <ion-icon name="location-outline"></ion-icon>

              <address>Prayagraj,INDIA</address>
            </li>

          </ul>

        </div>

        <div class="footer-form">

          <p class="form-text">
            Subscribe our newsletter for more update & news !!
          </p>

          <form action="subscriber.php" method="POST" class="form-wrapper">
            <input type="email" name="email" class="input-field" placeholder="Enter Your Email" required>

            <button type="submit" class="btn btn-secondary">Subscribe</button>
          </form>

        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">

        <p class="copyright">
         &copy; 2026 <a href="">codewithtourly</a>. All rights reserved
        </p>

        <ul class="footer-bottom-list">

          <li>
            <a href="#" class="footer-bottom-link">Privacy Policy</a>
          </li>

          <li>
            <a href="#" class="footer-bottom-link">Term & Condition</a>
          </li>

          <li>
            <a href="#" class="footer-bottom-link">FAQ</a>
          </li>

        </ul>

      </div>
    </div>

  </footer>
<!-- 
    - #GO TO TOP
  -->

  <a href="#top" class="go-top" data-go-top>
    <ion-icon name="chevron-up-outline"></ion-icon>
  </a>
 <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
  <script>
  function openUploadModal() {
    document.getElementById("uploadModal").style.display = "block";
  }
  
  function closeUploadModal() {
    document.getElementById("uploadModal").style.display = "none";
  }

  function previewImage(event) {
  const file = event.target.files[0];
  const preview = document.getElementById("preview");

  if(file){
    preview.src = URL.createObjectURL(file);
    preview.style.display = "block";
  }
}
  </script>

</body>

</html> 