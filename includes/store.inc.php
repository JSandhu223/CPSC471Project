<?php

session_Start();

include "../classes/DBHandler.php";

if (isset($_POST["add-to-cart"])) {
    $con = new DBHandler();
    $gameID = $_SESSION["gameID"]; // This is the gameID variable from store.php

    // First get the user's id
    $stmt = $con->connect()->prepare("SELECT UserID FROM USER WHERE Username = ?;");
    $stmt->execute(array($_SESSION["username"]));
    $userID = $stmt->fetchColumn();
    echo "Username: " . $_SESSION["username"];
    echo "<br/>";
    echo "UserID: " . $userID;
    echo "<br/>";

    // Then get the Cart based on the userID
    $stmt = $con->connect()->prepare("SELECT CartID FROM CART WHERE UserID = ?;");
    $stmt->execute(array($userID));
    $cartID = $stmt->fetchColumn();
    echo "CartID: " . $cartID;
    echo "<br/>";
    
    // First, check if the game already exists in the user's library
    $gameID = 6;
    $stmt = $con->connect()->prepare("SELECT GameID FROM BELONG_TO WHERE GameID = ?;");
    $stmt->execute(array($gameID));
    $result = $stmt->fetchAll();
    if (count($result) > 0) {
        echo "<script type='text/javascript'>alert('Item is already in your library.');location='../library.php'</script>";
        // header("location: ../store.php?error=item-already-in-cart");
        $stmt = $con->connect()->prepare("DELETE FROM ADDED_TO WHERE GameID = ?;");
        $stmt->execute(array($gameID));
        exit();
    }

    // Then check if the game already exists in the cart
    $stmt = $con->connect()->prepare("SELECT GameID FROM ADDED_TO WHERE CartID = ? AND GameID = ?;");
    $stmt->execute(array($cartID, $gameID));
    $result = $stmt->fetchAll();
    if (count($result) > 0) {
        echo "<script type='text/javascript'>alert('Item is already in your cart.');location='../cart.php'</script>";
        // header("location: ../store.php?error=item-already-in-cart");
        exit();
    }


    // Then insert the game into the cart if it isn't already in the user's cart
    $stmt = $con->connect()->prepare("INSERT INTO ADDED_TO (CartID, GameID) VALUES (?, ?);");
    $stmt->execute(array($cartID, $gameID));
    echo "<script type='text/javascript'>alert('Game added to cart.');location='../store.php'</script>";

}

// Return to the store page
header("location: ../store.php");
