<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['email']))
{
    header("location:registration/welcome.php");
    exit;
}
require_once "config.php";

$email = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['email'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter email and password";
        echo $err;
    }
    else{
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    }


    if(empty($err))
    {
        $sql = "SELECT id, email, password FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_email);
        $param_email = $email;

        // Try to execute this statement
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1)
            {
                mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                if(mysqli_stmt_fetch($stmt))
                {
                    if(password_verify($password, $hashed_password))
                    {
                        // this means the password is corrct. Allow user to login
                        session_start();
                        $_SESSION["email"] = $email;
                        $_SESSION["id"] = $id;
                        $_SESSION["loggedin"] = true;

                        //Redirect user to welcome page
                        header("location: registration/welcome.php");

                    } else {
                        echo "oassword could not be verifies";
                    }
                }else  {
                    echo "could not fetch result";
                }

            }else {
                echo "no result found";
            }

        } else{
            echo "could not exec statement";
        }
    }


}


?>

<!--<!doctype html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="utf-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
<!--    <title>PHP login system!</title>-->
<!--</head>-->
<!--<body>-->
<!---->
<!--   <h1>Php Login System</h1>-->
<!--    <a href="register.php">Register</a>-->
<!--    <a href="login.php">Login</a>-->
<!---->
<!---->
<!--<div class="container mt-4">-->
<!--    <h3>Please Login Here:</h3>-->
<!--    <hr>-->
<!---->
<!--    <form action="login.php" method="post">-->
<!--            <label for="email">Username:</label>-->
<!--            <input type="text" name="email" id="email" placeholder="Enter Username">-->
<!--            <label for="password">Password:</label>-->
<!--            <input type="password" name="password" id="password" placeholder="Enter Password">-->
<!--        <button type="submit" >Submit</button>-->
<!--    </form>-->
<!---->
<!--</div>-->
<!--</body>-->
<!--</html>-->
<!---->

<?php include "includes/reg_header.php" ?>

<link href="assets/css/signin.css" rel="stylesheet">
</head>
<body class="text-center">

<main class="form-signin">
    <form action="" method="post">
<!--        <img class="mb-4" src="/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>


    </form>

        <a href="registration/register.php"> <button class="w-50 btn btn-lg btn-secondary">Register</button></a>


        <a href="google_login/google_login.php"> <button class="w-50 btn btn-lg btn-secondary">Google login </button></a>

</main>



</body>
</html>
<!--  <body class="text-center">-->
<!--    <form class="form-signin">-->
<!--      <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">-->
<!--      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>-->
<!--      <label for="inputEmail" class="sr-only">Email address</label>-->
<!--      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>-->
<!--      <label for="inputPassword" class="sr-only">Password</label>-->
<!--      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>-->
<!--      <div class="checkbox mb-3">-->
<!--        <label>-->
<!--          <input type="checkbox" value="remember-me"> Remember me-->
<!--        </label>-->
<!--      </div>-->
<!--      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>-->
<!--      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>-->
<!--    </form>-->
<!--  --><?php //require "../footer.php"?>



