<?php session_start();

    include_once 'db.php';
    $flag = false;
    if (isset($_POST['username']) and !empty($_POST['password'])){
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass' LIMIT 1";
        $result = mysqli_query($connection, $sql);

        $get_token = "SELECT * FROM users WHERE username='$user' AND password='$pass' LIMIT 1";
        $get_token_run = mysqli_query($connection, $get_token);
        $user_row = mysqli_fetch_array($get_token_run);

        $rows = mysqli_num_rows($result);
        
        if ($rows == 1){
            $flag = true;
            $_SESSION['username'] = $user;
            $_SESSION['time_start'] = time();
            $_SESSION['token'] = $user_row['verify_token'];
            $_SESSION['email'] = $user_row['email'];
            $_SESSION['first_name'] = $user_row['first_name'];
            $_SESSION['last_name'] = $user_row['last_name'];
            $_SESSION['gender'] = $user_row['gender'];
            if ($user_row['picture_path'] == null) {
                $_SESSION['picture'] = "images/default_profile_picture.png";
            } else {
                $_SESSION['picture'] = $user_row['picture_path'];
            }
        }
        
    }
    if ($flag) {
        header("Location: SelfProjects/index.php");
        exit();
    } else {
        $_SESSION['status'] = "Invalid Password or Username";
        mysqli_close($connection);
        header("Location: index.php");
        exit();
    }
?>
