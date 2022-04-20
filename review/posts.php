<?php
require_once"../config.php";
$sql = "SELECT * from review LEFT JOIN users on users.id = review.user_id order by review_id DESC; " ;
$result = mysqli_query($conn,$sql ) ;
include "../session.php"
?>

<?php
include "navbar.php";
include "../includes/reg_header.php"
?>

<div class="album py-5 bg-light">

    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
           <?php foreach  ($result as $row) {?>

            <div class="col">
                <div class="card shadow-sm">

                    <img src="review_image/<?php echo $row['review_image'] ?> " class="bd-placeholder-img card-img-top" width="100%" height="225"   alt="">

                    <div class="card-body">
                   <h5 class="card-title"> <?php echo $row['review_name'] ?> </h5>
                    <p class="card-text">By <?php echo $row['firstName'] . " " . $row['lastName']  ?> </p>
                        <p class="card-text"> <?php echo $row['review_foreword']?> </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                               <a href="view.php?id=<?php echo $row['review_id']?>" > <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
 </a>
                            </div>
                            <small class="text-muted"><?php echo $row['created']?></small>
                        </div>
                    </div>
                </div>
            </div>

<?php } ?>