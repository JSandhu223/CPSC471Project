<?php
session_start();

include "classes/DBHandler.php";

// Get the username of the user that is currently logged in
$session_username = $_SESSION["username"];
// Create an object that talks to the database
$con = new DBHandler();

// Retrieve the UserID of the currently logged in user
$stmt = $con->connect()->prepare("SELECT UserID FROM USER WHERE Username = ?;");
$stmt->execute(array($session_username));
$session_userID = $stmt->fetchColumn();

// Get the CartID of the currently logged in user
$stmt = $con->connect()->prepare("SELECT CartID FROM CART WHERE UserID = ?;");
$stmt->execute(array($session_userID));
$session_cartID = $stmt->fetchColumn();

$stmt = $con->connect()->prepare("SELECT GameID FROM ADDED_TO WHERE CartID = ?;");
$stmt->execute(array($session_cartID));
$games_in_cart = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/nav.css">
    <link rel="stylesheet" href="styles/list_preview.css">
    <title>Cart</title>
</head>

<body>
    <div class="navbar">
        <nav>
            <ul>
                <li><a class="selected" href="index.php">Home</a></li>
                <?php
                if (isset($_SESSION["username"])) {
                ?>
                    <li><a href="library.php">Library</a></li>
                    <li><a href="store.php">Store</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="profile.php"><?php echo $_SESSION["username"]; ?></a></li>
                    <li><a href="includes/logout.inc.php">Logout</a></li>
                <?php
                }
                ?>
            </ul>
        </nav>
        <h1>Product Name</h1>
    </div>
    <h1 id="heading">Your Cart</h1>
    <section class="container">
        <?php
        // Loop through all the games in the user's cart
        $stmt = $con->connect()->prepare("SELECT * FROM GAME WHERE GameID = ?;");
        for ($i = 0; $i < count($games_in_cart); $i++) {
            $stmt->execute(array($games_in_cart[$i][0]));
            // This returns an array of all rows that satisfy our query
            $row = $stmt->fetch();
        ?>
            <div class="st_game">
                <div class="game_image"></div>
                <?php
                echo "<h2>";
                // Display the game's Name
                echo $row["Title"];
                echo "</h2>";

                echo "<p>";
                // Display the developer name
                echo $row["Dname"];
                echo "</p>";

                echo "<p>";
                // Display the value in the Price column
                echo  "$" . $row["Price"];
                echo "</p>";
                ?>
            </div>
        <?php
        }
        ?>
    </section>
    <input id="checkout" type="submit" value="Proceed To Checkout">
</body>

</html>