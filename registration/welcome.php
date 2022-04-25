<?php
require_once "../session.php";
?>

<!--<!doctype html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--     Required meta tags -->
<!--    <meta charset="utf-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
<!---->
<!--    <title>PHP login system!- HOME</title>-->
<!--</head>-->
<!--<body>-->
<!--<a href="logout.php">Logout</a>-->
<!---->
<!---->
<!---->
<!--<div class="container mt-4">-->
<!--    <h3>--><?php //echo "Welcome ". $_SESSION['email']?><!--! You can now use this website</h3>-->
<!--    <h3>--><?php //echo "Welcome ". $firstname ?><!--! You can now use this website</h3>-->
<!---->
<!--    --><?php
//    //if the password section is empty,(applies for google logged users) the image is stored in google drive
//    // if the passowrd section is not empty, the user is logged from the registration form. in that case upload will have the pictures.
//
//    if (empty($_SESSION['password'])) {?>
<!--    <img src="--><?php //echo $image ?><!--" alt="">-->
<?php //} else { ?>
<!--    <img src="../upload/--><?php //echo $image ?><!--" alt="">-->
<!--    --><?php //} ?>
<!--    <hr>-->
<!---->
<!---->
<!---->
<!--</div></body>-->
<!--</html>-->


<?php include "../includes/reg_header.php"?>
<body>

<div class="b-example-divider"></div>

<div class="container ">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="../assets/images/books.jpeg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="800" height="600" loading="lazy">
        </div>
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold lh-1 mb-3">Your friend for writing review/literature work.</h1>
            <p class="lead">Review my review is your one stop for improving your grasp on literature by getting help yourself and being helped by the community. </p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="../review/review_post.php"> <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Sumbmit your reivew</button> </a>
                <a href="../review/posts.php"> <button type="button" class="btn btn-outline-secondary btn-lg px-4">Review other reviews</button> </a>
            </div>
        </div>
    </div>
</div>


</body>
</html>