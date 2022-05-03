<?php
require_once "../config.php";
 require_once "../session.php" ;
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
            $review_id = $_SESSION['rvu'];
            $user_id = trim($_SESSION['id']);
            $content = $_POST['comment'];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                echo "Commnet done";
                $location = "view.php?id=". $_SESSION['rvu'] ." " ;
                header("location:".$location );
            } else {
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
            }
        } else {
            echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
        }

// Close statement
        mysqli_stmt_close($stmt);


    }
// Close connection
    mysqli_close($conn);
}

?>