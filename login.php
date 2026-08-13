<?php 
session_start();

if(isset($_GET['switch']) && $_GET['switch'] == 'true'){
    session_unset();
    session_destroy();
}

$login = false;
$showError = false;
$showAlert = false;

$login_role = isset($_GET['role']) ? $_GET['role'] : 'user';

include 'connect.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){

    // LOGIN
    if(isset($_POST['login'])){
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);

            if($row['role'] != $login_role){
                $showError = "Wrong panel login!";
            } else {
                $_SESSION['email'] = $row['email'];
                $_SESSION['loggedin'] = true;
                $_SESSION['name'] = $row['name'];
                $_SESSION['role'] = $row['role'];

                if($row['role'] == 'admin'){
                    header("location: admin/dashboard.php");
                } else {
                    header("location: index.php");
                }
                exit();
            }
        } else {
            $showError = "Invalid credentials!";
        }
    }

    // SIGNUP (only user)
    if(isset($_POST['signup']) && $login_role == 'user'){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];

        $check = mysqli_query($conn,"SELECT * FROM user WHERE email='$email'");
        if(mysqli_num_rows($check) > 0){
            $showError = "Email already exists!";
        } else {
            if($password == $cpassword){
                mysqli_query($conn,"INSERT INTO user (name,email,password,role,dt) VALUES ('$name','$email','$password','user',NOW())");
                $showAlert = true;
            } else {
                $showError = "Password not match!";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tourly</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./assets/images/titleLogo.png" type="image/svg+xml">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

      <style>body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #f8fbff, #eef3f9);
    margin: 0;
    padding: 0;
}

/* subtle pattern */
body::before {
    content: "";
    position: fixed;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at 20% 20%, rgba(0,114,255,0.05), transparent 40%),
                radial-gradient(circle at 80% 80%, rgba(255,106,0,0.05), transparent 40%);
    z-index: -1;
}

/* 🔝 Top bar */
.top-bar {
    position: absolute;
    top: 20px;
    left: 20px;
    right: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 999;
}

/* 🔙 Back */
.back-btn {
    background: #fff;
    color: #333;
    padding: 10px 18px;
    border-radius: 30px;
    border: 1px solid #ddd;
    text-decoration: none;
    transition: 0.3s;
}
.back-btn:hover {
    background: #0072ff;
    color: #fff;
}

/* 🔐 Signup */
.signup-btn {
    background: linear-gradient(45deg, #ff6a00, #ee0979);
    color: #fff;
    padding: 10px 20px;
    border-radius: 30px;
    text-decoration: none;
}

/* 🔥 Auth container */
.auth-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Box */
.form-box {
    width: 400px;
    height: 500px; /* IMPORTANT FIX */
    position: relative;
    overflow: hidden;
}

/* Forms */
.form {
    position: absolute;
    width: 100%;
    height: 100%;
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: 0.5s;
}

/* Positions */
.login-form { left: 0; }
.signup-form { left: 100%; }

/* Toggle */
.form-box.active .login-form { left: -100%; }
.form-box.active .signup-form { left: 0; }

/* Admin mode */
.admin-only .signup-form { display: none; }

/* Heading */
h2 {
    text-align: center;
    margin-bottom: 20px;
}

/* Input group */
.input-group {
    position: relative;
    margin-bottom: 20px;
}

.input-group input {
    width: 100%;
    padding: 12px 40px 12px 10px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background: #f9fbfd;
}

.input-group label {
    position: absolute;
    top: 12px;
    left: 10px;
    color: #777;
    transition: 0.3s;
}

.input-group input:focus + label,
.input-group input:valid + label {
    top: -10px;
    font-size: 12px;
    color: #0072ff;
}

/* 👁 icon */
.toggle-password {
    position: absolute;
    right: 10px;
    top: 12px;
    cursor: pointer;
}

/* Button */
button {
    width: 100%;
    padding: 12px;
    border: none;
    background: linear-gradient(45deg, #0072ff, #00c6ff);
    color: #fff;
    border-radius: 25px;
    cursor: pointer;
}

/* Switch */
.switch-btn {
    color: #0072ff;
    cursor: pointer;
    font-weight: 500;
}

/* Alerts */
.alertx {
    padding: 15px;
    background: #ff4d4d;
    color: white;
    margin: 20px auto;
    border-radius: 8px;
    width: 60%;
    text-align: center;
}

.success {
    background: #28a745;
}</style>
<body>

<div class="top-bar">
    <a href="selectpage.html" class="back-btn">
    <i class="fa-solid fa-arrow-left"></i> Back
</a>
</div>

<?php 
if($showAlert){
echo "<div class='alertx success'>Account created successfully!</div>";
}
if($showError){
echo "<div class='alertx'>$showError</div>";
}
?>
<div class="auth-container">
    <div class="form-box <?php echo ($login_role=='user')?'':'admin-only'; ?>">

        <!-- 🔐 LOGIN -->
        <form method="POST" class="form login-form">
            <h2>
                <?php echo ($login_role=='admin') ? "🔐 Admin Login" : "👤 User Login"; ?>
            </h2>

            <div class="input-group">
                <input type="email" name="email" required>
                <label>📧 Email</label>
            </div>

            <div class="input-group">
                <input type="password" id="loginPass" name="password" required>
                <label>🔒 Password</label>
                <span onclick="togglePass('loginPass')" class="toggle-password">👁</span>
            </div>

            <button name="login">🚀 Login</button>

            <?php if($login_role=='user'){ ?>
            <p>Don't have account? 
                <span onclick="toggleForm()" class="switch-btn">📝 Signup</span>
            </p>
            <?php } ?>
        </form>

        <!-- 📝 SIGNUP -->
        <?php if($login_role=='user'){ ?>
        <form method="POST" class="form signup-form">
            <h2>📝 Signup</h2>

            <div class="input-group">
                <input type="text" name="name" required>
                <label>👤 Name</label>
            </div>

            <div class="input-group">
                <input type="email" name="email" required>
                <label>📧 Email</label>
            </div>

            <div class="input-group">
                <input type="password" id="signPass" name="password" required>
                <label>🔒 Password</label>
                <span onclick="togglePass('signPass')" class="toggle-password">👁</span>
            </div>

            <div class="input-group">
                <input type="password" id="cpass" name="cpassword" required>
                <label>🔑 Confirm Password</label>
                <span onclick="togglePass('cpass')" class="toggle-password">👁</span>
            </div>

            <button name="signup">✨ Create Account</button>

            <p>Already have account? 
                <span class="switch-btn" onclick="toggleForm()">🔐 Login</span>
            </p>
        </form>
        <?php } ?>

    </div>
</div>
</body>
<script>
setTimeout(() => {
    document.querySelectorAll('.alertx').forEach(el => {
        el.style.display = "none";
    });
}, 3000);

function toggleForm(){
    document.querySelector('.form-box').classList.toggle('active');
}

function togglePass(id){
    let x = document.getElementById(id);
    x.type = x.type === "password" ? "text" : "password";
}

</script>
</html>    