<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="keywords" content="HTML, CSS, JavaScript, PHP">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <style type="text/css">
            <?php include "../css/regform.css";?>
            @import url("../css/regform.css");
            <?php include "../css/roomybookandco.css";?>
            @import url("../css/roomybookandco.css");
        </style>

        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
        <script type="text/javascript" src="../js/formValidation.js"></script>
        <script src="https://kit.fontawesome.com/4e82bbc21f.js" crossorigin="anonymous"></script>
        
        <script src="../js/roomybook.js" defer></script>
        <title>Roomy Book and Co</title>
    </head>
    <body>
        <!--navigation bar-->
        <header>
            <div class="logo"><img src="../images/roomybookandco_logo.png" alt="roomy book and co logo"></div>
            <nav>
                <ul>
                    <li><a href="../pages/viewBook.php">View Books</a></li>
                    <li><a href="../pages/addBookForm.php">Add Books</a></li>
                    
                    <!-------------Only Admin can access to Create Account----------------->
                    <?php
                    if (isset($_SESSION["accessRights"])) {
                        if ($_SESSION["accessRights"] == "admin")
                            echo '<li><a href="../pages/regForm.php"> Create Account</a></li>';
                        }
                    ?>

                    <li><a href="../pages/logout.php"><i class="fas fa-sign-out-alt" style="font-size: 12pt; margin-right: 6px;"></i>Logout</a></li>
                </ul>
            </nav>
            <div class="menu-toggle"><i class="fas fa-bars"></i></div>
        </header>
        <div class="reg-title">
            <h1>Create Account</h1>
        </div>
        <!--registeration form-->
        <div id="form-container" class="sub-heading">
            <h2>Login Details</h2>
            <form id="regform" action="../../controller/processRegistration.php" onsubmit="return formValidation();" method="POST">
                <div class="form-col">
                    <div class="field-icon">
                        <label for="uname">Username<span class="required"></span></label>
                        <i class="fas fa-user"></i>
                        <input type="text" name="user" id="user" placeholder="Username" required>
                        <div id="error_message"></div>
                    </div>
                    <div class="field-icon">
                        <label for="upass">Password<span class="required"></span></label>
                        <i class="fas fa-lock"></i>
                        <input type="text" name="pass" id="pass" placeholder="Password" required>
                        <div id="error_message"></div>
                    </div>
                    <div class="field-icon">
                        <label for="urole">Access Rights<span class="required"></span></label>
                        <i class="fas fa-key"></i>
                        <input type="text" name="access" id="access" placeholder="Access Rights" required>
                        <div id="error_message"></div>
                    </div>
                </div>

                <!--registration details-->
                <h2>User Details</h2>
                <div class="form-col-2">
                    <div class="field-icon">
                        <label for="fname">First Name<span class="required"></span></label>
                        <i class="fas fa-user"></i>
                        <input type="text" name="fname" id="fname" placeholder="First Name" required>
                        <div id="error_message"></div>
                    </div>
                    <div class="field-icon">
                        <label for="lname">Last Name<span class="required"></span></label>
                        <i class="fas fa-user"></i>
                        <input type="text" name="lname" id="lname" placeholder="Last Name" required>
                        <div id="error_message"></div>
                    </div>
                    <div class="field-icon">
                        <label for="email">Email<span class="required"></span></label>
                        <i class="fas fa-at"></i>
                        <input type="text" name="email" id="email" placeholder="Email" required>
                        <div id="error_message"></div>
                    </div>
                </div>
                <div class="btn-submit">
                    <input type="submit" value="Sign Up">
                </div>
            </form>
        </div>
        <footer><p>&copy; 2020 LT Creative. All rights reserved.</p></footer>
    </body>
</html>