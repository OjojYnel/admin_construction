<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
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
                <li class="nav-item active">
                    <a class="nav-link" href="transactions.php?catid=1">Transactions</a>
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

<div class="modal fade " id="exampleModal7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="php/addRatings.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="text-center">
                    <input id="ayd" type="hidden" value="" class="form-control" name="ayd">
                    <h5 class="modal-title" id="exampleModalLabel">Description</h5>
                    <h2 id="rate"></h2>

                </div>
                <div class="modal-body">
                    <div class="text-primary" id="idtoy"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>


            </div>
    </div>
    </form>
</div>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-3">

            <h1 class="my-4">Transactions</h1>


        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            <br>

            <div class="row">

                <?php
                require 'config.php';
                $ayd = $_SESSION['ayd'];
                $sql = "SELECT *,rentals.status AS st,rentals.rentalid As rid ,equipments.equipId AS id,users.fname AS fn,users.lname As ln FROM rentals JOIN equipments on rentals.equipId = equipments.equipId JOIN users ON equipments.spid = users.userid WHERE rentals.userId = '$ayd' ";
                $r = $con->query($sql);

                if ($r->num_rows > 0) {

                    while ($row = $r->fetch_assoc()) {
                        $image = $row['equipimage'];
                        $x = substr($row['equipDesc'], 0, 100);
                        echo '
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <br>
                                     ' . '<img width="250" height="250" src="data:image/jpeg;base64,' . base64_encode($image) . '" />' . '
                                   <div class="card-body">
                            <h5 class="card-title">
                                <h4>
                                    <small>Equipment</small>
                                    :' . $row['equipName'] . '
                                </h4>
                            </h5>
                            <h4>
                                <small>Price</small>
                                : ' . $row['equipPrice'] . '
                            </h4>
                            <h4>
                                <small>Service Provider</small>
                                : ' . $row['fn'] . " " . $row['ln'] . '
                            </h4>
                            <h4>
                                <small>Color</small>
                                : ' . $row['color'] . '
                            </h4>
                            <h4>
                                <small>Description</small>
                                :' . $x . '&nbsp;
                                <button id="rm" value="' . $row['equipId'] . '" data-id="' . $row['equipId'] . '"
                                        type="button" data-id="' . $row['equipId'] . '" class="btn btn-info rm"
                                        data-toggle="modal" data-target="#exampleModal7">
                                    Read More
                                </button>
                            </h4>
                        </div>';

                        if ($row['st'] != 'Renting') {
                            echo '
                                    <div class="card-footer text-center">
                                        <p class="card-text">Pending</p>
                                        <form action="cancelRent.php" method="post">
                                            <input type="hidden" name="rentID" value="' . $row['id'] . '">
                                            <button  id="rn"  data-id="' . $row['id'] . '" data-id2="' . $row['rid'] . '" type="button"  class="btn btn-info"  data-toggle="modal" data-target="#exampleModal2">Rent Now</button>
                                        </form>
                                       
                                    </div>
                                    
                                    
                                </div>
                            </div>';
                        } else {
                            echo '
                                    <div class="card-footer text-center">
                                        <p class="card-text">Ongoing</p>
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

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="rent.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Rental Information</h5>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                        <th>Duration(Hours)</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        </thead>

                        <tbody>
                        <tr>
                            <td>
                                <input id="dura" required onchange="totalPrice(this)" type="number" class="form-control" name="dura" min="1" max="24">
                            </td>
                            <td>

                                <input id="pr" disabled  class="form-control" >
                            </td>
                            <td>
                                <input id="pr2" disabled  class="form-control" value="" name="test">
                            </td>

                        </tr>
                        </tbody>
                    </table>


                    <input id="ayd2" type="hidden"  class="form-control" name="ayd">
                    <input id="ayd3" type="hidden"  class="form-control" name="ayd2">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Book">
                </div>
            </div>
        </form>
    </div>
</div>

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
<script src="search.js"></script>

</body>

<script>
    $(document).ready(function () {
        $('#exampleModal2').on("show.bs.modal", function (ev) {
            let id = $(ev.relatedTarget).data('id');
            let id2 = $(ev.relatedTarget).data('id2');

            $('#ayd2').val(id2);
            // $('#ayd').val(id);

            $.ajax({
                url: 'rentP.php',
                data: {ayd: id},
                dataType: 'JSON',
                success: function (data) {
                let x = data[0][0]
                    $('#pr').val(x);

                }
            });

        })
    });


    function totalPrice() {
        y = $('#dura').val();
        x = $('#pr').val();
        z = x * y
        console.log(z)
        $('#pr2').val(z)
        $('#ayd3').val(z)

    }



</script>

</html>
