<?php 
require("../model/dbConnection.php");
require("../model/dbFunctions.php");
require("inputFilter.php");

if (!empty([$_POST])) {
    $bookID = inputFilter($_POST['bookID']);
    
    deleteBook($bookID, $bookTitle);
    $_SESSION['msg'] = "Book" .$bookTitle. " has been deleted.";
    header('location:../view/pages/viewBook.php');
    
    echo "Book Info deleted";
}
else {
    $_SESSION["msg"]= "The" .$bookTitle. "couldn't be deleted";
}

?>
