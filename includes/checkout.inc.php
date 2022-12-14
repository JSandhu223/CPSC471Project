<?php
session_start();

include "../classes/DBHandler.php";

if (isset($_POST["checkout-submit"])) {
    echo "Thanks for buying! <br/>";

    $card_name = $_POST["cardname"];
    $card_number = $_POST["cardno"];
    $expiry_date = $_POST["expdate"];
    $cvv = $_POST["cvv"];
    
    if (!preg_match("/^[a-zA-Z ]*$/", $card_name)) {
        echo "<script type='text/javascript'>alert('Invalid name.');location='../checkout.php'</script>";
        exit();
    }

    if (!preg_match("/^[0-9]*$/", $card_number)) {
        echo "<script type='text/javascript'>alert('Invalid credit card number.');location='../checkout.php'</script>";
        exit();
    }

    if (!preg_match("/^[0-9]*$/", $expiry_date)) {
        echo "<script type='text/javascript'>alert('Invalid expiry date.');location='../checkout.php'</script>";
        exit();
    }

    else if (strlen($expiry_date) != 4){
        echo "<script type='text/javascript'>alert('Invalid expiry date.');location='../checkout.php'</script>";
        exit();
    }

    if (!preg_match("/^[0-9]*$/", $cvv)) {
        echo "<script type='text/javascript'>alert('Invalid CVV.');location='../checkout.php'</script>";
        exit();
    }
    
    else if (strlen($cvv) != 3){
        echo "<script type='text/javascript'>alert('Invalid CVV.');location='../checkout.php'</script>";
        exit();
    }

    $con = new DBHandler();

    // Get the user ID
    $stmt = $con->connect()->prepare("SELECT UserID FROM USER WHERE Username = ?;");
    $stmt->execute(array($_SESSION["username"]));
    $userID = $stmt->fetchColumn();
    echo "User ID: " . $userID . "<br/>";

    // Get the library ID
    $stmt = $con->connect()->prepare("SELECT LibraryID FROM LIBRARY WHERE UserID = ?;");
    $stmt->execute(array($userID));
    $libraryID = $stmt->fetchColumn();
    echo "Library ID: " . $libraryID . "<br/>";

    // Check if the game is already in user's library
    $stmt = $con->connect()->prepare("SELECT GameID FROM BELONG_TO WHERE LibraryID = ?;");
    $stmt->execute(array($libraryID));
    $result = $stmt->fetchAll();

    // Display errori f true
    if (count($result) >= 1) {
        echo "<script type='text/javascript'>alert('Game Already In Library.');location='../checkout.php'</script>";
        exit();
    }

    // This only inserts a single game into the library
    $gameID = 6;
    $stmt = $con->connect()->prepare("INSERT INTO BELONG_TO (LibraryID, GameID) VALUES (?, ?);");
    $stmt->execute(array($libraryID, $gameID));

    // Delete the game from the cart after purchase
    $stmt = $con->connect()->prepare("DELETE FROM ADDED_TO WHERE GameID = ?;");
    $stmt->execute(array($gameID));

    // header("location: ../library.php?message=purchase-complete");
    // Get the number of games in the user's library
    $stmt = $con->connect()->prepare("SELECT COUNT(*) FROM BELONG_TO WHERE LibraryID = ?;");
    $stmt->execute(array($libraryID));
    $currentCount = $stmt->fetchColumn();

    // Update the game count
    $stmt = $con->connect()->prepare("UPDATE LIBRARY SET GameCount = ? WHERE LibraryID = ?;");
    $stmt->execute(array($currentCount, $libraryID));

    echo "<script type='text/javascript'>alert('Purchase completed!');location='../library.php'</script>";
    // header("location: ../library.php?message=purchase-complete");
}