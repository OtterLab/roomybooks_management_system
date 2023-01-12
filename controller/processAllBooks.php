<?php
//session_start();
require("../../model/dbConnection.php");
require("../../model/dbFunctions.php");

$stmt = $conn->prepare('SELECT * FROM Book ORDER BY BookTitle');
$stmt->execute();
$result = $stmt-> fetchAll();
$numRows= $stmt->rowCount();

$_SESSION["books"]=$numRows;

if($numRows <1){
    echo "No Books available"."</br>";
} else{
    
    // echo '<table><th></th>';
    echo '<div class="book-list">';
    echo '<div class="flex-container" id="btn-input">';
     foreach ($result as $row){

    ?>

<!----------------------------------Display All Books-------------------------------------->
  <div class="book">
    <img src="../images/bookcover/<?php echo $row['coverImagePath']?>" alt="Book Cover Image">
    <h3><?php echo $row['BookTitle']?></h3>
    <p><?php echo $row['Genre']?></p>
    <h4>Millions Sold</h4><p><?php echo $row['MillionsSold']?></p>
    <div class="edit-btn"><a href="?link=edit&BookID=<?php echo $row['BookID']?>">edit</a></div>
    <div class="del-btn"><a href="?link=delete&BookID=<?php echo $row['BookID']?>">delete</a></div>
  </div>


<?php
//$bookRows=$_SESSION['books'];

//$_SESSION['msg']="There are ". $bookRows. " books in the database";

//SelectAllBooks();
     }
}
echo '</div>';
echo '</div>';
?>

