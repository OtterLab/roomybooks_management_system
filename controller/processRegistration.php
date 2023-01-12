<?php 
session_start();
require("../model/dbConnection.php");
require("../model/dbFunctions.php");
require("inputFilter.php");
if (!empty([$_POST])) {
    
    $Uname = inputFilter($_POST['user']);
    $mypass = inputFilter($_POST['pass']);
    $accRights = inputFilter($_POST['access']);
    $Fname = inputFilter($_POST['fname']);
    $Lname = inputFilter($_POST['lname']);
    $Email = inputFilter($_POST['email']);

    // hashing the password with PASSWORD_HASH()
    $hPass = password_hash($mypass, PASSWORD_DEFAULT);
    $query = $conn->prepare("SELECT username FROM login WHERE username = :user");
    $query->bindValue(":user", $Uname);
    $query->execute();
    if ($query->rowCount() < 1) { //If user does not exists
    newUser($Uname, $hPass, $accRights, $Fname, $Lname, $Email); // function call
    echo "User account has been created";
    
    // direct them to the index page to login
    header('location:../index.php');
}
else {
    echo "User already exists";
}
}

?>