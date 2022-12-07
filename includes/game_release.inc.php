<?php

include "../classes/DBHandler.php";

$con = new DBHandler();

if (isset($_POST["request-eval"])) {
    $title = $_POST["game-name"];
    $ageRating = $_POST["age-rating"];
    $releaseDate = $_POST["release-date"];
    $price = $_POST["price"];
    $devName = $_POST["dev-name"];

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


    else {
        header("location: ../game_release.php?message=game-request-sent");
    }
}