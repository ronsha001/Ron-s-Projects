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
    $new_email = $_POST['new_email'];
    $verify_new_email = $_POST['verify_new_email'];

    include_once('../db.php');
    $get_password = "SELECT * FROM users WHERE verify_token='$token' AND username='$username' LIMIT 1";
    $get_password_run = mysqli_query($connection, $get_password);
    $row = mysqli_fetch_array($get_password_run);
    if ($password == $row['password']) {
        if ($new_email == $verify_new_email) {
            $update_email = "UPDATE users SET email='$new_email' WHERE verify_token='$token' AND username='$username' LIMIT 1";
            $update_email_run = mysqli_query($connection, $update_email);
            if ($update_email_run) {
                mysqli_close($connection);
                $_SESSION['email'] = $new_email;
                $_SESSION['color'] = "#1aaa1a";
                $_SESSION['status'] = "Email Updated.";
                header("Location: AccountSettings.php");
                exit();
            } else {
                mysqli_close($connection);
                $_SESSION['color'] = "#ff2525";
                $_SESSION['status'] = "Something went wrong.";
                header("Location: AccountSettings.php");
                exit();
            }
        } else {
            mysqli_close($connection);
            $_SESSION['color'] = "#ff2525";
            $_SESSION['status'] = "New email and verify new email does not match.";
            header("Location: AccountSettings.php");
            exit();
        }
    } else {
        mysqli_close($connection);
        $_SESSION['color'] = "#ff2525";
        $_SESSION['status'] = "Invalid password.";
        header("Location: AccountSettings.php");
        exit();
    }
    
?>