<?php
// THIS FILE DEALS WITH SENDING SIGN UP FORM DATA TO THE SIGNUP CONTROLLER

// Import the appropriate files
// NOTE: ORDER OF THESE IMPORTS IS IMPORTANT!
include "../classes/DBHandler.php";
include "../classes/SignupHandler.php";
include "../classes/SignupController.php";

// If the user clicked the submit button
if (isset($_POST["signup-submit"])) {

    // Grabbing the data from the sign up form.
    // This data will be sent to the SignupController.
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["passwordRepeat"];

    // Begin the signup process
    $signupProcedure = new SignupController($username, $email, $password, $passwordRepeat);
    $signupProcedure->initiateSignup();

    // After signup, send the user to the home page
    header("location: ../index.php?message=signup-success");
}
