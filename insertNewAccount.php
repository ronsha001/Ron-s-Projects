<?php session_start();
    # creating new account
    include_once 'db.php';
    $table = 'users';
    
    if(!empty($_POST['username']) and !empty($_POST['password']) and !empty($_POST['verify_password']) and !empty($_POST['email'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $verify_pass = $_POST['verify_password'];
        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        # Check if this username is already taken or if this email already has an account.
        $sql = "SELECT * FROM $table WHERE username='$user'";
        $result = mysqli_query($connection, $sql);
        $check_email = "SELECT email FROM $table WHERE email='$email'";
        $check_email_run = mysqli_query($connection, $check_email);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['status'] = "Please choose another username.";
            mysqli_close($connection);
            header("Location: createAccount.php");
            exit();
        }
        if (mysqli_num_rows($check_email_run) > 0) {
            $_SESSION['status'] = "This email already has an account.";
            mysqli_close($connection);
            header("Location: createAccount.php");
            exit();
        }
        if ($pass == $verify_pass){
            $token = md5(rand());
            $sql = "INSERT INTO `$table` (`username`, `password`, `email`, `verify_token`, `first_name`, `last_name`, `gender`) VALUES ('$user', '$pass', '$email', '$token', '$first_name', '$last_name', '$gender')";
            $insert = mysqli_query($connection, $sql);
            if ($insert){
                mysqli_close($connection);
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['status'] = "Something went wrong. #2";
                mysqli_close($connection);
                header("Location: createAccount.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Password and verify password does not match.";
            mysqli_close($connection);
            header("Location: createAccount.php");
            exit();
        }
        
    } else {
        $_SESSION['status'] = "Something went wrong.";
        mysqli_close($connection);
        header("Location: createAccount.php");
        exit();
    }

?>