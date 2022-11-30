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

        $query = $stmt->rowCount();
        // If the query returns no rows then display an error
		if ($query == 0) {
            $query = null;
			$stmt = null;
			header("location: ../login.php?error=usernotfound");
			exit();
		}

        // This returns an array of the appropriate row that returns from our query
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pwd = $row[0]["password"];
        if ($pwd !== $password) {
            $row = null;
            $query = null;
            $stmt = null;
            header("location: ../login.php?error=incorrectpassword");
			exit();
        }

        // If we reach here, it means the user was found in the USER table
        $row = null;
        $query = null;
        $stmt = null;
    }
}