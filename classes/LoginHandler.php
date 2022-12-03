<?php

// THIS CLASS DEALS WITH QUERYING THE LOGIN DATA TO OUR DATABASE

class LoginHandler extends DBHandler
{

    public function loginUser($username, $password)
    {
        // Create a prepared statememt TO PREVENT SQL INJECTIONS
        $stmt = $this->connect()->prepare("SELECT * FROM USER WHERE username = ? AND password = ?;");

        // Execute the query, where these 2 arguments replace the question marks in our prepared statement
        $query = $stmt->execute(array($username, $password));

        // If the query doesn't execute return an error
        if (!$query) {
            // Nullify the statement just to be safe
            $query = null;
            $stmt = null;
            // Send the user to the signup page with an error
            header("location: ../index.php?failed-to-execute-statement");
            exit();
        }

        $numRows = $stmt->rowCount();
        // If the query returns no rows then display an error
		if ($numRows == 0) {
            $query = null;
			$stmt = null;
			header("location: ../index.php?error=user-not-found");
			exit();
		}
        
        // If we reach here it means at least 1 row was returned
        // This returns an array of the appropriate row that returns from our query
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pwd = $row[0]["Password"];
        if ($pwd !== $password) {
            $row = null;
            $query = null;
            $stmt = null;
            header("location: ../index.php?error=incorrect-password");
			exit();
        }

        // Start a session for the user the logged in
		session_start();
        $_SESSION["username"] = $row[0]["Username"];

        $row = null;
        $query = null;
        $stmt = null;
    }
}