<?php
session_start();

$userID = $_SESSION['username'];

require("../model/dbConnection.php");
require("../model/dbFunctions.php");
require("inputFilter.php");
$defaultcover = "coming_soon_cover.png";

if (!empty([$_POST])) {
    // input sanitation via inputFilter function
    $bookTitle = inputFilter($_POST['booktitle']);
    $oTitle = inputFilter($_POST['originaltitle']);
    $yearofPub = inputFilter($_POST['yearpub']);
    $genre = inputFilter($_POST['genre']);
    $millsSold = inputFilter($_POST['msold']);
    $language = inputFilter($_POST['lang']);
    $coverImage = inputFilter($_POST['coverimg']); $defaultcover;
    $auName = inputFilter($_POST['aname']);
    $auSurname = inputFilter($_POST['sname']);
    $auNation = inputFilter($_POST['anation']);
    $auByr = inputFilter($_POST['birthyr']);
    $auDyr = inputFilter($_POST['deathyr']);

    // SESSION
    $username = $_SESSION["username"];
    
    $stmt =$conn->prepare('SELECT loginID, username FROM login WHERE username= :username');
    $stmt->bindValue(":username",$username);
    $stmt->execute();
    $lrow = $stmt -> fetch();
    $loginID = $lrow['loginID'];

    $stmt =$conn->prepare('SELECT userID FROM users WHERE loginID=:loginID');
    $stmt->bindValue(":loginID",$loginID);
    $stmt->execute();
    $urow = $stmt -> fetch();
    $user = $urow['userID'];

    $astmt = $conn->prepare('SELECT AuthorID, name, Surname FROM author WHERE Name = :aname AND Surname = :sname');
    $astmt->bindValue(":aname", $auName);
    $astmt->bindValue(":sname", $auSurname);
    $astmt->execute();
    $authRow = $astmt -> fetch();
    $authID = $authRow['AuthorID'];
    
    if ($astmt->rowCount() < 1){

        echo "No Author";
    
        addAuthorBook($bookTitle, $oTitle, $yearofPub, $genre, $millsSold, $language, $coverImage, $auName, $auSurname, $auNation, $auByr, $auDyr, $user);

    } else {
        echo " Author Already Exists";
        // function call
        addBook($bookTitle, $oTitle, $yearofPub, $genre, $millsSold, $language, $coverImage, $authID, $user);

    }

    // direct to the view book page
    header('location:../view/pages/viewBook.php?id=addBookForm');
}
    else {
        echo "Record couldn't be inserted";
    }
?>