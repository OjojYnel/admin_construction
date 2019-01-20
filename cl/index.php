<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Construction</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Construction Rentals</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rentals.php">Rentals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="transactions.php">My Transactions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Ratings.php">Ratings/Feedback</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="change_password.php">Change Password</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-3">

            <h1 class="my-4">Categories</h1>
            <div class="list-group">
                <a name=""></a>

                <?php
                require 'config.php';

                $sql = "SELECT * FROM categories";
                $r = $con->query($sql);

                while ($row = $r->fetch_assoc()) {
                    echo "<a href=" . 'index.php?catid=' . $row['categoryId'] . " class='list-group-item'>" . $row['categoryName'] . "</a>";
                }

                ?>
            </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            <br>

            <div class="row">

                <?php
                require 'config.php';
                $id = $_GET['catid'];
                $sql = "SELECT * FROM equipments WHERE categoryId = '$id' AND equipStatus = 'Available' ";
                $r = $con->query($sql);

                if ($r->num_rows > 0) {

                    while ($row = $r->fetch_assoc()) {
                        $image = $row['equipimage'];
                        echo '
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <br>
                                       <div class="text-center"><button data-id="' . $row['equipId'] . '" type="button" class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal">
                                            Rent
                                        </button></div>
                                    <br>
                                     ' . '<img src="data:image/jpeg;base64,' . base64_encode($image) . '" />' . '
                                   <div class="card-body">
                                     <h4 class="card-title">
                                        <a href="#">' . $row['equipName'] . '</a>
                                      </h4>
                                        <h5>' . $row['equipPrice'] . '</h5>
                                        <p class="card-text">' . $row['equipDesc'] . '</p>
                                    </div>
                                    <div class="card-footer"></div>
                                </div>
                            </div>';
                    }
                } else {
                    echo "No Data from Database";
                }
                ?>

                <!--            <div class="col-lg-4 col-md-6 mb-4">-->
                <!--              <div class="card h-100">-->
                <!--                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>-->
                <!--                <div class="card-body">-->
                <!--                  <h4 class="card-title">-->
                <!--                    <a href="#">Item One</a>-->
                <!--                  </h4>-->
                <!--                  <h5>$24.99</h5>-->
                <!--                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>-->
                <!--                </div>-->
                <!--                <div class="card-footer">-->
                <!--                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>-->
                <!--                </div>-->
                <!--              </div>-->
                <!--            </div>-->


            </div>
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
    </div>
    <!-- /.container -->
</footer>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="rent.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Duration</h5>
                </div>
                <div class="modal-body">
                    <input type="number" class="form-control" name="dura" placeholder="Number of Days to rent">
                    <input id="ayd" type="hidden" class="form-control" name="ayd">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Rent">
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

<script>
    $(document).ready(function () {
        $('#exampleModal').on("show.bs.modal", function (ev) {
            let id = $(ev.relatedTarget).data('id');
            $('#ayd').val(id);

        })
    });


</script>

</html>
