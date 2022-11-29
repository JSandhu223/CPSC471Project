<?php
// THIS CLASS DEALS WITH QUERYING THE LOGIN DATA TO OUR DATABASE

class LoginHandler extends DBHandler
{

    // We'll take in the username and password to login
    public function loginUser($username, $password)
    {
        // Create a prepared statement (PREVENTS SQL INJECTION)
        $stmt = $this->connect()->prepare("SELECT * FROM USER WHERE username = ? AND password = ?;");

        // Execute the query. The two question marks from stmt get replaced by these arguments
        $query = $stmt->execute(array($username, $password));

        // Check if the statement fails to execute
        if (!$query) {
            // Nullify our statement and query (just to be safe)
            $query = null;
            $stmt = null;
            // Send the user back to the login page with an error message in the url
            header("location: ../login.php?error=failed-to-execute-statment");
            exit();
        }

        // If we reach here, it means the query ran successfully
        $query = null;
        $stmt = null;
    }
}
