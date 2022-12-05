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
        .center{
           height: 460px;    
        }
        input[type="text"]{
            color: black;
        }
        input[name="upload"]{
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
        <h1>Request Evaluation</h1>
        <form method="post">
            <label>Game Name</label>
            <input type="text" name="gamename" required value="Pacman">
            
            <label>Game Genre</label>
            <input type="text" name="rating" required value="FPS">
            
            <input type="submit" name="upload" value="(+) Upload Game Files">
            <input type="submit" name="request-eval" value="Request Evaluation">
            
        </form>
    </div>
</body>

</html>