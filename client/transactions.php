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
                <li class="nav-item ">
                    <a class="nav-link" href="../index.php?catid=1">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="rentals.php">Rentals</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="transactions.php?catid=1">Transactions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Ratings.php?catid=1">Ratings</a>
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

            <h1 class="my-4">Rentals</h1>


        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            <br>

            <div class="row">

                <?php
                require 'config.php';
                $ayd = $_SESSION['ayd'];
                $sql = "SELECT *,rentals.status AS st,equipments.equipId AS id FROM rentals JOIN equipments on rentals.equipId = equipments.equipId WHERE rentals.userId = '$ayd' AND rentals.status = 'Finished' OR rentals.status = 'Cancelled'";
                $r = $con->query($sql);

                if ($r->num_rows > 0) {

                    while ($row = $r->fetch_assoc()) {
                        $image = $row['equipimage'];

                        echo '
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <br>
                                     ' . '<img src="data:image/jpeg;base64,' . base64_encode($image) . '" />' . '
                                   <div class="card-body">
                                     <h4 class="card-title">
                                        <a href="#">' . $row['equipName'] . '</a>
                                      </h4>
                                        <h5>' . $row['equipPrice'] . '</h5>
                                        <p class="card-text">' . $row['equipDesc'] . '</p>
                                    </div>';

                        if($row['st'] == 'Renting') {
                            echo '
                                    <div class="card-footer text-center">
                                        <p class="card-text">' . $row['st'] . '</p>
                                        <form action="cancelRent.php" method="post">
                                            <input type="hidden" name="rentID" value="' . $row['id'] . '">
                                            <button class="btn btn-danger" type="submit">Cancel</button>
                                        </form>
                                       
                                    </div>
                                    
                                    
                                </div>
                            </div>';
                        }else{
                            echo '
                                    <div class="card-footer text-center">
                                        <p class="card-text">' . $row['st'] . '</p>
                                        <form action="cancelRent.php" method="post">
                                            <input type="hidden" name="rentID" value="' . $row['id'] . '">
                                        </form>
                                       
                                    </div>
                                    
                                    
                                </div>
                            </div>';
                        }



                    }
                } else {
                    echo "No Data from Database";
                }
                ?>



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
