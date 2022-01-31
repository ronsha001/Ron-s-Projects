<?php session_start();

    if (!isset($_SESSION['token'])){
        header("Location: ../index.php");
        exit();
    }
    $token = $_SESSION['token'];
    $username = $_SESSION['username'];

    function setError($err){
        $_SESSION['picture_status'] = $err;
        $_SESSION['picture_error_color'] = "#ff2525";
    }

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $file = $_FILES['file'];
        
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'gif');

        if(in_array($fileActualExt, $allowed)){
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = 'images/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    include_once('../db.php');
                    $setProfilePicture = "UPDATE users SET picture_path='$fileDestination' WHERE verify_token='$token' AND username='$username' LIMIT 1";
                    $setProfilePicture_run = mysqli_query($connection, $setProfilePicture);

                    if ($setProfilePicture_run) {
                        mysqli_close($connection);
                        $_SESSION['picture'] = $fileDestination;
                        $_SESSION['picture_status'] = "Profile picture updated.";
                        $_SESSION['picture_error_color'] = "#1aaa1a";
                        header("Location: AccountSettings.php");
                        exit();
                    }
                    mysqli_close($connection);
                    
                } else {
                    setError("Your file is too big.");
                    header("Location: AccountSettings.php");
                    exit();
                }
            } else {
                setError("There was an error.");
                header("Location: AccountSettings.php");
                exit();
            }
        } else {
            setError("You cannot upload files of this type.");
            header("Location: AccountSettings.php");
            exit();
        }
    }
?>