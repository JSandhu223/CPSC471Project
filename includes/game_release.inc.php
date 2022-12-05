<?php

if (isset($_POST["request-eval"])) {
    $title = $_POST["game-name"];
    $ageRating = $_POST["age-rating"];

    if ($ageRating != 'E' && $ageRating != 'T' && $ageRating != 'M') {
        header("location: ../game_release.php?error=invalid-age-rating");
        exit();
    }

    else {
        header("location: ../game_release.php?message=game-request-sent");
    }
}