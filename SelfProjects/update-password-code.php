<?php session_start();

    if (!isset($_SESSION['token']) or !isset($_SESSION['username']) or !isset($_SESSION['email'])) {
        header("Location: ../index.php");
        exit();
    }
    # db user data
    $token =  $_SESSION['token'];
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    # user inputs
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $verify_new_password = $_POST['verify_new_password'];

    include_once('../db.php');
    $get_password = "SELECT * FROM users WHERE verify_token='$token' AND username='$username' LIMIT 1";
    $get_password_run = mysqli_query($connection, $get_password);
    $row = mysqli_fetch_array($get_password_run);

    if ($password == $row['password']) {
        if ($new_password == $verify_new_password) {
            $update_password = "UPDATE users SET password='$new_password' WHERE verify_token='$token' AND username='$username' LIMIT 1";
            $update_password_run = mysqli_query($connection, $update_password);
            if ($update_password_run) {
                mysqli_close($connection);
                $_SESSION['password_color'] = "#1aaa1a";
                $_SESSION['password_status'] = "Password Updated.";
                header("Location: AccountSettings.php");
                exit();
            } else {
                mysqli_close($connection);
                $_SESSION['password_color'] = "#ff2525";
                $_SESSION['password_status'] = "Something went wrong.";
                header("Location: AccountSettings.php");
                exit();
            }
        } else {
            mysqli_close($connection);
            $_SESSION['password_color'] = "#ff2525";
            $_SESSION['password_status'] = "New password and verify new password does not match.";
            header("Location: AccountSettings.php");
            exit();
        }
    } else {
        mysqli_close($connection);
        $_SESSION['password_color'] = "#ff2525";
        $_SESSION['password_status'] = "Invalid password.";
        header("Location: AccountSettings.php");
        exit();
    }
?>