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
					<li><a href="#">Games</a></li>
					<li><a href="signup.php">Sign Up</a></li>
					<li><a href="login.php">Login</a></li>
				</ul>
				<ul class="user-navbar">
					<?php
						if (isset($_SESSION["userid"])) {
					?>
							<li><a href="#"><?php echo $_SESSION["userid"]; ?></a></li>
							<li><a href="includes/logout.inc.php">Logout</a></li>
					<?php
						}
					?>
				</ul>
			</div>
		</nav>
	</header>