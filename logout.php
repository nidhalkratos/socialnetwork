<?php
    session_start();
    echo '<html><head><link rel="stylesheet" type="text/css" href="styles/main.css"></head><body>';
    session_destroy();
    printf("<h1>Good Bye</h1>");
    printf('><a href="index.php">Back to homepage</a>');
    echo '</body>';
?>