<?php
session_start();

include "../classes/DBHandler.php";

if (isset($_POST["checkout-submit"])) {
    echo "Thanks for buying! <br/>";

    $card_name = $_POST["cardname"];
    $card_number = $_POST["cardno"];
    $expiry_date = $_POST["expdate"];
    $cvv = $_POST["cvv"];

    $con = new DBHandler();
    $stmt = $con->connect()->prepare("SELECT UserID FROM USER WHERE Username = ?;");
    $stmt->execute(array($_SESSION["username"]));
    $userID = $stmt->fetchColumn();
    echo "User ID: " . $userID . "<br/>";

    $stmt = $con->connect()->prepare("SELECT LibraryID FROM LIBRARY WHERE UserID = ?;");
    $stmt->execute(array($userID));
    $libraryID = $stmt->fetchColumn();
    echo "Library ID: " . $libraryID . "<br/>";

    // This only inserts a single game into the library
    $gameID = 6;
    $stmt = $con->connect()->prepare("INSERT INTO BELONG_TO (LibraryID, GameID) VALUES (?, ?);");
    $stmt->execute(array($libraryID, $gameID));

    $stmt = $con->connect()->prepare("DELETE FROM ADDED_TO WHERE GameID = ?;");
    $stmt->execute(array($gameID));
    echo "<script type='text/javascript'>alert('Purchase completed!');location='../library.php'</script>";

    // header("location: ../library.php?message=purchase-complete");
    // Get the number of games in the user's library
    $stmt = $con->connect()->prepare("SELECT COUNT(*) FROM BELONG_TO WHERE LibraryID = ?;");
    $stmt->execute(array($libraryID));
    $currentCount = $stmt->fetchColumn();

    // Update the game count
    $stmt = $con->connect()->prepare("UPDATE LIBRARY SET GameCount = ? WHERE LibraryID = ?;");
    $stmt->execute(array($currentCount, $libraryID));

    header("location: ../library.php?message=purchase-complete");
}