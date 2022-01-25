<?php session_start();
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
<html>
    <head>
        <meta charset="UTF-8">
		<meta name="description" content="Ron's projects">
		<meta name="keywords" content="Projects algorithms">
		<meta name="author" content="Ron Sharabi">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' />
        <link rel="icon" type="png" href="images/stoned.jpg">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/Nav.css">
        <title>Projects Menu</title>
        
        <style>
            body {
                margin: 0px;
                padding: 0px;
            }
            .header {
                width: 100%;
                height: 100%;
            }

            #myVideo {
                margin-top: -150px;
                object-fit: cover;
                width: 100%;
                height: 100%;
                position: fixed;
                z-index: -1;
            }

            .wlcm {
                text-align: center;
            }

            .wlcm > h1 {
                font-size: 50px;
                color: rgb(255, 255, 255);
                margin-top: 100px;
                padding: 0px;
            }
            
            .container {
                text-align: center;
                
            }

            .container-buttons {
                width: 50%;
                margin-left: 25%;
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

            button {
                text-align: center;
                margin: 10px;
                width: auto;
                font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
                font-size: large;
                color: #fff;
                box-shadow: 0 6px 20px rgba(0, 85, 243, 0.17);
                -webkit-filter: drop-shadow(0 6px 20px rgba(56, 125, 255, 0.017));
                filter: drop-shadow(0 6px 20px rgba(56, 125, 255, 0.017));
                border-radius: 10px;
                text-decoration: none;
                background-color: transparent;
                
            }
            @media only screen and (max-width: 768px) {
                
                .wlcm > h1 {
                    font-size: 30px;
                    color: rgb(255, 255, 255);
                    margin-top: 100px;
                    margin-bottom: 20px;
                    padding: 0px;
                }

                .container-buttons {
                    width: 100%;
                    margin-left: 0%;
                }
                #myVideo {
                    margin-top: -150px;
                    object-fit: cover;
                    width: 100%;
                    height: 100%;
                    position: fixed;
                    z-index: -1;
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
                <li><a href="#">Home</a></li>
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



        <div class="header">
            <video autoplay muted loop id="myVideo">
                <source src="videos/video-1.mp4" type="video/mp4">
            </video>
            <div class="wlcm">
                <h1>Hello <?php echo $user ?>, Welcome to Ron's Projects</h1>
            </div>
            <div class="container">
                <ul class="container-buttons">
                    <button type="button" onclick="window.location.href='SalaryCalc.html'">Salary Calculator</button>
                    <button type="button" onclick="window.location.href='WalkingCharacter.html'">Walking Character</button>
                    <button type="button" onclick="window.location.href='runaway.html'">Runaway</button>
                    <button type="button" onclick="window.location.href='convertor.html'">Convertor</button>
                    <button type="button" onclick="window.location.href='CrackNumber.html'">CrackNumber</button>
                    <button type="button" onclick="window.location.href='Tic Tac Toe/TTTMenu.html'">Tic Tac Toe</button>
                    <button type="button" onclick="window.location.href='Sodoku Game/Sodoku.html'">Sodoku</button>
                    <button type="button" onclick="window.location.href='Miles&KM.html'">KM & Miles Convertor</button>
                    <button type="button" onclick="window.location.href='Sodoku Solver/SodokuSolver.html'">Sodoku Solver</button>
                    <button type="button" onclick="window.location.href='https://travel--app.herokuapp.com/'">TravelApp</button>
                    <button type="button" onclick="window.location.href='https://brain--gym.herokuapp.com/'">BrainGYM</button>
                </ul>
                
            </div>
        </div>
    </body>
</html>