<?php

// THIS CLASS DEALS WITH CONNECTING TO THE DATABASE
class DBHandler
{

    public function connect()
    {
        try {
            $username = "root";
            $password = "Letmeinpls_123";
            // We are connecting to the 'gameplatform' database on localhost with the specified username and password
            $dbh = new PDO('mysql:host=localhost;dbname=gameplatform', $username, $password);
            return $dbh;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
