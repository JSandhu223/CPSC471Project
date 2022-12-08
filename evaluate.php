<?php
session_start();

include "classes/DBHandler.php";

function displayDate($date)
{
    $year = substr($date, 0, 4);
    $month_num = substr($date, 5, 2);
    $day = substr($date, 8, 2);

    $month = "January";

    if ($month_num == "02") {
        $month = "February";
    } else if ($month_num == "03") {
        $month = "March";
    } else if ($month_num == "04") {
        $month = "April";
    } else if ($month_num == "03") {
        $month = "May";
    } else if ($month_num == "03") {
        $month = "June";
    } else if ($month_num == "03") {
        $month = "July";
    } else if ($month_num == "03") {
        $month = "August";
    } else if ($month_num == "03") {
        $month = "September";
    } else if ($month_num == "03") {
        $month = "November";
    } else {
        $month = "December";
    }

    return $month . " " . $day . ", " . $year;
}
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

    <title>Evaluation</title>
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
                        <li><a href="cart.php">Cart</a></li>
                        <li><a href="rate.php">Rate</a></li>
                        <li><a href="game_release.php">Request Game</a></li>
                        <li><a href="profile.php"><?php echo $_SESSION["username"]; ?></a></li>
                        <li><a href="includes/logout.inc.php">Logout</a></li>
                    <?php
                    } else if ($_SESSION["admin"]) {
                    ?>
                        <li><a href="evaluate.php">Evaluate Game</a></li>
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
        <h1>Game Evaluation</h1>
        <form action="includes/evaluate.inc.php" method="post">
            <label>Game</label>
            <select name="evaluate-game">
                <?php
                $con = new DBHandler();

                $stmt = $con->connect()->prepare("SELECT AdminID FROM ADMINISTRATOR WHERE Email = ?;");
                $adminEmail = $_SESSION["admin"];
                $stmt->execute(array($adminEmail));
                $adminID = $stmt->fetchColumn();

                $stmt = $con->connect()->prepare("SELECT COUNT(*) FROM EVALUATES WHERE AdminID = ?;");
                $stmt->execute(array($adminID));
                $total_games = $stmt->fetchColumn();

                $stmt = $con->connect()->prepare("SELECT GameID FROM EVALUATES WHERE AdminID = ?;");
                $stmt->execute(array($adminID));
                $games = $stmt->fetchAll(); // This is all the non-greenlit games

                for ($i = 0; $i < $total_games; $i++) {
                    $gameID = $games[$i]["GameID"];

                    $stmt = $con->connect()->prepare("SELECT Title FROM GAME WHERE GameID = ?;");
                    $stmt->execute(array($gameID));
                    $title = $stmt->fetchColumn();

                    echo "<option value='";
                    echo $gameID;
                    echo "'>";
                    echo $title;
                    echo "</option>";
                }
                ?>
            </select>
            <br>
            <br>
            <input type="submit" name="approve-game" value="Approve">
            <input type="submit" name="reject-game" value="Reject">
        </form>
    </div>
</body>

</html>