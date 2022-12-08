<?php
// THIS CLASS SENDS THE LOGIN FORM DATA TO THE LOGIN CONTROLLER

// THIS FILE DEALS WITH SENDING SIGN UP FORM DATA TO THE SIGNUP CONTROLLER

// Import the appropriate files
// NOTE: ORDER OF THESE IMPORTS IS IMPORTANT!
include "../classes/DBHandler.php";
include "../classes/LoginHandler.php";
include "../classes/LoginController.php";

// If the user clicked the submit button
if (isset($_POST["login-submit"])) {

    // Grabbing the data from the login form.
    // This data will be sent to the LoginController.
    $username_or_email = $_POST["username-or-email"];
    $password = $_POST["password"];

    // Begin the signup process
    $loginProcedure = new LoginController($username_or_email, $password);
    $loginProcedure->initiateLogin();

    // After signup, send the user to the home page
    if(!$_SESSION["admin"]){
        header("location: ../profile.php?message=login-success");
    } else {
        header("location: ../evaluate.php?message=login-success");
    }
}