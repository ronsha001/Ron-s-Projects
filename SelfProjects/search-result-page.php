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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ron Sharabi">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" type="text/css" href="styles/Nav.css">
    <link rel="stylesheet" type="text/css" href="Search.css">
    <link rel="stylesheet" type="text/css" href="ProfileCards.css">
    <link rel="icon" type="png" href="images/stoned.jpg">
    <title>Results</title>
</head>
<style>
    body{
        padding: 0;
        margin: 0;
        background: #DDDDDD;
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

    <!-- Search Box -->
    <form action="search-result-page.php" method="GET">
        <div class="search-container">
            <div class="search">
                <div class="icon"></div>
                <div class="input">
                    <input type="text" name="info" placeholder="Search Users" id="mysearch">
                </div>
                <span class="clear"></span>
            </div>
        </div>
    </form>
    <script src="scripts/Search.js" type="text/javascript"></script>

    <?php 
        if(isset($_GET['info'])){
            $fullName = $_GET['info'];
            $fullName = explode(" ", $fullName);
            $firstName = $fullName[0];
            $search_users = "SELECT * from users WHERE first_name LIKE '%$firstName%'";
            $lastName = '';
            if (count($fullName) > 1) {
                $lastName = $fullName[1];
                $search_users = "SELECT * from users WHERE first_name LIKE '%$firstName%' and last_name LIKE '%$lastName%'";
            }
            
            include_once('../db.php');
            $search_users_run = mysqli_query($connection, $search_users);

            echo "<div class='cards-container'>".
                        "<div class='cards'>";

            while($row = mysqli_fetch_array($search_users_run)){
                /*echo "<table>".
                        "<tr> <th>Name</th> <th>Gender</th> <th>Email</th></tr>".
                            "<tr>".
                                "<td>".$row[6]." ".$row[7]."</td>".
                                "<td>".$row[8]."</td>".
                                "<td>".$row[5]."</td>".
                        "</tr>".
                    "</table>";*/
                
                echo "<div class='cards-1 hover'>".
                        "<img src=".$row['picture_path']." alt='Profile Picture'>".
                        "<div class='card-footer'>".
                            "<h3>".$row['first_name']." ".$row['last_name']."</h3>".
                            "<p>".$row['gender']."</p>".
                            "<div class='social-icon'>".
                                "<a href='#'><i class='fab fa-instagram'></i></a>".
                                "<a href='#'><i class='fab fa-linkedin'></i></a>".
                                "<a href='#'><i class='fab fa-github'></i></a>".
                            "</div>".
                        "</div>".
                    "</div>";
            }
            echo "</div>".
            "</div>";
        } else {
            header("Location: index.php");
            exit();
        }
        
    ?>

</body>
</html>