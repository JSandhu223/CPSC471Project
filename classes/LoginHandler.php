<?php

// THIS CLASS DEALS WITH QUERYING THE LOGIN DATA TO OUR DATABASE

class LoginHandler extends DBHandler
{

    public function loginUser($username_or_email, $password)
    {
        $isAdmin = false;

        if (substr($username_or_email, 0, 6) == "admin.") {
            $isAdmin = true;
        }

        if (!$isAdmin) {
            // Create a prepared statememt TO PREVENT SQL INJECTIONS
            $stmt = $this->connect()->prepare("SELECT * FROM USER WHERE (username = ? OR email = ?) AND password = ?;");
            // Execute the query, where these 2 arguments replace the question marks in our prepared statement
            $query = $stmt->execute(array($username_or_email, $username_or_email, $password));

            // If the query doesn't execute return an error
            if (!$query) {
                // Nullify the statement just to be safe
                $query = null;
                $stmt = null;
                // Send the user to the signup page with an error
                echo "<script type='text/javascript'>alert('Statement failed to execute. Please try again.');location='../index.php'</script>";
                // header("location: ../index.php?failed-to-execute-statement");
                exit();
            }

            $numRows = $stmt->rowCount();
            // If the query returns no rows then display an error
            if ($numRows == 0) {
                $query = null;
                $stmt = null;
                echo "<script type='text/javascript'>alert('User not found.');location='../index.php'</script>";
                // header("location: ../index.php?error=user-not-found");
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
                echo "<script type='text/javascript'>alert('Incorrect password.');location='../index.php'</script>";
                // header("location: ../index.php?error=incorrect-password");
                exit();
            }

            // Start a session for the user the logged in
            session_start();
            $_SESSION["username"] = $row[0]["Username"];

            $row = null;
            $query = null;
            $stmt = null;
        } else {
            // Create a prepared statememt TO PREVENT SQL INJECTIONS
            $stmt = $this->connect()->prepare("SELECT * FROM ADMINISTRATOR WHERE email = ? AND password = ?;");
            // Execute the query, where these 2 arguments replace the question marks in our prepared statement
            $query = $stmt->execute(array($username_or_email, $password));

            // If the query doesn't execute return an error
            if (!$query) {
                // Nullify the statement just to be safe
                $query = null;
                $stmt = null;
                // Send the user to the signup page with an error
                echo "<script type='text/javascript'>alert('Statement failed to execute. Please try again.');location='../index.php'</script>";
                // header("location: ../index.php?failed-to-execute-statement");
                exit();
            }

            $numRows = $stmt->rowCount();
            // If the query returns no rows then display an error
            if ($numRows == 0) {
                $query = null;
                $stmt = null;
                echo "<script type='text/javascript'>alert('User not found.');location='../index.php'</script>";
                // header("location: ../index.php?error=user-not-found");
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
                echo "<script type='text/javascript'>alert('Incorrect password.');location='../index.php'</script>";
                // header("location: ../index.php?error=incorrect-password");
                exit();
            }

            // Start a session for the user the logged in
            session_start();
            $_SESSION["admin"] = $row[0]["Email"];

            $row = null;
            $query = null;
            $stmt = null;
        }
    }
}
