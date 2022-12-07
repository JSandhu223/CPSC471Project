<?php
session_start();

include "../classes/DBHandler.php";
$con = new DBHandler();

if (isset($_POST["group-submit"])) {
    $group_name = $_POST["group-name"];

    // Get userID
    $stmt = $con->connect()->prepare("SELECT UserID FROM USER WHERE Username = ?;");
    $stmt->execute(array($_SESSION["username"]));
    $userID = $stmt->fetchColumn();
    
    // Append " - Group" to the group name
    $group_name .= " - Group";

    // Check if the user is already in the group they selected.
    $stmt = $con->connect()->prepare("SELECT UserID FROM MEMBER WHERE UserID = ? AND Gname = ?;");
    $stmt->execute(array($userID, $group_name));
    $result = $stmt->fetchColumn();
    
    if (!empty($result)) {
        echo "<script type='text/javascript'>alert('You have already joined this group.');location='../groups.php'</script>";
        exit();
    }

    // Insert the user into the group.
    $stmt = $con->connect()->prepare("INSERT INTO MEMBER(UserID, Gname) VALUES (?, ?)");
    $stmt->execute(array($userID, $group_name));
    
    // Increment the member count of the group by 1.
    $stmt = $con->connect()->prepare("UPDATE COMMUNITY_GROUP SET MEMCOUNT = MEMCOUNT + 1 WHERE Gname = ?;");
    $stmt->execute(array($group_name));
    }


    echo "<script type='text/javascript'>alert('You have joined the group!');location='../groups.php'</script>";
