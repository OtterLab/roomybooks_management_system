<?php 
require("../model/dbConnection.php");
require("../model/dbFunctions.php");
require("inputFilter.php");

if(!empty([$_POST])) {
    // input sanitation via inputFilter
    $auName = inputFilter($_POST['aname']);
    $auSurname = inputFilter($_POST['sname']);
    $auNation = inputFilter($_POST['anation']);
    $auBirthyr = inputFilter($_POST['birthyr']);
    $auDeathyr = inputFilter($_POST['deathyr']);

    // function call
    addAuthor($auName, $auSurname, $auNation, $auBirthyr, $auDeathyr);
    echo "New Author Inserted";

    // Check if Author already exists
    $stmt = $conn->prepare('SELECT Name, Surname, AuthorID FROM author WHERE Name= :aname AND Surname= :sname');
    $stmt->bindValue(':aname', $auName);
    $stmt->bindValue(':sname', $auSurname);
    $stmt->execute();
    $rows = $stmt->fetch();
    $lastAuID = $rows['AuthorID'];

    if($stmt->rowCount() < 1){ //If one Author already exists, Same Author should not be inserted 
        else {
            echo "Author already exists";
        }
    }

    // direct to the add book page
    header('location:../view/pages/addBookForm.php');
}
else {
    echo "Record couldn't be inserted";
}


?>