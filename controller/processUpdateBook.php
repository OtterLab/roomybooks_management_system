<?php
session_start();
require("../model/dbConnection.php");
require("../model/dbFunctions.php");
require("../controller/inputFilter.php");

if (!empty([$_POST])) {
    // input sanitation via inputFilter function
    $auName = inputFilter($_POST['aname']);
    $auSurname = inputFilter($_POST['sname']);
    $auNation = inputFilter($_POST['anation']);
    $auBirthyr = inputFilter($_POST['birthyr']);
    $auDeathyr = inputFilter($_POST['deathyr']);
    $bookID = inputFilter($_POST['bookID']);
    $bookTitle = inputFilter($_POST['booktitle']);
    $oTitle = inputFilter($_POST['originaltitle']);
    $yearofPub = inputFilter($_POST['yearpub']);
    $genre = inputFilter($_POST['genre']);
    $millsSold = inputFilter($_POST['msold']);
    $language = inputFilter($_POST['lang']);
    $coverImage = inputFilter($_POST['coverimg']); $defaultcover;
    $authorID = inputFilter($_POST['auID']);
    $date = inputFilter($_POST['date']);
    $user = inputFilter($_POST['user']); 

    // function call update
    updateAuthorBook($auName, $auSurname, $auNation, $auBirthyr, $auDeathyr, $bookID, $bookTitle, 
    $oTitle, $yearofPub, $genre, $millsSold, $language, $coverImage, $authorID, $date, $user);
    
    // direct to the view book page
    header('location:../view/pages/viewBook.php?id=updateBookForm');
    echo "Book has been updated";
}
    else {
        echo "Record couldn't be updated";
    }

?>