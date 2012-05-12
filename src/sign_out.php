<?php include("include/header.php");
    session_start();
    session_destroy();
    echo "<script type='text/javascript' src='../javascript/made_it.js'></script>";
?>