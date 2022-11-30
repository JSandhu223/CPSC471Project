<?php
include "header.php";
?>

<section>
    <div class="index-login-login">
        <h4>LOGIN</h4>
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="username" placeholder="Username" />
            <input type="password" name="password" placeholder="Password" />
            <br>
            <button type="submit" name="login-submit">LOGIN</button>
        </form>
    </div>
</section>
</body>