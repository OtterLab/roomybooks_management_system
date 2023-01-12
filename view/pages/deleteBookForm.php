<?php 
require("../../model/dbConnection.php");
require("../../model/dbFunctions.php");
require("../../controller/inputFilter.php");

$bookID = $_GET['BookID'];

//echo $bookID;


$bstmt = $conn->prepare("SELECT * FROM book WHERE BookID = :bID");
$bstmt->bindValue(':bID', $bookID);
$bstmt->execute();
$bookrow = $bstmt->fetch();


// if ($bstmt->rowCount()>=1) {
//  echo "book ". $bookID. " the book your going to delete?";
// }
?>

<!--======================================Delete Book Form=========================================-->
<style type="text/css">
    <?php include "../css/bookform.css";?>
    @import url("../css/bookform.css");
</style>

<div class="bookform-container">
    <legend>Book<?php echo "ID". $bookID?>Details</legend>
    <h3>Would you like to delete this Book?</h3>
    <form id="bform" action="../../controller/processDeleteBook.php" method="POST">
    <div class="delform">
        <label for="delbook">Delete Book ID</label>
        <input type="text" name="bookID" value="<?php echo $bookrow["BookID"];?>">
    </div>
    <div class="delinput">
        <input type="submit" value="Delete Book">
    </div>
    </form>
</div>