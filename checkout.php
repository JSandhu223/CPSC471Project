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

    <div class="center">
        <h1>Checkout</h1>
        <form method="post">
            <label>Name on Card</label>
            <input type="text" name="cardname" required disabled value="Jon Doe">
            
            <label>Card Number</label>
            <input type="text" name="cardno" required disabled value="420">
            
            <label>Expiry Date</label>
            <input type="text" name="expdate" required disabled value="n/a">
            
            <label>CVV</label>
            <input type="text" name="cvv" required disabled value="n/a">
            
            <input type="submit" name="checkout-submit" value="Confirm Order">
            
        </form>
    </div>
</body>

</html>