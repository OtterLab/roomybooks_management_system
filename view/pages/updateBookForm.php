<?php 
//session_start();
require("../../model/dbConnection.php");
require("../../model/dbFunctions.php");
require("../../controller/inputFilter.php");

// set the Time Zone
date_default_timezone_set('Australia/Brisbane');

$bookID=$_GET['BookID'];

// select statement
$bstmt = $conn->prepare("SELECT * FROM book WHERE BookID = $bookID");
$bstmt->execute();
$bookrow = $bstmt->fetch();

$authorID = $bookrow['AuthorID'];

$astmt = $conn->prepare("SELECT * FROM author WHERE AuthorID = $authorID");
$astmt->execute();
$arow = $astmt->fetch();


$cdate = date('Y-m-d H:i:s');
$uID = $_SESSION['username'];


$stmt =$conn->prepare('SELECT loginID, username FROM login WHERE username=:username');
$stmt->bindValue(":username",$uID);
$stmt->execute();
$lrow = $stmt -> fetch();
$loginID = $lrow['loginID'];

$stmt =$conn->prepare('SELECT userID FROM users WHERE loginID=:loginID');
$stmt->bindValue(":loginID",$loginID);
$stmt->execute();
$urow = $stmt -> fetch();
$user = $urow['userID'];

if ($bstmt->rowCount()>=1){

}

?>

<!--======================================Update Book Form=========================================-->
<style type="text/css">
    <?php include "../css/bookform.css";?>
    @import url("../css/bookform.css");
</style>
    <div class="bookform-container">
            <form id="bform" action="../../controller/processUpdateBook.php" method="POST">
                <div class="book-heading">
                    <i class="fas fa-book"></i>
                    <h2>Update Book</h2>
                    <legend>Book<?php echo "ID". $bookID?>Details</legend>
                </div>
                <!-- seperate form elements-->
                    <div class="formhide">
                        <input type="hidden" name="bookID" value="<?php echo $bookrow["BookID"];?>">   
                    </div>
                    <div class="formhide">
                        <input type="hidden" name="date" value="<?php echo $cdate;?>">
                    </div>
                    <div class="formhide">
                        <input type="hidden" name="user" value="<?php echo $user;?>">
                    </div>
                    <div class="grid-col" id="formbox">
                    <div class="formfield">
                        <label for="booktitle">Book Title<span class="required"></span></label>
                        <input type="text" name="booktitle" placeholder="Book Title" value="<?php echo $bookrow["BookTitle"];?>">
                    </div>
                    <div class="formfield">
                        <label for="orginaltitle">Original Title<span class="required"></span></label>
                        <input type="text" name="originaltitle" placeholder="Original Title" value="<?php echo $bookrow["OriginalTitle"];?>">
                    </div>
                    <div class="formfield">
                        <label for="yearpub">Year of Publication<span class="required"></span></label>
                        <input type="text" name="yearpub" placeholder="Year of Publication" value="<?php echo $bookrow["YearofPublication"];?>">
                    </div>
                    <div class="formfield">
                        <label for="genre">Genre<span class="required"></span></label>
                        <input type="text" name="genre" placeholder="Genre" value="<?php echo $bookrow["Genre"];?>">
                    </div>
                    <div class="formfield">
                        <label for="msold">Millions Sold<span class="required"></span></label>
                        <input type="text" name="msold" placeholder="Millions Sold" value="<?php echo $bookrow["MillionsSold"];?>">
                    </div>
                    <div class="formfield">
                        <label for="lang">Language<span class="required"></span></label>
                        <input type="text" name="lang" placeholder="Language" value="<?php echo $bookrow["LanguageWritten"];?>">
                    </div>
                    <div class="formfield">
                        <label for="coverimg">Cover Image Path<span class="required"></span></label>
                        <input type="file" name="coverimg" accept="image/gif, image/png" value="<?php echo $bookrow["coverImagePath"];?>">
                    </div>
                </div>

            <!--======================================Add Author Form=========================================-->
            <!--------------line divider--------------->
            <div class="divider"></div>

                <div class="author-heading">
                    <i class="fas fa-user"></i>
                    <h3>Update Author</h3>
                </div>
                    <div class="grid-col" id="formbox">
                    <div class="formfield">
                            <label for="auID">Author ID<span class="required"></span></label>
                            <input type="text" name="auID" placeholder="Author ID" value="<?php echo $bookrow["AuthorID"];?>">
                        </div>
                        <div class="formfield">
                            <label for="aname">Author Name<span class="required"></span></label>
                            <input type="text" name="aname" placeholder="Author Name" value="<?php echo $arow["Name"];?>">
                        </div>
                        <div class="formfield">
                            <label for="sname">Author Surname<span class="required"></span></label>
                            <input type="text" name="sname" placeholder="Author Surname" value="<?php echo $arow["Surname"];?>">
                        </div>
                        <div class="formfield">
                            <label for="anation">Nationality<span class="required"></span></label>
                            <input type="text" name="anation" placeholder="Nationality" value="<?php echo $arow["Nationality"];?>">
                        </div>
                        <div class="formfield">
                            <label for="birthyr">Birth Year<span class="required"></span></label>
                            <input type="text" name="birthyr" placeholder="Birth Year" value="<?php echo $arow["BirthYear"];?>">
                        </div>
                        <div class="formfield">
                            <label for="deathyr">Death Year<span class="required"></span></label>
                            <input type="text" name="deathyr" placeholder="Death Year" value="<?php echo $arow["DeathYear"];?>">
                        </div>
                  </div>
                  <!--author submit button-->
                  <div class="formfield">
                    <input type="submit" value="Save">
                </div>
            </form>
        </div>

                        