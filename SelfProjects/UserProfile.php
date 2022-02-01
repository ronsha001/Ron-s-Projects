<?php session_start();
    if(!(isset($_GET['firstName'])) or !(isset($_GET['lastName'])) or !(isset($_GET['picture_path'])) or !(isset($_GET['gender'])) or !(isset($_GET['email']))) {
        header("Location: index.php");
        exit();
    }
    $first_name = $_GET['firstName'];
    $last_name = $_GET['lastName'];
    $picture_path = $_GET['picture_path'];
    $gender = $_GET['gender'];
    $email = $_GET['email'];

    $isRegistered = false;
    $user = '';
    $login_or_logout = '';
    $loginLink_or_logoutLink = '';
    if (!isset($_SESSION['username']) or empty($_SESSION['username'])){
        $user = "Guest";
        $login_or_logout = "Login";
        $loginLink_or_logoutLink = "../index.php";
    } else {
        $user = $_SESSION['username'];
        $login_or_logout = "Logout";
        $loginLink_or_logoutLink = "../logout.php";
        $isRegistered = true;
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

    <title><?php echo $first_name.' '.$last_name ?></title>

    <style>
        body{
            padding: 0;
            margin: 0;
            background: #DDDDDD;
        }
        .container{
            padding: 30px;
            display: flex;
            flex-direction: row;
            align-items: center;
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
        .img-section{
            border-right: 1px solid #3d3d3d;
        }
        .img-section img{
            width: 200px;
            height: auto;
            margin-right: 12px;
        }
        .details ul{
            list-style-type: none;
            margin-left: 12px;
        }
        .details span{
            font-weight: bold;
            font-size: 18px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        @media screen and (max-width: 500px){
            .container{
                padding: 30px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .img-section{
                border-right: none;
                border-bottom: 1px solid #3d3d3d;
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
            <li><a href="<?php if ($isRegistered) {echo "AccountSettings.php";} else {echo "../index.php";} ?>">Account Settings</a></li>
            <li><a href=<?php echo $loginLink_or_logoutLink ?> > <?php echo $login_or_logout ?></a></li>
        </ul>
        <div class="burger">
            <div class="lin1"></div>
            <div class="lin2"></div>
            <div class="lin3"></div>
        </div>        
    </nav>
    <script src="scripts/Nav.js" type="text/javascript"></script>
    
    <div class="container">
        <div class="img-section">
            <img src="<?php echo $picture_path ?>" alt="Profile Picture">
        </div>
        
        <div class="details">
            <ul class="list">
                <li><span>First name: </span><?php echo $first_name ?></li>
                <li><span>Last name: </span><?php echo $last_name ?></li>
                <li><span>Gender: </span><?php echo $gender ?></li>
                <li><span>Email: </span><?php echo $email ?></li>
            </ul>
        </div>
    </div>
</body>
</html>