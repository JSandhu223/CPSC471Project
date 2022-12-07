<?php

session_start();

include "../classes/DBHandler.php";

$con = new DBHandler();

if (isset($_POST["rate-submit"])) {

    $selectedGameID = $_POST["rate-game"]; // This is the value of the <option> that was selected
    $score = $_POST["rate-score"];

    if ($score < 1 || $score > 10) {
        echo "<script type='text/javascript'>alert('Invalid input! Score must be between 1 and 10.');location='../rate.php'</script>";
        exit();
    }

    // Get the userID of the currently logged in user
    $stmt = $con->connect()->prepare("SELECT UserID FROM USER WHERE Username = ?;");
    $stmt->execute(array($_SESSION["username"]));
    $userID = $stmt->fetchColumn();

    // First check if the user has already rated this game
    $stmt = $con->connect()->prepare("SELECT UserID FROM RATING WHERE GameID = ?;");
    $stmt->execute(array($selectedGameID));
    $result = $stmt->fetchColumn();
    // If the user has already rated the game, simply update the rating with the new score
    if (!empty($result)) {
        $stmt = $con->connect()->prepare("UPDATE RATING SET Score = ? WHERE UserID = ?;");
        $stmt->execute(array($score, $userID));
        echo "<script type='text/javascript'>alert('You rating has been updated.');location='../rate.php'</script>";
        exit();
    }

    $stmt = $con->connect()->prepare("INSERT INTO RATING (Score, UserID, GameID) VALUES (?, ?, ?)");
    $stmt->execute(array($score, $userID, $selectedGameID));
}

echo "<script type='text/javascript'>alert('Rating added!.');location='../rate.php'</script>";
