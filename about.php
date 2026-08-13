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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About | Discover Destination</title>


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

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}

body{
     font-family: Times New Roman, Serif;
  background:#f8fafc;
  color:#1e293b;
  transition:0.4s;
  overflow-x:hidden;
}
.logo{
  position: fixed;       /* screen pe fix rahe */
  top: 5px;             /* upar se gap */
  right: -150px;           /* right corner */
  
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
/* DARK MODE */
body.dark{
  background:#0f172a;
  color:white;
}

/* Toggle Button */
.toggle{
  position:fixed;
  top:20px;
  right:100px;
  background:#2563eb;
  color:white;
  padding:10px 15px;
  border-radius:20px;
  cursor:pointer;
  z-index:1;
}

/* HERO */
.hero{
  position:relative;
  height:100vh;
  
}

.hero::before{
  content:"";
  position:absolute;
  inset:0;
  background:rgba(0,0,0,0.3); /* Light transparent only for text clarity */
}

.hero-content{
    backdrop-filter:blur(15px);
  position:relative;
  z-index:1;
 
  padding:50px;
  color:white;
   border-radius:20px;
  animation:fadeIn 2s ease;
}

.hero h1{
  font-size:60px;
  font-weight:800;
  background:linear-gradient(45deg,#00f2fe,#4facfe);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
}

.hero p{
  margin-top:20px;
  font-size:18px;
  color:#ddd;
}


/* PARTICLES */
.particle{
  position:absolute;
  width:10px;
  height:10px;
  background:white;
  border-radius:50%;
  opacity:0.5;
  animation:float 10s infinite linear;
}

@keyframes float{
  from{transform:translateY(0);}
  to{transform:translateY(-800px);}
}

/* SECTION */
.section{
  padding:100px 10%;
  text-align:center;
}

.section h2{
  font-size:36px;
  margin-bottom:20px;
  color:#2563eb;
}

body.dark .section h2{color:#4facfe;}

/* COUNTERS */
.counters{
  display:flex;
  justify-content:center;
  gap:50px;
  flex-wrap:wrap;
  margin-top:50px;
}

.counter-box{
  background:white;
  padding:40px;
  border-radius:15px;
  box-shadow:0 10px 25px rgba(0,0,0,0.1);
  width:200px;
  transition:0.3s;
}

body.dark .counter-box{
  background:#1e293b;
}

.counter-box:hover{
  transform:translateY(-10px);
}

.counter{
  font-size:40px;
  color:#2563eb;
  font-weight:700;
}

.features{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
  gap:25px;
  padding:60px 10%;
}

.feature-card{
  background:white;
  padding:30px;
  border-radius:15px;
  box-shadow:0 10px 25px rgba(0,0,0,0.1);
  transition:0.4s;
  text-align:center;
}

.feature-card:hover{
  transform:translateY(-10px);
  background:#0d6efd;
  color:white;
}

.feature-card h3{
  margin-bottom:10px;
}

/* ================= TIMELINE ================= */

.timeline{
  position:relative;
  max-width:900px;
  margin:50px auto;
}

.timeline::after{
  content:'';
  position:absolute;
  width:4px;
  background:#4facfe;
  top:0;
  bottom:0;
  left:50%;
  margin-left:-2px;
}

.timeline-item{
  padding:20px 40px;
  position:relative;
  width:50%;
}

.timeline-item.left{ left:0; }
.timeline-item.right{ left:50%; }

.timeline-item::after{
  content:'';
  position:absolute;
  width:20px;
  height:20px;
  right:-10px;
  background:#00f2fe;
  border-radius:50%;
  top:25px;
}

.timeline-item.right::after{
  left:-10px;
}


/* TEAM */
.team-container{
  display:flex;
  justify-content:center;
  gap:40px;
  flex-wrap:wrap;
  margin-top:50px;
}

.member{
  background:white;
  padding:40px;
  border-radius:20px;
  width:260px;
  box-shadow:0 10px 25px rgba(0,0,0,0.1);
  transition:0.4s;
}

body.dark .member{
  background:#1e293b;
}

.member:hover{
  transform:translateY(-15px);
}

.member img{
  width:120px;
  height:120px;
  border-radius:50%;
  margin-bottom:15px;
  object-fit:cover;
}

/* TESTIMONIALS */
.testimonial{
  position: relative;
  height: 80vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #f5f5f5; /* light background for better look */
  overflow: hidden;
}

.slide{
  position: absolute;
  width: 70%;              /* reduced width */
  height: 75%;             /* slightly smaller height */
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  border-radius: 20px;     /* rounded corners */
  box-shadow: 0 15px 40px rgba(0,0,0,0.3);  /* modern shadow */
  opacity: 0;
  transition: opacity 1.5s ease-in-out, transform 1s ease;
  display: flex;
  justify-content: center;
  align-items: center;
  transform: scale(0.95);  /* small zoom effect */
}

.slide.active{
  opacity: 1;
  z-index: 1;
  transform: scale(1);
}

.overlay{
  background: rgba(89, 199, 232, 0.55);
  padding: 30px 40px;
  border-radius: 15px;
  text-align: center;
  backdrop-filter: blur(5px); /* modern blur effect */
}
.overlay.active{
  animation: fadeIn 1s ease;
  background: rgba(201, 147, 147, 0.65); /* slightly darker for active */
  opacity: 0.3;
 
}
.navbar.active {
  right: 0;
  visibility: visible;
  pointer-events: all;
  transition: 0.25s ease-out;
  background: #fff;
  border-radius:20px;
}

.navbar-link{
   color: white;
}
.overlay h2{
  color: white;
  font-size: 26px;
  max-width: 600px;
  line-height: 1.4;
}


/* CTA */
.cta{
  padding:80px;
  text-align:center;
  background:linear-gradient(135deg,#2563eb,#1e3a8a);
  color:white;
}

.cta button{
  padding:15px 35px;
  border:none;
  border-radius:30px;
  background:white;
  color:#2563eb;
  font-weight:600;
  cursor:pointer;
}

/* Animation */
@keyframes fadeIn{
  from{opacity:0;transform:translateY(40px);}
  to{opacity:1;transform:translateY(0);}
}

.navbar-list{
  background-color: transparent;
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
</head>
<body>
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

        <a href="#">
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
              <a href="index.php#home" class="navbar-link" data-nav-link>home</a>
            </li>

            <li>
              <a href="#about.html" class="navbar-link" data-nav-link>about us</a>
            </li>

            <li>
              <a href="index.php#destination" class="navbar-link" data-nav-link>destination</a>
            </li>

            <li>
              <a href="index.php#package" class="navbar-link" data-nav-link>packages</a>
            </li>

            <li>
              <a href="index.php#gallery" class="navbar-link" data-nav-link>gallery</a>
            </li>

            <li>
              <a href="#contact" class="navbar-link" data-nav-link>contact us</a>
            </li>

          </ul>

        </nav>

        <?php if(!$loggedin){ ?>
    
    <a href="login.php">
        <button class="btn btn-primary">Log In</button>
    </a>

    <a href="signup.php">
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



<div class="toggle" onclick="toggleMode()">🌙 Toggle Mode</div>

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <h1>Discover Destination</h1>
        <p>Smart Tourism Platform for Modern Travelers</p>
    </div>
</section>
<!-- ABOUT -->
<section class="section">
  <h2>Who We Are</h2>
  <p> DISCOVER DESTINATION is a smart tourism management website designed to provide
    convenient tour packages, hotel bookings, train, bus and cab reservations.
    Our system ensures fast processing, high security, accuracy, and reliable
    customer service. We aim to build strong relationships with our customers
    so they can enjoy the holiday of their dreams.</p>

  <div class="counters">
    <div class="counter-box">
      <div class="counter" data-target="500">0</div>
      <p>Happy Customers</p>
    </div>
    <div class="counter-box">
      <div class="counter" data-target="120">0</div>
      <p>Tour Packages</p>
    </div>
    <div class="counter-box">
      <div class="counter" data-target="50">0</div>
      <p>Destinations</p>
    </div>
  </div>
</section>

<!-- FEATURES -->
<section class="features">
  <div class="feature-card">
    <h3>⚡ Fast Processing</h3>
    <p>Immediate results with secure booking system.</p>
  </div>

  <div class="feature-card">
    <h3>📊 Data Management</h3>
    <p>Tracks all customer and tour information efficiently.</p>
  </div>

  <div class="feature-card">
    <h3>🌍 Smart Search</h3>
    <p>Find tour destinations according to your preferences.</p>
  </div>

  <div class="feature-card">
    <h3>💬 Feedback System</h3>
    <p>Tourists can share their valuable experiences.</p>
  </div>
</section>
<!-- TIMELINE -->
<section class="section">
  <h2>Our Journey</h2>
  <div class="timeline">
    <div class="timeline-item left">
      <h3>2024</h3>
      <p>Idea & Research Started</p>
    </div>
    <div class="timeline-item right">
      <h3>2025</h3>
      <p>Website Development & Testing</p>
    </div>
    <div class="timeline-item left">
      <h3>2026</h3>
      <p>Launch & Customer Growth</p>
    </div>
  </div>
</section>


<!-- TEAM -->
<section class="section">
  <h2>Meet Our Team</h2>
  <div class="team-container">
    <div class="member">
      <img src="./assets/images/member1.png">
      <h3>Utkarsh Pateriya</h3>
      <p>Member 1</p>
    </div>
    <div class="member">
      <img src="./assets/images/member2.png">
      <h3>Shubham Yadav</h3>
      <p>Member 2</p>
    </div>
  </div>
</section>
<!-- TESTIMONIAL -->
<section class="testimonial">

  <div class="slide active" 
       style="background-image:url('./assets/images/beach.jpg')">
    <div class="overlay">
      <h2>"Best travel booking experience ever!"</h2>
    </div>
  </div>

  <div class="slide" 
       style="background-image:url('./assets/images/hero-banner.jpg')">
    <div class="overlay">
      <h2>"Very secure and fast system."</h2>
    </div>
  </div>

  <div class="slide" 
       style="background-image:url('./assets/images/ghat.png')">
    <div class="overlay">
      <h2>"Highly recommended for tour planning."</h2>
    </div>
  </div>

</section>



      <!-- 
        - #CTA
      -->

      <section class="cta" id="contact">
        <div class="container">

          <div class="cta-content">
            <p class="section-subtitle">Call To Action</p>

            <h2 class="h2 section-title">Ready For Unforgatable Travel. Remember Us!</h2>

            <p class="section-text">
              Fusce hic augue velit wisi quibusdam pariatur, iusto primis, nec nemo, rutrum. Vestibulum cumque
              laudantium. Sit ornare
              mollitia tenetur, aptent.
            </p>
          </div>

          <button class="btn btn-secondary">Contact Us !</button>

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
            <img src="./assets/images/TourlyLogo.png" class="clogo" alt="Tourly logo">
          </a>

          <p class="footer-text">
            Urna ratione ante harum provident, eleifend, vulputate molestiae proin fringilla, praesentium magna conubia
            at
            perferendis, pretium, aenean aut ultrices.
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

              <address>3146 Koontz, California</address>
            </li>

          </ul>

        </div>

        <div class="footer-form">

          <p class="form-text">
            Subscribe our newsletter for more update & news !!
          </p>

          <form action="" class="form-wrapper">
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

/* DARK MODE */
function toggleMode(){
  document.body.classList.toggle("dark");
}

/* COUNTER ANIMATION */
const counters=document.querySelectorAll('.counter');
counters.forEach(counter=>{
  counter.innerText='0';
  const update=()=>{
    const target=+counter.getAttribute('data-target');
    const c=+counter.innerText;
    const inc=target/100;
    if(c<target){
      counter.innerText=Math.ceil(c+inc);
      setTimeout(update,20);
    }else{
      counter.innerText=target+"+";
    }
  };
  update();
});

/* TESTIMONIAL SLIDER */
let slides = document.querySelectorAll('.slide');
let current = 0;

setInterval(() => {
  slides[current].classList.remove('active');
  current = (current + 1) % slides.length;
  slides[current].classList.add('active');
}, 4000);
</script>

</body>
</html>
