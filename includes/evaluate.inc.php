<?php

include "../classes/DBHandler.php";

$con = new DBHandler();

$selectedGameID = $_POST["evaluate-game"]; // This is the value of the <option> that was selected

// If the admin clicks Approve
if (isset($_POST["approve-game"])) {

    $stmt = $con->connect()->prepare("UPDATE GAME SET Greenlit = 1 WHERE GameID = ?;");
    $stmt->execute(array($selectedGameID));
    echo "<script type='text/javascript'>alert('Game approved!');location='../evaluate.php'</script>";
    exit();

    // $stmt = $con->connect()->prepare("DELETE FROM GAME WHERE GameID")
}

// If the admin clicks Reject
if (isset($_POST["reject-game"])) {
    $stmt = $con->connect()->prepare("DELETE FROM GAME WHERE GameID = ?;");
    $stmt->execute(array($selectedGameID));

    echo "<script type='text/javascript'>alert('Game rejected! Removed from DB.');location='../rate.php'</script>";
    exit();
}