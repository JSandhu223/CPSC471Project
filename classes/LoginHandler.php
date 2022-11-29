<?php
// THIS CLASS DEALS WITH QUERYING THE LOGIN INFORMATION TO OUR DATABASE


class LoginHandler extends DBHandler
{

    public function loginUser($username, $password)
    {
        // Create a prepared statememt TO PREVENT SQL INJECTIONS
        $stmt = $this->connect()->prepare("SELECT * FROM USER WHERE username = ? AND password = ?;");

        // Execute the query, where these 3 arguments replace the question marks in our prepared statement
        $query = $stmt->execute(array($username, $password));

        // If the query doesn't execute return an error
        if (!$query) {
            // Nullify the statement just to be safe
            $query = null;
            $stmt = null;
            // Send the user to the signup page with an error
            header("location: ../login.php?failed-to-execute-statement");
            exit();
        }

        // If we reach here, it means the user was successfully inserted into the USER table
        $query = null;
        $stmt = null;
    }
}