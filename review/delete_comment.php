<?php
require_once('../config.php');
require_once "../session.php";
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $sql = "DELETE FROM comments WHERE comment_id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        //set parameter

        $param_id = $_GET["id"];
        if (mysqli_stmt_execute($stmt)) {
            $location = "view.php?id= ".$_SESSION['rvu']." ";
            echo $location ;
            header("location:$location");
        }else {
            echo"could not exec";
        }
    }
}else{
    echo"no id found";
}
?>
