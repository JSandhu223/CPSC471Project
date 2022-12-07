<?php
session_start();

include "classes/DBHandler.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/nav.css">
    <link rel="stylesheet" href="styles/checkout.css">
    <style>
        .center {
            height: 380px;
        }
    </style>

    <title>Rate</title>
</head>

<body>
    <div class="navbar">
        <nav>
            <div>
                <ul>
                    <li><a class="selected" href="index.php">Home</a></li>
                    <?php
                    if (isset($_SESSION["username"])) {
                    ?>
                        <li><a href="library.php">Library</a></li>
                        <li><a href="store.php">Store</a></li>
                        <li><a href="groups.php">Groups</a></li>
                        <li><a href="cart.php">Cart</a></li>
                        <li><a href="rate.php">Rate</a></li>
                        <li><a href="game_release.php">Request Game</a></li>
                        <li><a href="profile.php"><?php echo $_SESSION["username"]; ?></a></li>
                        <li><a href="includes/logout.inc.php">Logout</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </nav>
        <h1>Product Name</h1>
    </div>

    <div class="center">
        <h1>Rate a Game</h1>
        <form action="includes/rate.inc.php" method="post">
            <label>Game</label>
            <select name="rate-game">
                <?php
                $con = new DBHandler();
                $stmt = $con->connect()->prepare("SELECT MAX(GameID) FROM GAME;");
                $stmt->execute(array());
                $total_games = $stmt->fetchColumn();

                // Start from index 1, as that is what the first game in our GAME table would start from
                for ($i = 1; $i <= $total_games; $i++) {
                    $stmt = $con->connect()->prepare("SELECT Title FROM GAME WHERE GameID = ?;");
                    $stmt->execute(array($i));
                    $title = $stmt->fetchColumn();
                    if (empty($title)) {
                        continue;
                    }
                    echo "<option value='";
                    echo $i;
                    echo "'>";
                    echo $title;
                    echo "</option>";
                }
                ?>
            </select>
            <br>
            <br>
            <label>Score</label>
            <input type="text" name="rate-score" placeholder="Enter Score (1-10)">
            <br>
            <input type="submit" name="rate-submit" value="Submit Rating">
        </form>
    </div>
</body>

</html>