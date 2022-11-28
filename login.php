<?php
include "header.php";
?>

<section>
    <div class="index-login-login">
        <h4>LOGIN</h4>
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username" />
            <input type="password" name="pwd" placeholder="Password" />
            <br>
            <button type="submit" name="submit">LOGIN</button>
        </form>
    </div>
</section>