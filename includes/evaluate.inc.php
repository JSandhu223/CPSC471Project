<?php

include "../classes/DBHandler.php";


// If the admin clicks Approve
if (isset($_POST["approve-game"])) {
    echo "Approved";
}

// If the admin clicks Reject
if (isset($_POST["reject-game"])) {
    echo "Rejected";
}