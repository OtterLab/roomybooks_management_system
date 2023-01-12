<?php
function newUser($Uname, $hPass, $accRights, $Fname, $Lname, $Email)
{
    global $conn;
    try {
        $conn->beginTransaction();
        $stmt = $conn->prepare("INSERT INTO login(username, password, accessRights)
        VALUES (:user, :pass, :access)");
        $stmt->bindValue(':user', $Uname);
        $stmt->bindValue(':pass', $hPass);
        $stmt->bindValue(':access', $accRights);
        $stmt->execute();

        // last inserted = loginID
        $lastUserID = $conn->lastInsertId();
        $stmt = $conn->prepare("INSERT INTO users(firstName, lastName, email, loginID)
        VALUES (:fname, :lname, :email, :loginID)");
        $stmt->bindValue(':fname', $Fname);
        $stmt->bindValue(':lname', $Lname);
        $stmt->bindValue(':email', $Email);
        $stmt->bindValue(':loginID', $lastUserID);
        $stmt->execute();
        $conn->commit(); // save to database
    }
    catch (PDOException $ex) {
        $conn->rollBack(); // Something went wrong rollBack!
        throw $ex;
    }
}

//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
function Login($Uname, $hPass) {
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT LoginID, password, accessRights FROM login WHERE username:user");
        $stmt->bindParam(':user', $Uname);
        $stmt->execute();
        $row = $stmt->fetch();
        if (password_verify($hPass, $row['password'])) {
            // assign session variables
            $_SESSION["user"] = $Uname;
            $_SESSION["loginid"] = $row["LoginID"];
            $_SESSION["access"] = $row["accessRights"];
            $_SESSION["login"] = 'yes';
        }
    }
    catch (PDOException $ex) {
        throw $ex;
    }
}

//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
// Add a new row to the author table
function addAuthor($auName, $auSurname, $auNation, $auBirthyr, $auDeathyr)
{
    global $conn;
    try {
        // prepare statement with named palceholders
        $stmt = $conn->prepare("INSERT INTO author(Name, Surname, Nationality, BirthYear, DeathYear)
        VALUES (:aname, :sname, :anation, :birthyr, :deathyr)");
        // bind values
        $stmt->bindValue(':aname', $auName);
        $stmt->bindValue(':sname', $auSurname);
        $stmt->bindValue(':anation', $auNation);
        $stmt->bindValue(':birthyr', $auBirthyr);
        $stmt->bindValue(':deathyr', $auDeathyr);
        $stmt->execute();
    }
    catch (PDOException $ex) {
        throw $ex;
    }
}

//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
// Add a new row to the book table
function addBook($bookTitle, $oTitle, $yearofPub, $genre, $millsSold, $language, $coverImage, $authorID, $user)
{
    global $conn;
    try {
        $conn->beginTransaction();
        // prepare statement with named placeholders
        $stmt = $conn->prepare("INSERT INTO book(BookTitle, OriginalTitle, YearofPublication, Genre, MillionsSold, LanguageWritten, coverImagePath, AuthorID)
        VALUES (:booktitle, :originaltitle, :yearpub, :genre, :msold, :lang, :coverimg, :auID)");
        // bind values
        $stmt->bindValue(':booktitle', $bookTitle);
        $stmt->bindValue(':originaltitle', $oTitle);
        $stmt->bindValue(':yearpub', $yearofPub);
        $stmt->bindValue(':genre', $genre);
        $stmt->bindValue(':msold', $millsSold);
        $stmt->bindValue(':lang', $language);
        $stmt->bindValue(':coverimg', $coverImage);
        $stmt->bindValue(':auID', $authorID);

        // execute insert statement
        $stmt->execute();

        // next transaction goes here
        $clbID = $conn->lastInsertId();

        $stmt = $conn->prepare("INSERT INTO changelog (BookID, userID)
        VALUES (:clbID, :uID)");
        $stmt->bindValue(':clbID', $clbID);
        $stmt->bindValue(':uID', $user);
        $stmt->execute();
        $conn->commit(); // save to database

    }
    catch (PDOException $ex) {
        $conn->rollBack(); // Something went wrong!
    throw $ex;
    }
}

function addAuthorBook($bookTitle, $oTitle, $yearofPub, $genre, $millsSold, $language, $coverImage, $auName, $auSurname, $auNation, $auByr, $auDyr, $user)
{
    global $conn;
    try {
        $conn->beginTransaction();

        $stmt = $conn->prepare("INSERT INTO author(Name, Surname, Nationality, BirthYear, DeathYear)
        VALUES (:aname, :sname, :nation, :byr, :dyr)");
        $stmt->bindValue(':aname', $auName);
        $stmt->bindValue(':sname', $auSurname);
        $stmt->bindValue(':nation', $auNation);
        $stmt->bindValue(':byr', $auByr);
        $stmt->bindValue(':dyr', $auDyr);
        $stmt->execute();

        $authID = $conn->lastInsertId();
        // prepare statement with named placeholders
        $stmt = $conn->prepare("INSERT INTO book(BookTitle, OriginalTitle, YearofPublication, Genre, MillionsSold, LanguageWritten, coverImagePath, AuthorID)
        VALUES (:booktitle, :originaltitle, :yearpub, :genre, :msold, :lang, :coverimg, :auID)");
        // bind values
        $stmt->bindValue(':booktitle', $bookTitle);
        $stmt->bindValue(':originaltitle', $oTitle);
        $stmt->bindValue(':yearpub', $yearofPub);
        $stmt->bindValue(':genre', $genre);
        $stmt->bindValue(':msold', $millsSold);
        $stmt->bindValue(':lang', $language);
        $stmt->bindValue(':coverimg', $coverImage);
        $stmt->bindValue(':auID', $authID);

        // execute insert statement
        $stmt->execute();

        // next transaction goes here
        $clbID = $conn->lastInsertId();

        $stmt = $conn->prepare("INSERT INTO changelog (BookID, userID)
        VALUES (:clbID, :uID)");
        //$stmt->bindValue(':cdate', $dCreated);
        //$stmt->bindValue(':ddate', $dChanged);
        $stmt->bindValue(':clbID', $clbID);
        $stmt->bindValue(':uID', $user);
        $stmt->execute();
        $conn->commit(); // save to database

    }
    catch (PDOException $ex) {
        $conn->rollBack(); // Something went wrong!
    throw $ex;
    }
}



//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
function updateAuthorBook($auName, $auSurname, $auNation, $auBirthyr, $auDeathyr, $bookID, $bookTitle, 
$oTitle, $yearofPub, $genre, $millsSold, $language, $coverImage, $authorID, $date, $user)
{

    global $conn;
    try {
        $conn->beginTransaction();
        $stmt = $conn->prepare("UPDATE author SET Name=:aname, Surname=:sname, Nationality=:anation, BirthYear=:birthyr, DeathYear=:deathyr WHERE AuthorID=:auID");
        // bind values
        $stmt->bindValue(':auID', $authorID);
        $stmt->bindValue(':aname', $auName);
        $stmt->bindValue(':sname', $auSurname);
        $stmt->bindValue(':anation', $auNation);
        $stmt->bindValue(':birthyr', $auBirthyr);
        $stmt->bindValue(':deathyr', $auDeathyr);
        $stmt->execute();

        // Update Book
        $stmt = $conn->prepare("UPDATE book SET BookTitle=:booktitle, OriginalTitle=:originaltitle, YearofPublication=:yearpub, Genre=:genre, MillionsSold=:msold, LanguageWritten=:lang, coverImagePath=:coverimg, AuthorID=:auID WHERE BookID=:bID");
        // bind values
        $stmt->bindValue(':bID', $bookID);
        $stmt->bindValue(':booktitle', $bookTitle);
        $stmt->bindValue(':originaltitle', $oTitle);
        $stmt->bindValue(':yearpub', $yearofPub);
        $stmt->bindValue(':genre', $genre);
        $stmt->bindValue(':msold', $millsSold);
        $stmt->bindValue(':lang', $language);
        $stmt->bindValue(':coverimg', $coverImage);
        $stmt->bindValue(':auID', $authorID);
        $stmt->execute();

        $chstmt = $conn->prepare("SELECT * FROM changelog WHERE BookID = $bookID");
        $chstmt->execute();
        $chrow = $chstmt->fetch();
        $clID = $chrow['changeLogID'];


        // update ChangeLog
        $stmt = $conn->prepare("UPDATE changelog SET dateChanged=:changedate 
        WHERE changeLogID=:clID AND BookID=:clBID");
        $stmt->bindValue(':clID', $clID);
        $stmt->bindValue(':changedate', $date);
        $stmt->bindValue(':clBID', $bookID);
        $stmt->execute();
        $conn->commit(); // save to database

        echo $bookTitle. "Boook and Author Updated Successfully";
    }
    catch (PDOException $ex){
        $conn->rollBack();
        throw $ex;
    }
}

//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
function deleteBook($bookID, $bookTitle) 
{
    global $conn;

    try{
        $stmt = $conn->prepare("DELETE FROM book WHERE BookID =:bID");
        //bind vales to named parameters
        $stmt->bindValue(':bID',$bookID);
        $stmt->execute();
        $numRows=$stmt->rowCount();

        if($numRows <0){
            echo "No books in database";
        }

    }
    catch(PDOException $ex) {
        throw $ex;
    }
    echo $bookTitle. " deleted successfully.";
}

//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
function selectAllBook()
{
    global $conn;
    try{
        $stmt = $conn->prepare('SELECT * FROM book');
        $stmt->execute();
        $result = $stmt-> fetchAll();
        $numRows = $stmt->rowCount();
        // echo "Total number of rows is: ".$numRows. "<br>";
        if ($numRows < 1) {
            echo "Table is empty.";
        }
        else {
            foreach ($result as $row) {
                echo $row['BookTitle']."-",$row['Genre']. "<br>";
            }
        }
    }
    catch (PDOException $ex){
        throw $ex;
    }
}

?>