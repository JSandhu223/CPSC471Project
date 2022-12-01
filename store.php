<?php
session_start();
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
    <h1 id="heading">Games On Sale</h1>
    <section class="container">
        <div class="st_game">
            <div class="game_image"></div>
            <h2>Game Name</h2>
            <p>Description</p>
            <a href="">Add To Cart</a>
        </div>
        <div class="st_game">
            <div class="game_image"></div>
            <h2>Game Name</h2>
            <p>Description</p>
            <a href="">Add To Cart</a>
        </div>
        <div class="st_game">
            <div class="game_image"></div>
            <h2>Game Name</h2>
            <p>Description</p>
            <a href="">Add To Cart</a>
        </div>
    </section>
</body>

</html>