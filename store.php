<?php
session_start();

include "classes/DBHandler.php";

$con = new DBHandler();

$stmt = $con->connect()->prepare("SELECT * FROM GAME WHERE Greenlit = 1;");
$stmt->execute(array());
$all_games = $stmt->fetchAll();

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
    <link rel="stylesheet" href="styles/list_preview.css">
    <title>Store</title>
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
        </nav>
        <h1>Product Name</h1>
    </div>
    <h1 id="heading">Games On Sale</h1>
    <section class="container">
        <?php
        // Loop through all the games in our database
        for ($i = 0; $i < count($all_games); $i++) {
            $_SESSION["gameID"] = $all_games[$i]["GameID"];
            $title = $all_games[$i]["Title"];
            $age_rating = $all_games[$i]["AgeRating"];
            $release_date = $all_games[$i]["ReleaseDate"];
            $price = $all_games[$i]["Price"];
            $dev_name = $all_games[$i]["Dname"];
        ?>
            <div class="st_game">
                <div class="game_image"></div>
                <?php
                // Display the game's Name
                echo "<h2>";
                echo $title;
                echo "</h2>";

                // Display the developer name
                echo "<p>";
                echo $dev_name;
                echo "</p>";

                // Display the age rating
                echo "<p>";
                echo $age_rating;
                echo "</p>";

                // Display the release date
                echo "<p>";
                echo displayDate($release_date);
                echo "</p>";

                // Display the value in the Price column
                echo "<p>";
                echo  "$" . $price;
                echo "</p>";
                ?>
                <br />
                <form action="includes/store.inc.php" method="post">
                    <input type="submit" name="add-to-cart<?php echo $_SESSION["gameID"]; ?>" value="Add To Cart">
                </form>
            </div>
        <?php
        }
        ?>
    </section>
</body>

</html>