<!DOCTYPE html>
<html lang=en>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="styles.css" />
    <title>Project</title>
</head>

<body>
    <header>
        <nav>
            <div>
                <ul class="main-navbar">
                    <li><a href="index.php">Home</a></li>
                </ul>
                <ul class="user-navbar">
                    <?php
                    if (isset($_SESSION["username"])) {
                    ?>
                        <li><a href="#">Games</a></li>
                        <li><a href="#">Groups</a></li>
                        <li><a href="#">Rate a Game</a></li>
                        <li><a href="#"><?php echo $_SESSION["username"]; ?></a></li>
                        <li><a href="includes/logout.inc.php">Logout</a></li>
                    <?php
                    } else {
                    ?>
                        <li><a href="signup.php">Sign Up</a></li>
                        <li><a href="login.php">Login</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </header>