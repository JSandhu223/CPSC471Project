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

    header("location: ../library.php?message=purchase-complete");
}