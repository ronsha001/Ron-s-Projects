<?php session_start();
    $token = '';
    $username = '';
    $email = '';
    $isRegistered = false;
    if (isset($_SESSION['token'])){
        $token =  $_SESSION['token'];
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        $isRegistered = true;
    } else {
        header("Location: ../index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h1>In Maintenance</h1>
</body>
</html>