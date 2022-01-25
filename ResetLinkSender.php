<?php session_start();

    /* THIS IS NOT THE SAME CODE ON THE SERVER */

    function send_password_reset($get_name, $get_email, $token) {
        // Recipient
        $to = $get_email;

        // Subject
        $subject = "Reset Password";

        // Message
        $message = "<h1>Hi there.</h1><p>Here is the link to reset password.</p> <a href='http://localhost:8080/www/Self%20Projects/auth%20&%20file/resetpassword.php?token=$token'>Reset Password</a>";

        // Headers
        $headers = "From: Ron's Projects <RonProjects@yahoo.com>\r\n";
        $headers .= "Reply-To: RonProjects@yahoo.com\r\n";
        $headers .= "Content-type: text/html\r\n";

        // Send email
        mail($to, $subject, $message, $headers);
    }
    
    include_once 'db.php';
    $flag = false;
    if(isset($_POST['password_reset_link'])){
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $token = md5(rand());

        $check_email = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $check_email_run = mysqli_query($connection, $check_email);
        
        if(mysqli_num_rows($check_email_run) > 0){
            $row = mysqli_fetch_array($check_email_run);
            $get_name = $row['username'];
            $get_email = $row['email'];

            $update_token = "UPDATE users SET verify_token='$token' WHERE email='$get_email' LIMIT 1";
            $update_token_run = mysqli_query($connection, $update_token);

            if ($update_token_run){
                send_password_reset($get_name, $get_email, $token);
                $flag = true;
            }
        }
    }
    mysqli_close($connection);

    if ($flag) {
        # return to forgotPass.php
        $_SESSION['color'] = "#1aaa1a";
        $_SESSION['status'] = "Link Sent";
        header("Location: forgotPass.php");
        exit();
    } else {
        $_SESSION['color'] = "#ff2525";
        $_SESSION['status'] = "Invalid Email";
        header("Location: forgotPass.php");
        exit();
    }
?>