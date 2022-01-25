<?php session_start();

    $value = '';
    $type = 'hidden';
    if (isset($_SESSION['status']) and !empty($_SESSION['status'])){
        $value = $_SESSION['status'];
        $type = 'text';
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Ron Sharabi">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="png" href="SelfProjects/images/stoned.jpg">
    <title>Register</title>
        
    <style>
        body{
            margin: 0;
            padding: 0;
            font-family: montserrat;
            background: linear-gradient(240deg, #2980b9, #8e44ad);
            height: 100vh;
            overflow: hidden;
        }
        .center{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background: white;
            border-radius: 10px;
        }
        .center h1{
            text-align: center;
            padding: 0 0 20px 0;
            border-bottom: 1px solid silver;
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
        .login_link{
            margin: 30px 0;
            text-align: center;
            font-size:16px;
            color: #666666;
        }
        .login_link a{
            color: #2691d9;
            text-decoration: none;
        }
        .login_link a:hover{
            text-decoration: underline;
        }
        .error{
            text-align: center;
        }
        .error input {
            width: 85%;
            text-align: center;
            margin: 20px 20px;
            height: 30px;
            border-radius: 7px;
            background: #ff2525;
            color: #fff;
            font-family: serif;
        }
        @media only screen and (max-width: 500px) {
            .center{
                width: 300px;
            }  
        }
    </style>
</head>
<body>
    <div class="center">
        <div class="error">
            <input type="<?php echo $type ?>" value="<?php echo $value; session_destroy(); ?>" disabled>
        </div>

        <h1>Register</h1>
        <form action="insertNewAccount.php" method="POST">
            <div class="txt_field">
                <input type="text" name="username" required>
                <span></span>
                <label>Username</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="txt_field">
                <input type="password" name="verify_password" required>
                <span></span>
                <label>Verify Password</label>
            </div>
            <div class="txt_field">
                <input type="email" name="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <input type="submit" value="Register">
        </form>
        <div class="login_link">
                Have an account? <a href="index.php">Login</a>
        </div>
        
    </div>

</body>
</html>