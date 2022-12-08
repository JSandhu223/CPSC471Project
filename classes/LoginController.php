<?php

class LoginController extends LoginHandler
{

    private $username_or_email;
    private $password;

    // Constructor
    // This is called when a user fills in the login page and hits the submit button
    public function __construct($username_or_email, $password)
    {
        $this->username_or_email = $username_or_email;
        $this->password = $password;
    }

    public function initiateLogin()
    {
        // Check if any of the input fields are empty
        if ($this->emptyField()) {
            // Send the user back to the login page with an error message in url
            header("location: ../index.php?error=emptyinputfield");
            exit();
        }

        // If none of these errors handlers are triggered, then create the user
        $this->loginUser($this->username_or_email, $this->password);
    }

    private function emptyField()
    {
        $isEmpty = false;


        if (empty($this->username_or_email) || empty($this->password)) {
            $isEmpty = true;
        }

        return $isEmpty;
    }
}
