<?php session_start();
    $isRegistered = false;
    $user = '';
    $login_or_logout = '';
    $loginLink_or_logoutLink = '';
    $first_name = '';
    if (!isset($_SESSION['username']) or empty($_SESSION['username'])){
        $user = "";
        $login_or_logout = "Login";
        $loginLink_or_logoutLink = "../../index.php";
    } else {
        $user = $_SESSION['username'];
        $first_name = $_SESSION['first_name'];
        $login_or_logout = "Logout";
        $loginLink_or_logoutLink = "../../logout.php";
        $isRegistered = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ron Sharabi">

    <link rel="icon" type="png" href="../images/stoned.jpg">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>


    <link rel="stylesheet" href="../styles/Nav.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <title>About Me</title>

    <style>
        body{
            padding: 0;
            margin: 0;
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
    </style>
</head>
<body>
    <!-- Navigation bar, Ty Dev Ed-->
    <nav>
        <div class="logo">
            <a href="../index.php">
            <!-- <img class="myLogo" src="Project/images/LOGO.png" alt="logo"> -->
            <h1 class="h1-logo">Ron's Projects <i class="fas fa-globe"></i></h1>
            
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="../index.php">Home</a></li>
            <li><a href='<?php if($isRegistered){echo "../Profile.php";}else{echo "../../index.php";} ?>'>Profile</a></li>
            <li><a href="<?php
                if ($isRegistered) {
                    echo "../AccountSettings.php";
                } else {
                    echo "../../index.php";
                } ?>">Account Settings</a></li>
            <li><a href=<?php echo $loginLink_or_logoutLink ?> > <?php echo $login_or_logout ?></a></li>
        </ul>
        <div class="burger">
            <div class="lin1"></div>
            <div class="lin2"></div>
            <div class="lin3"></div>
        </div>        
    </nav>
    <script src="../scripts/Nav.js" type="text/javascript"></script>
    
    <div class="section">
        <div class="container">
            <div class="content-section">
                <div class="title">
                    <h1>About Me</h1>
                </div>
                <div class="content">
                    <h3>Hi <?php echo $first_name ?>, my name is Ron and I created this website.</h3>
                    <p>I'm 25 years old, software engineer student and live in Israel, central.
                    While serving in the IDF as a security officer, I began to learn a little about software languages.
                    Upon completion of my duty, I enrolled for a degree in software engineering.
                    Today I am a third-year student.
                    I like challenging and interesting things, help others and learn new things.</p>
                    <p>Today I specialize mostly in Java, but I also deal with other software languages and technologies,
                    Such as Full Stack Developer, Backend, Frontend, React, NodeJS, JavaScript, PHP, Java, C, Git, Object Oriented,
                    Python, Cisco, Android, XML, Linux, Assembly, UML, MongoDB, MySQL.</p>
                    <div class="button">
                        <a href="https://github.com/ronsha001/Ron-s-Projects" target="_blank">Website Code</a>
                    </div>
                </div>
                <div class="social">
                    <a href="https://www.instagram.com/ronsharabii/" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/in/ron-sharabi-54267921b/" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="https://github.com/ronsha001" target="_blank"><i class="fab fa-github" ></i></a>
                </div>
            </div>
            <div class="image-section">
                <img src="../images/Me.png" alt="Picture of Ron">
            </div>
        </div>
    </div>
</body>
</html>