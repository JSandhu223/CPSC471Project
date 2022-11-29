<?php
// THIS CLASS DEALS WITH QUERYING THE SIGN UP INFORMATION TO OUR DATABASE


class SignupHandler extends DBHandler
{

    public function createUser($username, $email, $password)
    {
        // Create a prepared statememt TO PREVENT SQL INJECTIONS
        $stmt = $this->connect()->prepare("INSERT INTO USER (username, email, password) VALUES (?, ?, ?);");

        // Execute the query, where these 3 arguments replace the question marks in our prepared statement
        $query = $stmt->execute(array($username, $email, $password));

        // If the query doesn't execute return an error
        if (!$query) {
            // Nullify the statement just to be safe
            $stmt = null;
            // Send the user to the signup page with an error
            header("location: ../signup.php?failedtoexecutestatement");
            exit();
        }
        
        // If we reach here, it means the user was successfully inserted into the USER table
        $stmt = null;
    }
}