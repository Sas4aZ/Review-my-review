<?php
require_once "../config.php";
include "../session.php";

//Define variables and initialize with empty values
$review_name =  $foreword =$review_description = "";
$review_name_err =$foreword_err = $review_description_err = $file_err = "";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //validation of the review name
    $input_review_name = trim($_POST["review_name"]);
    if (empty($input_review_name)) {
        $review_name_err = "Please enter a name of the review";
        echo "Please enter the name of the review";
    }else{
        $review_name = $input_review_name;
    }
$input_foreword = trim($_POST['review_foreword']) ;
    if(empty($input_foreword)){
        $foreword_err = "Please enter a foreword";
        echo "Please enter a review_description";
    }
    else{
        $foreword= $input_foreword;
    }
    //Validation review desctiption
    $input_review_description = trim($_POST["review_description"]);
    if(empty($input_review_description)){
        $review_description_err = "Please enter a review_description";
        echo "Please enter a review_description";
    }
    else{
        $review_description = $input_review_description;
    }
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
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
            // Check whether file exists before uploading it
            if(file_exists("upload/" . $filename)){
                echo $filename . " is already exists.";
            } else{
                move_uploaded_file($_FILES["photo"]["tmp_name"], "review_image/" . $filename);
                echo "Your file was uploaded successfully.";
            }
        } else{
            echo "Error: There was a problem uploading your file. Please try again.";
            $file_err = "error";
        }
    } else{
        echo "Error: " . $_FILES["photo"]["error"];
        $file_err = "error";
    }


    if(empty($review_name_err) && empty($file_err) && empty($foreword_err) && empty($review_description_err) ){


// Prepare an insert statement
        $sql = "INSERT INTO review (review_name, review_description, review_image , review_foreword, user_id) VALUES (?,?,?,?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $review_name, $review_description, $review_image, $foreword, $user_id);

            // Set parameters
            $review_name = trim($_POST['review_name']);
            $review_description = $_POST['review_description'] ;
            $review_image = $_FILES['photo']['name'];
            $user_id = $_SESSION['id'];
            $foreword = trim($_POST['review_foreword']) ;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                header("location: posts.php");
            } else {
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
            }
        } else {
            echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
        }

// Close statement
        mysqli_stmt_close($stmt);

// Close connection
        mysqli_close($conn);
    }
}
?>

<script src="../assets/js/ckeditor.js"> </script>
<?php include "../includes/reg_header.php" ?>
<?php include "navbar.php" ?>
<body>

<div class="b-example-divider"></div>



<div class="container col-xxl-8 px-4 py-5">
<form action="" method="post" enctype="multipart/form-data">
    Title of your review: <input type="text" class="form-control" placeholder="Enter title here" name="review_name"> <br>
A sentence about your review : <input type="text"  class="form-control" placeholder="Your Foreword" name="review_foreword">
    Insert your review here:<br> <textarea  class="form-control" cols="40" rows="10" id="editor" name="review_description"></textarea> <br>

    <input class="form-control" type="file" id="image" name="photo" >
    <label class="mb-3" for="image">Image of the book/anything related.</label> <br>

    <input type="submit" class="btn btn-primary mb-4" value="Submit">
</form>
</div>
</body>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<?php include "footer.php" ?>
</html>