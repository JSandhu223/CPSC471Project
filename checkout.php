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

    <title>Checkout</title>
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
        <h1>Checkout</h1>
        <form action="includes/checkout.inc.php" method="post">
            <label>Name on Card</label>
            <input type="text" name="cardname" required>

            <label>Card Number</label>
            <input type="text" name="cardno" required>

            <label>Expiry Date</label>
            <input type="text" name="expdate" required>

            <label>CVV</label>
            <input type="text" name="cvv" required>

            <input type="submit" name="checkout-submit" value="Confirm Order">

        </form>
    </div>
</body>

</html>