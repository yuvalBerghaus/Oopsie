<?php
include('./db.php');
    session_start();
    if (isset($_SESSION["uid"])) {
        //  ^ redirect to login if the variable is NOT set
            header("Location: index.php");
            session_destroy();
        }
?>