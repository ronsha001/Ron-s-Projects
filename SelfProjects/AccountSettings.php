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

    $color = '';
    $value = '';
    $type = 'hidden';

    $password_type = 'hidden';
    $password_value = '';

    if (isset($_SESSION['status']) and isset($_SESSION['color'])){
        $value = $_SESSION['status'];
        $type = 'text';
        $color = $_SESSION['color'];

        unset($_SESSION['status']);
        unset($_SESSION['color']);
    }

    if (isset($_SESSION['password_status']) and isset($_SESSION['password_color'])){
        $password_value = $_SESSION['password_status'];
        $password_type = 'text';
        $color = $_SESSION['password_color'];

        unset($_SESSION['password_status']);
        unset($_SESSION['password_color']);
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ron Sharabi">
    <title>Account Settings</title>
    <link rel="icon" type="png" href="images/stoned.jpg">
    <link rel="stylesheet" href="styles/Nav.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <style>
        body{
            background: linear-gradient(to right, #2ed573, #f9ca24);
        }
        .logo h1 {
            font-size: 40px;
            margin-bottom: 8px;
            margin-top: 8px;
            color: #fff;
        }
        .logo a:link{
            text-decoration: none;
        }
        
        .container{
            position: absolute;
            left: 50%;
            top: 50%;
            display: inline;
        }
        .center{
            position: relative;
            transform: translate(-50%, -50%);
            width: 400px;
            background: white;
            border-radius: 10px;
            margin-top: 50px;
        }
        .center h1{
            text-align: center;
            padding: 0 0 20px 0;
            padding: 20px;
            border-bottom: 1px solid silver;
            margin-top: 20px;
        }
        .center form{
            padding: 0 40px;
            box-sizing: border-box;
        }
        form .txt_field{
            position: relative;
            border-bottom: 2px solid #adadad;
            margin: 30px 0;
        }
        .txt_field input{
            width: 100%;
            padding: 0 5px;
            height: 40px;
            font-size: 16px;
            border: none;
            background: none;
            outline: none;
        }
        .txt_field label{
            position: absolute;
            top: 50%;
            left: 5px;
            color: #adadad;
            transform: translateY(-50%);
            font-size: 16px;
            pointer-events: none;
            transition: .5s;
        }
        .txt_field span::before{
            content: '';
            position: absolute;
            top: 40px;
            left: 0;
            width: 0%;
            height: 2px;
            background: #2691d9;
            transition: .5s;
        }
        .txt_field input:focus ~ label,
        .txt_field input:valid ~ label{
            top: -5px;
            color: #2691d9;
        }
        .txt_field input:focus ~ span::before,
        .txt_field input:valid ~ span::before{
            width: 100%;
        }
        .pass{
            margin: -5px 0 20px 5px;
            color: #a6a6a6;
            cursor: pointer;
        }
        .pass:hover{
            text-decoration: underline;
        }
        input[type="submit"]{
            width: 100%;
            height: 50px;
            border: 1px solid;
            margin: 30px 0;
            background: #2691d9;
            border-radius: 25px;
            font-size: 18px;
            color: #e9f4fb;
            font-weight: 700;
            cursor: pointer;
            outline: none;
        }
        input[type="submit"]:hover{
            border-color: #2691d9;
            transition: .5s;
        }
        .signup_link{
            margin: 30px 0;
            text-align: center;
            font-size:16px;
            color: #666666;
        }
        .signup_link a{
            color: #2691d9;
            text-decoration: none;
        }
        .signup_link a:hover{
            text-decoration: underline;
        }
        .error{
            text-align: center;
        }
        .error input {
            width: 85%;
            text-align: center;
            margin-top: 20px;
            height: 30px;
            border-radius: 7px;
            background: <?php echo $color ?>;
            color: #fff;
            font-family: serif;
        }
        @media only screen and (max-width: 500px) {
            .center{
                width: 300px;
                margin-bottom: 50px;
            }  
        }
    </style>

</head>
<body>
    <!-- Navigation bar, Ty Dev Ed-->
    <nav>
        <div class="logo">
            <a href="index.php">
            <!-- <img class="myLogo" src="Project/images/LOGO.png" alt="logo"> -->
            <h1 class="h1-logo">Ron's Projects <i class="fas fa-globe"></i></h1>
            
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href='<?php if($isRegistered){echo "Profile.php";}else{echo "../index.php";} ?>'>Profile</a></li>
            <li><a href="AboutMe/AboutMe.php">About</a></li>
            <li><a href="../logout.php" >Logout</a></li>
        </ul>
        <div class="burger">
            <div class="lin1"></div>
            <div class="lin2"></div>
            <div class="lin3"></div>
        </div>        
    </nav>
    <script src="scripts/Nav.js" type="text/javascript"></script>
    
    <div class="container">

        <div class="center">
            <div class="error">
                <input type="<?php echo $type ?>" value="<?php echo $value; ?>" disabled>
            </div>
            
            <h1>Update Email</h1>
            <form action="update-email-code.php" method="POST">
                <div class="txt_field">
                    <input type="password" name="password" required>
                    <span></span>
                    <label>Password</label>
                </div>
                <div class="txt_field">
                    <input type="email" value="<?php echo $email; ?>" name="new_email" required>
                    <span></span>
                    <label>New Email</label>
                </div>
                <div class="txt_field">
                    <input type="email" value="<?php echo $email; ?>" name="verify_new_email" required>
                    <span></span>
                    <label>Verify New Email</label>
                </div>
                <input type="submit" value="Update">
            </form>
        </div>

        <div class="center">
            <div class="error">
                <input type="<?php echo $password_type ?>" value="<?php echo $password_value; ?>" disabled>
            </div>
            
            <h1>Update Password</h1>
            <form action="update-password-code.php" method="POST">
                <div class="txt_field">
                    <input type="password" name="password" required>
                    <span></span>
                    <label>Password</label>
                </div>
                <div class="txt_field">
                    <input type="password" name="new_password" required>
                    <span></span>
                    <label>New Password</label>
                </div>
                <div class="txt_field">
                    <input type="password" name="verify_new_password" required>
                    <span></span>
                    <label>Verify New Password</label>
                </div>
                <input type="submit" value="Update">
            </form>
        </div>

    </div>
    
</body>
</html>