<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Login</title>
</head>
<body>
   <div class="container" id="container">
      <div class="form-container sign-up"> 
        <form method="post" action="">
            <h2>Create Account</h2>
            <input type="text" name="name" placeholder="Name">
            <input type="email" name="email" placeholder="Email">
            <input type="number" name="number" placeholder="Enter Your Number">
            <input type="password" name="pass" placeholder="Password">
            <input type="password" name="cpass" placeholder="Confirm Password">
            <!-- <input type="date" name="birthdate" placeholder="Tanggal Lahir"> -->
            <form>
                <!-- <input type="radio" id="female" name="gender" value="female">
                <label for="female">Female</label><br>    
                <input type="radio" id="male" name="gender" value="male">
                <label for "male">Male</label><br> -->
                <button type="submit" name="register_submit">Register</button>
            </form>  
        </form>
      </div>


      <div class="form-container sign-in">
        <form method="post" action="">
            <h2>Sign In</h2>
            <input type="email" name="email" placeholder="Enter your email">
            <input type="password" name="pass" placeholder="Password">
            <span>or use</span>
            <div class="social-icons">
                <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
            <label for="captcha">Enter the CAPTCHA code: </label>
         <input type="text" name="captcha" id="captcha" required>
         <span id="captchaCode" class="box"><?php echo generateCaptchaCode(); ?></span>
         <!-- <button type="button" id="submitCaptcha" class="btn">Submit CAPTCHA</button> -->
            <a href="#">Forget Your Password?</a>
            <button type="submit" name="login_submit">Sign In</button>
        </form>
      </div>


      <div class="toggle-container">
         <div class="toggle">
            <div class="toggle-panel toggle-left">
               <h1>Welcome To Our Restaurant</h1>
               <p>Please Enter your usename details to enter the Restaurant</p>
               <button class="hidden" id="login">Sign In</button>
                </div>
            <div class="toggle-panel toggle-right">
               <h1>Hello, Friend!</h1>
               <p>Register with your personal details to use all site features</p>
               <button class="hidden" id="register">Sign Up</button>
            </div>
         </div>
      </div>
   </div>
<?php
include 'components/connect.php';
session_start();

function generateCaptchaCode($length = 6) {
    return substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZqwertyuiopasdfghjklzxcvbnm"), 0, $length);
 }

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredCaptcha = isset($_POST['captcha']) ? $_POST['captcha'] : '';
    
    // Verify the entered CAPTCHA code
    $captchaCode = isset($_SESSION['captcha_code']) ? $_SESSION['captcha_code'] : '';
} else {
    // If it's not a POST request (e.g., when the page is initially loaded), generate a new CAPTCHA code and store it in the session
    $captchaCode = generateCaptchaCode();
    $_SESSION['captcha_code'] = $captchaCode;
 }
 



if (isset($_POST['login_submit'])) { 
            // Login Logic
            $email = $_POST['email'];
            $email = filter_var($email, FILTER_SANITIZE_STRING);
            $pass = sha1($_POST['pass']);
            $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        
            $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
            $select_user->execute([$email, $pass]);
            $row = $select_user->fetch(PDO::FETCH_ASSOC);
        
            if ($select_user->rowCount() > 0) {
                $_SESSION['user_id'] = $row['id'];
                header('location:home.php');
            } else {
                $message[] = 'incorrect username or password!';
                exit;
            }
        
        } 
        
    


    

if (isset($_POST['register_submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR number = ?");
    $select_user->execute([$email, $number]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        $message[] = 'email or number already exists!';
    } else {
        if ($pass != $cpass) {
            $message[] = 'confirm password not matched!';
        } else {
            $insert_user = $conn->prepare("INSERT INTO `users`(name, email, number, password) VALUES(?,?,?,?)");
            $insert_user->execute([$name, $email, $number, $cpass]);
            $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
            $select_user->execute([$email, $pass]);
            $row = $select_user->fetch(PDO::FETCH_ASSOC);
            if ($select_user->rowCount() > 0) {
                $_SESSION['user_id'] = $row['id'];
                header('location:home.php');
            }
        }
    }
}
    ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
               document.querySelector('#submitCaptcha').addEventListener('click', function () {
                     var enteredCaptcha = document.querySelector('#captcha').value;
                     var captchaCode = document.querySelector('#captchaCode').textContent;
                     if (enteredCaptcha === captchaCode) {
                        document.querySelector('#loginButton').style.display = 'block';
                        document.querySelector('#submitCaptcha').style.display = 'none';
                     } else {
                        alert('CAPTCHA code is incorrect. Please try again.');
                     }
               });
            });
   const container = document.getElementById("container");
const registerBtn = document.getElementById("register");
const loginBtn = document.getElementById("login");

registerBtn.addEventListener("click", () => {
  container.classList.add("active");
});

loginBtn.addEventListener("click", () => {
  container.classList.remove("active");
});


</script>
</body>
</html>


