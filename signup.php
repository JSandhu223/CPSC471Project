<?php
include "header.php";
?>

<section>
    <div class="wrapper">
        <h4>SIGN UP</h4>
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="username" placeholder="Username" />
            <input type="text" name="email" placeholder="Email" />
            <input type="password" name="password" placeholder="Password" />
            <input type="password" name="passwordRepeat" placeholder="Repeat Password" />
            <br>
            <button type="submit" name="signup-submit">SIGN UP</button>
        </form>
    </div>
</section>

</body>

</html>