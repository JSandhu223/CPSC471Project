<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/nav.css">
    <title>Login</title>
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
                        <li><a href="game_release.php">Request Game</a></li>
                        <li><a href="profile.php"><?php echo $_SESSION["username"]; ?></a></li>
                        <li><a href="includes/logout.inc.php">Logout</a></li>
                    <?php
                    } else if (isset($_SESSION["admin"])) {
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
        <h1>Login</h1>
        <form action="includes/login.inc.php" method="post">
            <div class="txt_field">
                <input type="text" name="username-or-email" required>
                <label>Username/Email</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <input type="submit" name="login-submit" value="Login">
            <div class="signup_link">
                Don't have an account?
                <a href="signup.php">Sign Up</a>
            </div>
        </form>
    </div>
</body>

</html>