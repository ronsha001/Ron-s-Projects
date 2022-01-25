<?php session_start();
    
    $token = '';
    if (isset($_POST['postToken']) and !empty($_POST['postToken'])){
        $token = $_POST['postToken'];
    } else {
        //$link = "ResetPassword.php?$token";
        $_SESSION['color'] = "#ff2525";
        $_SESSION['status'] = "Token is empty.";
        header("Location: ResetPassword.php?token=$token");
        exit;
    }

    $pass = '';
    $verify_pass = '';

    if ($_POST['clickedReset']){
        $pass = $_POST['password'];
        $verify_pass = $_POST['verify_password'];

        if ($pass == $verify_pass) {
            include_once 'db.php';

            $check_token = "SELECT verify_token FROM users WHERE verify_token='$token' LIMIT 1";
            $check_token_run = mysqli_query($connection, $check_token);

            if (mysqli_num_rows($check_token_run) > 0) {
                $update_new_password = "UPDATE users SET password='$pass' WHERE verify_token='$token' LIMIT 1";
                $update_new_password_run = mysqli_query($connection, $update_new_password);
                
                $new_token = md5($token);
                $update_token = "UPDATE users SET verify_token='$new_token' WHERE verify_token='$token' LIMIT 1";
                $update_token_run = mysqli_query($connection, $update_token);

                mysqli_close($connection);
                $_SESSION['color'] = "#1aaa1a";
                $_SESSION['status'] = "your password has been reset.";
                header("Location: ResetPassword.php?token=$token");
                exit();
            } else {
                mysqli_close($connection);
                $_SESSION['color'] = "#ff2525";
                /* User trying to update new password with the same link. (user's token is not match to his current token) */
                $_SESSION['status'] = "Something went wrong. #3";
                header("Location: ResetPassword.php?token=$token");
                exit();
            }


            
        } else {
            $_SESSION['color'] = "#ff2525";
            $_SESSION['status'] = "Password and verify password does not match.";
            header("Location: ResetPassword.php?token=$token");
            exit();
        }
    } else {
        $_SESSION['color'] = "#ff2525";
        $_SESSION['status'] = "Something went wrong. #2";
        header("Location: ResetPassword.php?token=$token");
        exit();
    }
?>