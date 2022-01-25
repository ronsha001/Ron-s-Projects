<?php 
    define("HOST", "localhost");
    define("USER", "root");
    define("PASSWORD", "");
    define("DB", "authfile");

    $connection = mysqli_connect(HOST, USER, PASSWORD, DB);
    mysqli_set_charset($connection, "utf8");
?>