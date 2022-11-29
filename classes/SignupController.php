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
}
