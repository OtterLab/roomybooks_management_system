<?php 
// start a session
session_start();
//if (!$_SESSION['Login']) {
   // header("location: ../../index.php");
 //   exit;
//  }
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style type="text/css">
        <?php include "../css/roomybookandco.css";?>
        @import url("../css/roomybookandco.css");
    </style>
        <script src="https://kit.fontawesome.com/4e82bbc21f.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <script src="../js/roomybook.js" defer></script>
        <script src="../js/formValidation.js" defer></script>
        <title>Roomy Book and Co</title>
    </head>
    <body>
        <header>
            <div class="logo"><a href="../pages/viewBook.php"><img src="../images/roomybookandco_logo.png" alt="roomy book and co logo"></a></div>
            <nav>
                <ul>
                    <li class="active"><a href="../pages/viewBook.php">View Books</a></li>
                    <li><a href="../pages/addBookForm.php">Add Books</a></li>
                    
                    <!-------------Only Admin can access to Create Account----------------->
                    <?php
                    if (isset($_SESSION["accessRights"])) {
                        if ($_SESSION["accessRights"] == "admin")
                            echo '<li><a href="../pages/regForm.php">Create Account</a></li>';
                        }
                    ?>

                    <li><a href="../pages/logout.php"><i class="fas fa-sign-out-alt" style="font-size: 12pt; margin-right: 6px;"></i>Logout</a></li>
                </ul>
            </nav>
            <div class="menu-toggle"><i class="fas fa-bars"></i></div>
        </header>

        <!---------------------Show user access when logged in------------------------>
        <div class="log-info">
        <p>Hi, 
            <b><?php echo htmlspecialchars($_SESSION["username"]);?></b>
            logged in as
            <b><?php echo $_SESSION["accessRights"];?></b>
        </p>
        </div>

        <!--------------line divider--------------->
        <div class="divider"></div>

        <div id="title">
            <h2>Most popular of all books</h2>
        </div>
      <article class="binfo">
      <?php
            if (isset($_GET['link'])) {
            $pageLink = $_GET['link'];
            switch ($pageLink) {
                case 'edit':
                    require_once('updateBookForm.php');
                    break;

                    case 'delete':
                        require_once('deleteBookForm.php');
                    break;
                    }
                } 
                else {
                include '../../controller/processAllBooks.php';
            }
            ?>
        
      </article>
  
        <footer><p>&copy; 2020 LT Creative. All rights reserved.</p></footer>
    </body>
</html>

