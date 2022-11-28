<?php

// If the user clicked the submit button
if (isset($_POST["submit"])) {

	// Grabbing the data from the sign up form
	$uid = $_POST["uid"];
	$pwd = $_POST["pwd"];
	$pwdRepeat = $_POST["pwdRepeat"];
	$email = $_POST["email"];
}