<?php
include "classes/DBHandler.php";
session_start();
$con = new DBHandler();

// First get the user's id
$stmt = $con->connect()->prepare("SELECT UserID FROM USER WHERE Username = ?;");
$stmt->execute(array($_SESSION["username"]));
$userID = $stmt->fetchColumn();


// Then get the GameCount based on the userID
$stmt = $con->connect()->prepare("SELECT GameCount FROM LIBRARY WHERE UserID = ?;");
$stmt->execute(array($userID));
$gameCount = $stmt->fetchColumn();

// Now get the amount of groups that the user is in based on their user ID
$stmt = $con->connect()->prepare("SELECT COUNT(*) FROM MEMBER WHERE UserID = ?;");
$stmt->execute(array($userID));
$groupCount = $stmt->fetchColumn();

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
            height: 440px;
        }

        label {
            color: #156ba5;
        }

        h2 {
            color: white;
            margin-bottom: 15px;
            border-bottom: solid;
            border-color: #156ba5;
        }
    </style>

    <title>Profile</title>
</head>

<body>
    <div class="navbar">
        <nav>
            <div>
                <ul>
                    <?php
                    if (isset($_SESSION["username"])) {
                    ?>
                        <li><a class="selected" href="profile.php"><?php echo $_SESSION["username"]; ?></a></li>
                        <li><a href="library.php">Library</a></li>
                        <li><a href="store.php">Store</a></li>
                        <li><a href="groups.php">Groups</a></li>
                        <li><a href="cart.php">Cart</a></li>
                        <li><a href="rate.php">Rate</a></li>
                        <li><a href="game_release.php">Request Game</a></li>
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
        <h1>Your Profile</h1>
        <form method="post">
            <label>Username</label>
            <h2><?php echo $_SESSION["username"] ?></h2>

            <label>Status</label>
            <h2>Online</h2>

            <label># of Games Owned</label>
            <h2><?php echo $gameCount; ?> games</h2>

            <label># of Groups joined</label>
            <h2><?php echo $groupCount; ?> groups</h2>
        </form>
    </div>
</body>

</html>