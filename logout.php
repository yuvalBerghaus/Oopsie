<?php
    session_start();
    if (isset($_SESSION["uid"])) {
        //  ^ redirect to login if the variable is NOT set
            header("Location: login");
            session_destroy();
        }
?>