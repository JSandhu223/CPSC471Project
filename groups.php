<?php
session_start();

include "classes/DBHandler.php";

$con = new DBHandler();

$stmt = $con->connect()->prepare("SELECT * FROM COMMUNITY_GROUP;");
$stmt->execute(array());
$all_groups = $stmt->fetchAll();
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
                    <li><a href="store.php">Groups</a></li>
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
    <h1 id="heading">Groups</h1>
    <section class="container">
        <?php
        // Loop through all the games in our database
        for ($i = 0; $i < count($all_groups); $i++) {
            $_SESSION["gname"] = $all_groups[$i]["Gname"];
            $mem_count = $all_groups[$i]["MemCount"];
        ?>
            <div class="st_game">
                <div class="game_image"></div>
                <?php
                // Display the game's Name
                echo "<h2>";
                echo $_SESSION["gname"];
                echo "</h2>";

                // Display the developer name
                echo "<p>";
                echo "Members: " . $mem_count;
                echo "</p>";
                ?>
                <br />
                <form action="includes/groups.inc.php" method="post">
                    <input type="submit" name="join-group<?php echo $_SESSION["gname"]; ?>" value="Join">
                </form>
            </div>
        <?php
        }
        ?>
    </section>
</body>

</html>