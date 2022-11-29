<?php

// If the user clicked the submit button
if (isset($_POST["submit"])) {

	// Grabbing the data from the sign up form
	$username = $_POST["username"];
    $email = $_POST["email"];
	$password = $_POST["password"];
	$passwordRepeat = $_POST["passwordRepeat"];
}