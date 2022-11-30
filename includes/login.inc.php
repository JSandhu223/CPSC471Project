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

    // Grabbing the data from the sign up form.
    // This data will be sent to the SignupController.
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Begin the signup process
    $loginProcedure = new LoginController($username, $password);
    $loginProcedure->initiateLogin();

    // After signup, send the user to the home page
    header("location: ../index.php?message=login-success");
}