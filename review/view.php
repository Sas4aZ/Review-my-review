<?php
require_once"../config.php";
include "../session.php";



    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter

        $id = trim($_GET["id"]);
        $_SESSION["rvu"] = $id ;
        // Prepare a select statement
        $sql = "SELECT * from review LEFT JOIN users on users.id = review.user_id WHERE review_id = ?; ";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result);

                    // Retrieve individual field value
                    $first_name = $row["firstName"];
                    $last_name = $row["lastName"];
                    $date = $row["created"];
                    $image = $row["review_image"];
                    $review_name = $row['review_name'];
                    $review_description = $row['review_description'];

                } else {
                    echo $_GET['id'];
                    // URL doesn't contain valid id. Redirect to error page
//                header("location: error.php");
//                exit();
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }


$sql = "SELECT * from comments LEFT JOIN users on users.id = comments.user_id WHERE review_id =" .$_GET["id"] . "  order by comment_id DESC; " ;
$result_comment = mysqli_query($conn,$sql ) ;

$sql  = "SELECT * from review LIMIT 10" ;
$result_list = mysqli_query($conn, $sql);
mysqli_stmt_close($stmt);

// Close connection
mysqli_close($conn);
include "../includes/reg_header.php";
include "navbar.php";



?>

<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1"> <?php echo $review_name ?> </h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2"><?php echo $date ?></div>
                    <!-- Post categories-->

                </header>
                <!-- Preview image figure-->
                <div class= "row-cols-auto align-items-center">
                <figure class="align-middle" ><img class="img-fluid align-middle rounded" src="review_image/<?php echo $image ?> " alt="..." /></figure>
                <!-- Post content--></div>


                <section class="mb-5">
                    <p class="fs-5 mb-4"> <?php echo nl2br($review_description);   ?> </p>
 </section>
            </article>
            <!-- Comments section-->

            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->
                        <form class="mb-4" action="insert_comment.php" method="post">
                            <textarea class="form-control" rows="3" name="comment" placeholder="Join the discussion and leave a comment!"></textarea>
                            <button type="submit" class="btn btn-primary">Submit</button></form>
                        <!-- Comment with nested comments-->
                        <!-- Single comment-->
                        <?php foreach  ($result_comment as $row) {?>
                                <div class="d-flex mb-4">
                        <div class="d-flex">

                           <?php if (empty($row['password'])) { ?>
                               <div class="flex-shrink-0"><img class="rounded-circle" width="40" height="40" style = "object-fit: cover; object-position: 100% 0;" src="<?php echo $row['image'] ?>" alt="" /></div>

                            <?php } else {  ?>
                               <div class="flex-shrink-0"><img class="rounded-circle" width="40" style = "object-fit: cover; object-position: 50% 50%;" height="40" src="../upload/<?php echo $row['image'] ?>" alt=""> </div>
                            <?php } ?>

                            <div class="ms-3">
                                <div class="fw-bold">  <?php echo $row['firstName'] . " " . $row['lastName']  ?></div>
                                <?php  echo $row['content_comment'] ?>

                            </div>
                        </div>

                                    <?php if ( (trim($_SESSION['id'])) == (trim($row['user_id']))) { ?>
                                    <div class="ms-auto p-2 bd-highlight">
                                        <div class="dropdown">
                                            <a class="" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                <button type="button" class="btn btn-outline-secondary">
                                                    <img src="../assets/images/three-dots-vertical.svg" alt="">
                                                    <span class="visually-hidden">Button</span>
                                                </button>
                                            </a>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li><a class="dropdown-item" href="delete_comment.php?id=<?php echo $row['comment_id']?> ">Delete</a></li>


                                            </ul>
                                        </div>
                                    </div>
                                <?php }?>
                                </div>

                        <?php
                 } ?>

                    </div>
                </div>
            </section>
        </div>

        <div class="col-lg-4">
            <!-- Search widget-->

            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Other reviews you might like</div>
                <div class="card-body">
                    <div class="row">
                        <div >
                            <ul class="list-unstyled mb-0">
                                <?php foreach ($result_list as $list)  { ?> <li> <a href="view.php?id=<?php echo $list["review_id"]?>" > <?php echo $list["review_name"]?></a> </li>
                                <?php
                                } ?>
                            </ul>

                    </div>
                </div>
            </div>
            <!-- Side widget-->

        </div>
    </div>
</div>
</div>
<!-- Footer-->

<?php include "footer.php" ?>


<!-- Bootstrap core JavaScript -->
<script src="/web/20201011125907js_/https://startbootstrap.github.io/startbootstrap-blog-post/vendor/jquery/jquery.min.js"></script>
<script src="/web/20201011125907js_/https://startbootstrap.github.io/startbootstrap-blog-post/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
