<?php
require_once "../config.php";
require_once "../session.php";
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $sql = "DELETE FROM review WHERE review_id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        //set parameter

        $param_id = $_GET["id"];
        if (mysqli_stmt_execute($stmt)) {
            header("location:posts.php");
        }
    }
}
?>