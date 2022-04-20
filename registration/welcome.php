<?php
require_once "../session.php";
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>PHP login system!- HOME</title>
</head>
<body>
<a href="logout.php">Logout</a>



<div class="container mt-4">
    <h3><?php echo "Welcome ". $_SESSION['email']?>! You can now use this website</h3>
    <h3><?php echo "Welcome ". $firstname ?>! You can now use this website</h3>

    <?php
    //if the password section is empty,(applies for google logged users) the image is stored in google drive
    // if the passowrd section is not empty, the user is logged from the registration form. in that case upload will have the pictures.

    if (empty($_SESSION['password'])) {?>
    <img src="<?php echo $image ?>" alt="">
<?php } else { ?>
    <img src="../upload/<?php echo $image ?>" alt="">
    <?php } ?>
    <hr>



</div></body>
</html>
