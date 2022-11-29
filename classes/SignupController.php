<?php

class SignupController
{

    private $username;
    private $email;
    private $password;
    private $passwordRepeat;

    // Constructor
    // This is called when a user fills in the sign up page and hits the submit button
    public function __construct($username, $email, $pwd, $pwdRepeat)
    {
        $this->username = $username;
        $this->email = $email;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
    }

    public function initiateSignup()
    {
        // Check if any of the input fields are empty
        if ($this->emptyField()) {
            // Send the user back to the sign up page with an error message in url
            header("location: ../signup.php?error=emptyinputfield");
            exit();
        }

        if (!$this->isValidUsername()) {
            // Send the user back to the sign up page with an error message in url
            header("location: ../signup.php?error=invalidusername");
            exit();
        }
    }

    private function emptyField()
    {
        $isEmpty = false;
        $emptyInput = "";

        if ($this->username == $emptyInput || $this->email == $emptyInput || $this->password == $emptyInput || $this->passwordRepeat == $emptyInput) {
            $isEmpty = true;
        }

        return $isEmpty;
    }

    private function isValidUsername()
    {
        $valid = true;

        // The username may consist of only alphabet characters, digits 0-9, and underscores
        if (!preg_match("/^[a-zA-Z0-9_]*$/", $this->username)) {
            $valid = false;
        }

        return $valid;
    }

    private function isValidEmail()
    {
        $valid = true;

        if (!preg_match("/^[a-zA-Z0-9]+@[a-zA-Z]+.+c+o+m$/", $this->email)) {
            $valid = false;
        }

        return $valid;
    }

    private function isValidPassword()
    {
        $valid = true;
        $pattern = "/^[a-zA-Z0-9!@#$%^&*()_?]*$/";
        $minLength = 10;

        // Check if tbe password contains any illegal characters
        if (!preg_match($pattern, $this->password)) {
            $valid = false;
        }

        // Check if the password is long enough
        if (strlen($this->password) < $minLength) {
            $valid = false;
        }

        // Check if the password is not the same as the username
        if ($this->password == $this->username) {
            $valid = false;
        }

        if ($this->password == $this->email) {
            $valid = false;
        }

        return $valid;
    }
}
