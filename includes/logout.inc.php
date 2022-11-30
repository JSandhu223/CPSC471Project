<?php

// Start a session do destroy the login sessiom
session_start();
session_unset();
session_destroy();

// Send the user back to the front page
header("location: ../index.php");