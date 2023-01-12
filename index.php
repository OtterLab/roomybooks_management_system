<?php 
session_start();
//if(!$_SESSION['login']){
    //header("Location:../../index.php");
   // exit;
//}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="keywords" content="HTML, CSS, JavaScript, PHP">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <style type="text/css">
            <?php include "view/css/login.css";?>
            @import url("view/css/login.css");
        </style>

        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
        <script src="view/js/login_validation.js" defer></script>
        <script src="https://kit.fontawesome.com/4e82bbc21f.js" crossorigin="anonymous"></script>
        <title>Roomy Book and Co</title>
    </head>
    <body>
        <div id="logo">
            <img src="view/images/roomybookandco_logo.png" alt="roomy book and co logo">
        </div>

        <!--login form-->
        <div id="form-container">
            <form id="logform" action="../roomybookstore/controller/processLogin.php" method="POST">
                <h1>Log In</h1>
                <p>Enter your login details below</p>
                <div class="form-icon">
                    <label for="uname">Username</label>
                    <i class="fas fa-user"></i>
                    <input type="text" id="uname" name="user" placeholder="Username" required>
                    <div class="error hide">Please enter your username</div>
                </div>
                <div class="form-icon">
                    <label for="upass">Password</label>
                    <i class="fas fa-lock"></i>
                    <input type="text" id="upass" name="pass" placeholder="Password" required>
                    <div class="error hide">Please enter your password</div>
                </div>
                
                <div class="btn-field">
                    <input type="submit" id="send-login" value="Login">
                </div>

                <!--Registration form direct link-->
                <!--<div class="reg-info">
                    <p>If not a member. Sign up</p>
                    <a class="signup-btn" href="../roomybookstore/view/pages/regForm.php">Sign up</a>
                </div>-->
            </form>
        </div>
    </body>
</html>





