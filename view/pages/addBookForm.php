<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="keywords" content="HTML, CSS, JavaScript, PHP">
        <style type="text/css">
            <?php include "../css/bookform.css";?>
            @import url("../css/bookform.css");
            <?php include "../css/roomybookandco.css";?>
            @import url("../css/roomybookandco.css");
        </style>
        
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/4e82bbc21f.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../js/roomybook.js" defer></script>
        <script src="../js/formValidation.js" defer></script>
        <title>Roomy Book and Co</title>
    </head>
    <body>
        <!--navigation bar-->
        <header>
            <div class="logo"><a href="../pages/viewBook.php"><img src="../images/roomybookandco_logo.png" alt="roomy book and co logo"></a></div>
            <nav>
                <ul>
                    <li><a href="../pages/viewBook.php">View Books</a></li>
                    <li class="active"><a href="../pages/addBookForm.php">Add Books</a></li>
                    
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
        <div class="bookform-container">
            <form id="bform" action="../../controller/processAddBookForm.php" method="POST">
                <div class="book-heading">
                    <i class="fas fa-book"></i>
                    <h2>Add New Book</h2>
                </div>
                <!-- seperate form elements-->
                <div class="grid-col" id="formbox">
                    <div class="formfield">
                        <label for="booktitle">Book Title<span class="required"></span></label>
                        <input type="text" name="booktitle" placeholder="Book Title" required>
                    </div>
                    <div class="formfield">
                        <label for="orginaltitle">Original Title<span class="required"></span></label>
                        <input type="text" name="originaltitle" placeholder="Original Title" required>
                    </div>
                    <div class="formfield">
                        <label for="yearpub">Year of Publication<span class="required"></span></label>
                        <input type="text" name="yearpub" placeholder="Year of Publication" required>
                    </div>
                    <div class="formfield">
                        <label for="genre">Genre<span class="required"></span></label>
                        <input type="text" name="genre" placeholder="Genre" required>
                    </div>
                    <div class="formfield">
                        <label for="msold">Millions Sold<span class="required"></span></label>
                        <input type="text" name="msold" placeholder="Millions Sold" required>
                    </div>
                    <div class="formfield">
                        <label for="lang">Language<span class="required"></span></label>
                        <input type="text" name="lang" placeholder="Language" required>
                    </div>
                    <div class="formfield">
                        <label for="coverimg">Cover Image Path<span class="required"></span></label>
                        <input type="file" name="coverimg" accept="image/gif, image/png" required>
                    </div>
                </div>
                <!--book submit button-->
                <!-- <div class="formfield">
                    <input type="submit" id="send-book" value="Add Book">
                </div> -->
            

            <!--======================================Add Author Form=========================================-->
            <!--------------line divider--------------->
            <div class="divider"></div>

            <!-- <form id="auform" action="../../controller/processAddAuthorForm.php" method="POST"> -->
                <div class="author-heading">
                    <i class="fas fa-user"></i>
                    <h3>Add Author</h3>
                </div>
                    <div class="grid-col" id="formbox">
                        <div class="formfield">
                            <label for="aname">Author Name<span class="required"></span></label>
                            <input type="text" name="aname" placeholder="Author Name" required>
                        </div>
                        <div class="formfield">
                            <label for="sname">Author Surname<span class="required"></span></label>
                            <input type="text" name="sname" placeholder="Author Surname" required>
                        </div>
                        <div class="formfield">
                            <label for="anation">Nationality<span class="required"></span></label>
                            <input type="text" name="anation" placeholder="Nationality" required>
                        </div>
                        <div class="formfield">
                            <label for="birthyr">Birth Year<span class="required"></span></label>
                            <input type="text" name="birthyr" placeholder="Birth Year" required>
                        </div>
                        <div class="formfield">
                            <label for="deathyr">Death Year<span class="required"></span></label>
                            <input type="text" name="deathyr" placeholder="Death Year">
                        </div>
                  </div>
                  <!--author submit button-->
                  <div class="formfield">
                    <input type="submit" id="send-item" value="Add Book and Author">
                </div>
            </form>
        </div>
        <footer><p>&copy; 2020 LT Creative. All rights reserved.</p></footer>
    </body>
</html>