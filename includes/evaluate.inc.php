<?php
session_start();

include "../classes/DBHandler.php";

$con = new DBHandler();

$selectedGameID = $_POST["evaluate-game"]; // This is the value of the <option> that was selected

// If the admin clicks Approve
if (isset($_POST["approve-game"])) {

    // Set a game to be approved
    $stmt = $con->connect()->prepare("UPDATE GAME SET Greenlit = 1 WHERE GameID = ?;");
    $stmt->execute(array($selectedGameID));
    echo "<script type='text/javascript'>alert('Game approved!');location='../evaluate.php'</script>";
    exit();

    // $stmt = $con->connect()->prepare("DELETE FROM GAME WHERE GameID")
}

// If the admin clicks Reject
if (isset($_POST["reject-game"])) {

    // Get the admin ID
    $stmt = $con->connect()->prepare("SELECT AdminID FROM ADMINISTRATOR WHERE Email = ?;");
    $stmt->execute(array($_SESSION["admin"]));
    $adminID = $stmt->fetchColumn();
    
    // Delete the game from the evaluation table
    $stmt = $con->connect()->prepare("DELETE FROM EVALUATES WHERE AdminID = ? AND GameID = ?;");
    $stmt->execute(array($adminID, $selectedGameID));

    // Delete the game from the database
    $stmt = $con->connect()->prepare("DELETE FROM GAME WHERE GameID = ?;");
    $stmt->execute(array($selectedGameID));

    echo "<script type='text/javascript'>alert('Game rejected! Removed from DB.');location='../evaluate.php'</script>";
    exit();
}