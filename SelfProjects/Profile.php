<?php session_start();
    $token = '';
    $username = '';
    $email = '';
    $isRegistered = false;
    if (isset($_SESSION['token'])){
        $token =  $_SESSION['token'];
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        $first_name = $_SESSION['first_name'];
        $last_name = $_SESSION['last_name'];
        $gender = $_SESSION['gender'];
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
    <link rel="icon" type="png" href="images/stoned.jpg">
    <link rel="stylesheet" href="styles/Nav.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <title>Profile</title>

    <style>
        .logo h1 {
            font-size: 40px;
            margin-bottom: 8px;
            margin-top: 8px;
            color: #fff;
        }
        .logo a:link{
            text-decoration: none;
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
            <li><a href="<?php if ($isRegistered) {echo "AccountSettings.php";} else {echo "../index.php";} ?>">Account Settings</a></li>
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

    <?php echo $first_name."-----".$last_name."-----".$gender ?>
    <h1>In Maintenance</h1>

</body>
</html>