<?php
session_start();
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
            height: 460px;
        }

        input[type="text"] {
            color: black;
        }

        input[name="upload"] {
            width: 70%;
            display: block;
            margin-right: auto;
            margin-left: auto;
            border-radius: 5px;
        }
    </style>

    <title>Game Release</title>
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
        <h1>Request Game</h1>
        <form action="includes/game_release.inc.php" method="post">
            <label>Game Name</label>
            <input type="text" name="game-name" required>

            <label>Age Rating</label>
            <input type="text" name="age-rating" required>

            <label>Release Date</label>
            <br>
            <input type="date" name="release-date" required>
            <br>

            <label>Price to Sell</label>
            <input type="text" name="price" required>

            <label>Developer Name</label>
            <input type="text" name="dev-name" required>

            <label>Developer Start Date</label>
            <br>
            <input type="date" name="dev-start-date" required>

            <input type="submit" name="upload" value="(+) Upload Game Files">
            <input type="submit" name="request-eval" value="Request Game">
        </form>
    </div>
</body>

</html>