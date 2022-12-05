<?php
session_start();

include "classes/DBHandler.php";

$con = new DBHandler();
$stmt = $con->connect()->prepare("SELECT UserID FROM USER WHERE Username = ?;");
$stmt->execute(array($_SESSION["username"]));
$userID = $stmt->fetchColumn();

$stmt = $con->connect()->prepare("SELECT LibraryID FROM LIBRARY WHERE UserID = ?;");
$stmt->execute(array($userID));
$libraryID = $stmt->fetchColumn();

$stmt = $con->connect()->prepare("SELECT GameID FROM BELONG_TO WHERE LibraryID = ?;");
$stmt->execute(array($libraryID));
$games_in_library = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/nav.css">
    <link rel="stylesheet" href="styles/list_preview.css">
    <title>Library</title>
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
    <h1 id="heading">Purchased Games</h1>
    <section class="container">
        <?php
        for ($i = 0; $i < count($games_in_library); $i++) {
            $stmt = $con->connect()->prepare("SELECT * FROM GAME WHERE GameID = ?;");
            $stmt->execute(array($games_in_library[$i]["GameID"]));
            $game_info = $stmt->fetchAll();
            $title = $game_info[$i]["Title"];
            $dev_name = $game_info[$i]["Dname"];
        ?>
            <div class="st_game">
                <div class="game_image"></div>
                <h2><?php echo $title; ?></h2>
                <p><?php echo $dev_name; ?></p>
                <a href=#>Launch Game</a>
            </div>
        <?php
        }
        ?>
    </section>
</body>

</html>