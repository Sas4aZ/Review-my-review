<?php
require_once "../config.php";

$username = $email = $password = $confirm_password = $first_name= $last_name = "";
$username_err = $email_err =  $password_err = $confirm_password_err = $first_name_err = $file_err = $last_name_err ="";
$username_err_class = $email_err_class = $password_err_class = $first_name_err_class = $last_name_err_class = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if username is empty

    if (empty(trim($_POST["username"]))) {
        $username_err = "Username cannot be blank";
    } else {
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username= trim($_POST['username']);
                    $username_err = " Username is already taken";
                    $username_err_class = "is-invalid";
                } else {
                    $username = trim($_POST['username']);
                    $username_err_class = "is-valid" ;
                }
            } else {
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);
//check for the email

    if (empty(trim($_POST["email"]))) {
        $email_err = "email cannot be blank";
    } else {
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set the value of param username
            $param_username = trim($_POST['email']);

            // Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already taken";
                    $email = trim($_POST['email']);
                    $email_err_class = "is_invalid";

                } else {
                    $email = trim($_POST['email']);
                    $email_err_class = "is-valid";
                }
            } else {
                echo "Something went wrong";
            }
        }
    }
    mysqli_stmt_close($stmt);
    $input_first_name = trim($_POST["first_name"]);
    if (empty($input_first_name)) {
        $first_name_err = "Please enter a first name.";
        $first_name_err_class= "is-invalid";


    } elseif (!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $first_name_err = "Please enter a valid first name.";
        $first_name = $input_first_name ;
        $first_name_err_class= "is-invalid";


    } else {
        $first_name = $input_first_name;
        $first_name_err_class = "is-valid";
    }


    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter a email.";
        $email_err_class = "is-invalid";
    } else {
        $email = $input_email;
        $email_err_class = "is-valid";
    }

// Validate last name
    $input_last_name = trim($_POST["last_name"]);
    if (empty($input_last_name)) {
        $last_name_err = "Please enter a last name.";
        $last_name_err_class = "is-invalid";
    } elseif (!filter_var($input_last_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $last_name_err = "Please enter a valid last name.";
        $last_name = $input_last_name;
        $last_name_err_class = "is-invalid";
    } else {
        $last_name = $input_last_name;
        $last_name_err_class = "is-valid";
    }

// Check for password
    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank";
        $password_err_class = "is-invalid";
    } elseif (strlen(trim($_POST['password'])) < 5) {
        $password_err = "Password cannot be less than 5 characters";
$password = trim($_POST['password']);
        $password_err_class = "is-invalid";
    } else {
        $password = trim($_POST['password']);
        $password_err_class = "is-valid";
    }

// Check for confirm password field
    if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
        $password_err = "Passwords should match";
        $confirm_password = trim($_POST['confirm_password']);
        $password_err_class = "is-invalid";
    }

    if(isset($_FILES["photo"]) && ($_FILES["photo"]["error"]) == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            move_uploaded_file($_FILES["photo"]["tmp_name"], "../upload/" . $filename);
            // Check whether file exists before uploading it
        } else{
       //     echo "Error: There was a problem uploading your file. Please try again.";
            $file_err = "error";
        }
    } else{
     //   echo "Error: " . $_FILES["photo"]["error"];
        $file_err = "error";
    }

// If there were no errors, go ahead and insert into the database
    if (empty($username_err) && empty($password_err) && empty($file_err) && empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($confirm_password_err)) {

        $sql = "INSERT INTO users (username, password,email, firstName, lastName, image) VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_password,$param_email, $first_name, $last_name, $filename );

            // Set these parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $first_name = trim($_POST['first_name']);
            $last_name = trim($_POST['last_name']);
            $param_email = trim($_POST['email']);
            $filename= $_FILES['photo']['name'];

            // Try to execute the query
            if (mysqli_stmt_execute($stmt)) {
                header("location:../index.php");
            } else {
                echo "Something went wrong... cannot redirect!";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}


?>


<?php include "../includes/reg_header.php" ?>
<body>
<!---->
<!--<a href="register.php">Register</a>-->
<!--<a href="login.php">Login</a>-->


<div class="b-example-divider"></div>
<div class="row align-items-center">
    <div class="col-sm-7 mx-auto col-lg-7">

<form class="p-4 p-md-5 border rounded-3 bg-light row g-3" action="" method="post" enctype="multipart/form-data">
<h3>Sign Up</h3>
    <hr>
    <div class="col-12">
    <div class="form-floating mb-3">
        <input type="text" required class="form-control <?php echo $username_err_class ; ?> "  value="<?php echo $username  ?>" id="floatingUsername"  name="username" placeholder="Username">
        <label for="floatingUsername">Username</label>
        <div class="valid-feedback">
            Looks good!
        </div>
        <div class="invalid-feedback">
            <?php echo $username_err ?>
        </div>
    </div>
</div>

    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="text" required class="form-control <?php echo $first_name_err_class ; ?>" value="<?php echo $first_name  ?>" name="first_name" id="first_name" placeholder="First Name">
            <label for="first_name">First Name</label>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                <?php echo $first_name_err ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="text" required class="form-control <?php echo $last_name_err_class ; ?>" value="<?php echo $last_name  ?>" name="last_name" id="last_name" placeholder="Last name">
            <label for="last_name">Last name</label>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                <?php echo $last_name_err ?>
            </div>

        </div>
    </div>

    <div class="col-12">
        <div class="form-floating mb-3">
            <input type="email" required class="form-control <?php echo $email_err_class ; ?>" value="<?php echo $email  ?>" id="floatingEmail" name="email" placeholder="name@example.com">
            <label for="floatingEmail">Email address</label>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                <?php echo $email_err ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="password" required class="form-control <?php echo $password_err_class ; ?>" value="<?php echo $password  ?>" id="floatingPassword" name="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                <?php echo $password_err ?>
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="password" required class="form-control <?php echo $password_err_class ; ?>"  value="<?php echo $confirm_password  ?>" id="floatingPassword2" name="confirm_password" placeholder="Re-enter password">
            <label for="floatingPassword2">Re-enter Password</label>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                <?php echo $password_err?>
            </div>
        </div>
    </div>

    <div class="col-12">

        <div class="form-floating mb-3">
            <input type="file" required class="form-control" name="photo" id="image" value="Insert image">
            <label for="image">Insert Image</label>
        </div>

    </div>


    <div class="col-md-6">
        <button type="submit" class="btn btn-primary">Sign in</button>

    </div>
<div class="col-md-6"><a href="google_login/google_login.php"> <button class="btn btn-secondary">Google login </button></a>
    <a href="../index.php" <button type="button" class="btn btn-secondary">Already have an account? </button> </a></div>



</form>
    </div>
</div>



</body>
</html>
















