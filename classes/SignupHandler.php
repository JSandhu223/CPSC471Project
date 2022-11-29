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
            $query = null;
            $stmt = null;
            // Send the user to the signup page with an error
            header("location: ../signup.php?failed-to-execute-statement");
            exit();
        }

        // If we reach here, it means the user was successfully inserted into the USER table
        $query = null;
        $stmt = null;
    }

    public function checkUsernameExists($username)
    {
        $alreadyExists = false;

        // Create a prepared statement (prevents SQL injection)
        $stmt = $this->connect()->prepare("SELECT * FROM USER WHERE username = ?;");

        // Execute the query
        $query = $stmt->execute(array($username));

        // Error if query fails to execute
        if (!$query) {
            $query = null;
            $stmt = null;
            header("location: ../signup.php?error=failed-to-execute-statement");
            exit();
        }

        // If we reach here, check to see if any rows were returned from the query
        if ($stmt->rowCount()) {
            $alreadyExists = true;
        }

        return $alreadyExists;
    }
}
