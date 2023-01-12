<?php
// session start
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require("../model/dbConnection.php");
require("inputFilter.php");
// input via POST method

if(!empty($_POST)) {
    $Uname = inputFilter($_POST['user']);
    $hPass = inputFilter($_POST['pass']);

    $stmt = $conn->prepare("SELECT LoginID, password, accessRights FROM login WHERE username=:user");
    $stmt->bindParam(':user', $Uname);
    $stmt->execute();
    $row = $stmt -> fetch();
    if (password_verify($hPass, $row['password'])){
        // assign session variables
        $_SESSION["username"] = $Uname;
        $_SESSION["loginid"] = $row["LoginID"];
        $_SESSION["accessRights"] = $row["accessRights"];
        $_SESSION["login"] = 'yes';
        
        header('location:../view/pages/viewBook.php');
        echo "Your are now logged in";
        
    }
    else{
        echo "Incorrect Username or Password";
    }
}


?>


