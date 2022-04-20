<?php
require '../config.php';
session_start();
if(isset($_SESSION['id'])){
    header('Location:../registration/welcome.php');
    exit;
}

require 'google-api/vendor/autoload.php';

// Creating new google client instance
$client = new Google_Client();

// client id (this is client id credential i made from)
$client->setClientId('499865125682-hn0co57u6akipdsnhqs543igga9ik4v4.apps.googleusercontent.com');
//  Client Secrect ()
$client->setClientSecret('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');
//  Redirect URL where the google will send after giving the code.
$client->setRedirectUri('http://localhost/review_site/google_login/google_login.php');

// Adding those scopes which we want to get (email & profile Information)
$client->addScope("email");
$client->addScope("profile");

//if the code is sent, which is done by get method.
if(isset($_GET['code'])):

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if(!isset($token["error"])){

        $client->setAccessToken($token['access_token']);

        // getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        // Storing data into database
        $id = mysqli_real_escape_string($conn, $google_account_info->id);
        $firstname = mysqli_real_escape_string($conn, trim($google_account_info->given_name));
        $lastname = mysqli_real_escape_string($conn, trim($google_account_info->family_name));
        $username = mysqli_real_escape_string($conn, trim($google_account_info->given_name));
        $email = mysqli_real_escape_string($conn, $google_account_info->email);
        $profile_pic = mysqli_real_escape_string($conn, $google_account_info->picture);

        // checking user already exists or not
        $get_user = mysqli_query($conn, "SELECT * FROM `users` WHERE `email`='$email'");
        $row= mysqli_fetch_array($get_user);
        if(mysqli_num_rows($get_user) > 0){
            $_SESSION['id'] = $row['id'];
            header('Location: ../registration/welcome.php');
            exit;

        }
        else{

            // if user does not exist, inserting the user.
            $insert = mysqli_query($conn, "INSERT INTO `users`(`username`, `firstName`, lastName, `email`,`image`) VALUES('$username','$firstname', '$lastname', '$email','$profile_pic')");

            if($insert){
                $get_user = mysqli_query($conn, "SELECT * FROM `users` WHERE `email`='$email'");
                $row= mysqli_fetch_array($get_user);

                $_SESSION['id'] = $row['id'];
                header('Location: ../registration/welcome.php');
                exit;
            }
            else{
                echo "Sign up failed!(Something went wrong).";
            }

        }

    }
    else{
        header('Location: google_login.php');
        exit;
    }

else:
    // Google Login Url = $client->createAuthUrl();
    ?>

    <a class="login-btn" href="<?php echo $client->createAuthUrl(); ?>">Login</a>

<?php endif; ?>