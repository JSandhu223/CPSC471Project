<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/nav.css">
    <title>Sign Up</title>
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

    <section>
        <div class="center">
            <h4>Sign Up</h4>
            <form action="includes/signup.inc.php" method="post">
                <div class="txt_field">
                    <input type="text" name="username" />
                    <label>Username</label>
                </div>
                <div class="txt_field">
                    <input type="text" name="email" />
                    <label>Email</label>
                </div>
                <div class="txt_field">
                    <input type="password" name="password" />
                    <label>Password</label>
                </div>
                <div>
                    <input type="password" name="passwordRepeat" />
                    <label>Repeat Password</label>
                </div>
                <br>
                <button type="submit" name="signup-submit">SIGN UP</button>
            </form>
        </div>
    </section>

</body>

</html>