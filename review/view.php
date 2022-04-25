<?php
require_once"../config.php";
include "../session.php";



    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);
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


if  ($_SERVER['REQUEST_METHOD'] == "POST" ) {
    $input_comment = trim($_POST["comment"]);
    if (empty($input_comment)) {
        $comment_err = "Please enter a comment";
        echo "Please enter a comment";
    } else {
        $comment = $input_comment;
    }

    if (empty($comment_err)) {


// Prepare an insert statement
        $sql = "INSERT INTO comments (review_id, user_id, content_comment) VALUES (?,?,?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "iis", $review_id, $user_id, $content);

            // Set parameters
            $review_id = trim($_GET['id']);
            $user_id = trim($_SESSION['id']);
            $content = $_POST['comment'];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                echo "Commnet done";
            } else {
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
            }
        } else {
            echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
        }

// Close statement

    }
}
$sql = "SELECT * from comments LEFT JOIN users on users.id = comments.user_id WHERE review_id =" .$_GET["id"] . "  order by comment_id DESC; " ;
$result_comment = mysqli_query($conn,$sql ) ;

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
                <figure class="mb-4"><img class="img-fluid rounded" src="review_image/<?php echo $image ?> " alt="..." /></figure>
                <!-- Post content-->
                <section class="mb-5">
                    <p class="fs-5 mb-4"> <?php echo $review_description ?> </p>
<!--                    <p class="fs-5 mb-4">The universe is large and old, and the ingredients for life as we know it are everywhere, so there's no reason to think that Earth would be unique in that regard. Whether of not the life became intelligent is a different question, and we'll see if we find that.</p>-->
<!--                    <p class="fs-5 mb-4">If you get asteroids about a kilometer in size, those are large enough and carry enough energy into our system to disrupt transportation, communication, the food chains, and that can be a really bad day on Earth.</p>-->
<!--                    <h2 class="fw-bolder mb-4 mt-5">I have odd cosmic thoughts every day</h2>-->
<!--                    <p class="fs-5 mb-4">For me, the most fascinating interface is Twitter. I have odd cosmic thoughts every day and I realized I could hold them to myself or share them with people who might be interested.</p>-->
<!--                    <p class="fs-5 mb-4">Venus has a runaway greenhouse effect. I kind of want to know what happened there because we're twirling knobs here on Earth without knowing the consequences of it. Mars once had running water. It's bone dry today. Something bad happened there as well.</p>-->
                </section>
            </article>
            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->
                        <form class="mb-4" action="" method="post">
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
                                </div>
                        <?php
                 } ?>

                    </div>
                </div>
            </section>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                        <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                    </div>
                </div>
            </div>
            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">Web Design</a></li>
                                <li><a href="#!">HTML</a></li>
                                <li><a href="#!">Freebies</a></li>

                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">JavaScript</a></li>
                                <li><a href="#!">CSS</a></li>
                                <li><a href="#!">Tutorials</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side widget-->
            <div class="card mb-4">
                <div class="card-header">Side Widget</div>
                <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
            </div>
        </div>
    </div>
</div>
<!-- Footer-->
<?php include "footer.php" ?>
<!-- Bootstrap core JavaScript -->
<script src="/web/20201011125907js_/https://startbootstrap.github.io/startbootstrap-blog-post/vendor/jquery/jquery.min.js"></script>
<script src="/web/20201011125907js_/https://startbootstrap.github.io/startbootstrap-blog-post/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
