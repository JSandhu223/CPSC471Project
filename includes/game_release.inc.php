<?php

include "../classes/DBHandler.php";

$con = new DBHandler();

if (isset($_POST["request-eval"])) {
    $title = $_POST["game-name"];
    $ageRating = $_POST["age-rating"];
    $releaseDate = $_POST["release-date"];
    $releaseDate = date("Y-m-d H:i:s", strtotime($releaseDate)); // Convert into MySQL compatible date format
    $price = $_POST["price"];
    $devName = $_POST["dev-name"];
    $devStartDate = $_POST["dev-start-date"];
    $devStartDate = date("Y-m-d H:i:s", strtotime($devStartDate)); // Convert into MySQL compatible date format

    if ($ageRating != 'E' && $ageRating != 'T' && $ageRating != 'M') {
        echo "<script type='text/javascript'>alert('Invalid age rating.');location='../game_release.php'</script>";
        exit();
    }

    // TODO: Check if the release date is not before the current date

    // Check if the price is invalid
    if (floatval($price) < 0.00) {
        echo "<script type='text/javascript'>alert('Invalid price.');location='../game_release.php'</script>";
        exit();
    }

    // Check if the price is too high. (Ain't nobody buying that shit)
    if (floatval($price) > 99.99) {
        echo "<script type='text/javascript'>alert('You're really pushing it with that price!');location='../game_release.php'</script>";
        exit();
    }

    // Check if the dev name exists
    $stmt = $con->connect()->prepare("SELECT Dname FROM DEVELOPER WHERE Dname = ?;");
    $stmt->execute(array($devName));
    $result = $stmt->fetchColumn();
    // Add the developer to the DEVELOPER table if they already exist in it
    if (empty($result)) {
        $stmt = $con->connect()->prepare("INSERT INTO DEVELOPER (Dname, StartDate) VALUES (?, ?)");
        $stmt->execute(array($devName, $devStartDate));
    }

    // Check if the game already exists
    $stmt = $con->connect()->prepare("SELECT Title FROM GAME WHERE Title = ?;");
    $stmt->execute(array($title));
    $result = $stmt->fetchColumn();
    if (!empty($result)) {
        echo "<script type='text/javascript'>alert('Game already under evaluation!');location='../game_release.php'</script>";
        exit();
    }

    // Then add the game to our GAME table. Greenlit is set to FALSE/0 by default.
    $stmt = $con->connect()->prepare("INSERT INTO GAME (Title, AgeRating, ReleaseDate, Price, Dname) VALUES (?, ?, ?, ?, ?);");
    $stmt->execute(array($title, $ageRating, $releaseDate, $price, $devName));

    // Now grab the gameID of the game we just inserted
    $stmt = $con->connect()->prepare("SELECT GameID FROM GAME WHERE Title = ?;");
    $stmt->execute(array($title));
    $gameID = $stmt->fetchColumn();

    // Grab all the admins IDs from our ADMINISTRATOR table
    $stmt = $con->connect()->prepare("SELECT AdminID FROM ADMINISTRATOR;");
    $stmt->execute(array());
    $result = $stmt->fetchAll();

    // Create an array of admin IDs
    $admins = array();
    for ($i = 0; $i < count($result); $i++) {
        array_push($admins, $result[$i]["AdminID"]);
    }
    
    // Pick a random admin from our array of admins
    $adminID = $admins[array_rand($admins)];

    // Now add the game to the EVALUATES table.
    // The game will be assigned for evaluation to that random adminID that was selected from the array
    $stmt = $con->connect()->prepare("INSERT INTO EVALUATES (AdminID, GameID) VALUES (?, ?);");
    $stmt->execute(array($adminID, $gameID));

    echo "<script type='text/javascript'>alert('Game request successfully sent!');location='../game_release.php'</script>";
}
