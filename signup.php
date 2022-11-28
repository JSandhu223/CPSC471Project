<?php
include "header.php";
?>

<section>
    <div class="wrapper">
        <h4>SIGN UP</h4>
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username" />
            <input type="password" name="pwd" placeholder="Password" />
            <input type="password" name="pwdRepeat" placeholder="Repeat Password" />
            <input type="text" name="email" placeholder="Email" />
            <br>
            <button type="submit" name="submit">SIGN UP</button>
        </form>
    </div>
</section>

</body>

</html>