<?php
date_default_timezone_set('Asia/Manila');
include 'php/config.php';
session_start();

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
    <link href="client/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="client/css/shop-homepage.css" rel="stylesheet">

</head>


<body>

<div class="modal fade " id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <h5 class="modal-title" id="exampleModalLabel">Ratings</h5>
                    <h2 id="rate"></h2>

                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                        <th class="">Feedback</th>
                        <th class="">Rate</th>
                        </thead>
                        <tbody id="tab">

                        </tbody>
                    </table>
                    <hr>
                    <div>
                        <h3 class="text-center">Add Feedback</h3>
                        <textarea class="form-control" name="feed" placeholder="Feedback message"></textarea>
                        <br>
                        <select class="form-control" required name="rating">
                            <option selected disabled>Select Rating</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>

                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Add Feedback">
                    </div>


                </div>
            </div>
        </form>
    </div>
</div>
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


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Construction Rentals</a>

        <input type="text" style="width: 20%" id="search" placeholder="Search Equipment" class="form-control">
        &nbsp;
        <button id="sear" type="button" class="btn btn-primary">
            Search
        </button>


        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?catid=1">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>

                <?php
                if (isset($_SESSION['username'])) {
                    echo '
                <li class="nav-item">
                    <a class="nav-link" href="client/transactions.php?catid=1">Transactions</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="client/change_password.php">Change Password</a>
                </li>
                ';
                }

                ?>

                <?php

                if (isset($_SESSION['username'])) {
                    echo '<li class="nav-item">
                    <a class="nav-link" href="php/logout.php">Logout</a>
                </li>';
                } else {
                    echo '<li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>';
                }
                ?>

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

                <a href="index.php" class='list-group-item'>All Equipments</a>

                <?php
                require 'php/config.php';

                $sql = "SELECT * FROM categories";
                $r = $conn->query($sql);

                while ($row = $r->fetch_assoc()) {
                    echo "<a href=" . 'index.php?catid=' . $row['categoryId'] . " class='list-group-item'>" . $row['categoryName'] . "</a>";
                }

                ?>


                <br>
                <div class="text-center">
                    <h4 class="text-primary">Sort By:</h4>
                    <a href="#" onclick="sorta('equipPrice')" class="text-primary">Price</a>
                    <br>
                    <a href="#" onclick="sorta('equipName')" class="text-primary">Name</a>
                    <br>
                    <a href="#" onclick="sorta('color')" class="text-primary">Color</a>
                    <br>


                </div>
            </div>

        </div>
        <!-- /.col-lg-3 -->

        <div id="dito" class="col-lg-9">

            <br>

            <div class="row" id="sorta">

                <?php
                require 'php/config.php';
                if (isset($_GET['catid'])) {
                    $id = $_GET['catid'];
                    $sql = "SELECT * FROM equipments join users on equipments.spid = users.userid WHERE categoryId = '$id' AND equipStatus = 'Available' ORDER BY equipPrice";
                    $r = $conn->query($sql);

                    if ($r->num_rows > 0) {

                        while ($row = $r->fetch_assoc()) {
                            $image = $row['equipimage'];
                            $x = substr($row['equipDesc'], 0, 100);
                            echo '
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="card h-100">
                        <br>
                        <div class="text-center">
                            <button data-id="' . $row['equipId'] . '" type="button" class="btn btn-primary"
                                    data-toggle="modal" data-target="#exampleModal">
                                Book
                            </button>
                        </div>
                        <br>
                        ' . '<img src="data:image/jpeg;base64,' . base64_encode($image) . '" height="400"/>' . '
                        <div class="card-body">
                            <h5 class="card-title">
                                <h4>
                                    <small>Equipment</small>
                                    :' . $row['equipName'] . '
                                </h4>
                            </h5>
                            <h4>
                                <small>Price</small>
                                : ' . $row['equipPrice']  . ' <small>/hour</small> 
                            </h4>
                            <h4>
                                <small>Service Provider</small>
                                : ' . $row['fname'] . " " . $row['lname'] . '
                            </h4>
                            <h4>
                                <small>Color</small>
                                : ' . $row['color'] . '
                            </h4>
                            <h4>
                                <small>Description</small>
                                :' . $x . '&nbsp;
                                <button  value="' . $row['equipId'] . '" data-id="' . $row['equipId'] . '"
                                        type="button" data-id="' . $row['equipId'] . '" class="btn btn-info rm"
                                        data-toggle="modal" data-target="#exampleModal7">
                                    Read More
                                </button>
                            </h4>
                        </div>
                        <div class="card-footer"></div>
                        ';


                            $sql = "SELECT stars FROM ratings WHERE equipId = " . $row['equipId'];
                            $nn = $conn->query($sql);
                            $st = 0;
                            $fc = 0;
                            while ($ro = $nn->fetch_assoc()) {
                                $st2 = (int)$ro['stars'];

                                $st += $st2;
                                $fc++;

                            }

                            if ($nn->num_rows == 0) {
                                echo "<h5 class='text-center'>No Ratings Yet</h5>";
                            } else {
                                echo '<h5 class="text-center">Ratings : <strong>' . $st / $fc . '</strong>/5</h5>';
                            }


                            echo '<br>
                        <div class="text-center">
                            <button data-id="' . $row['equipId'] . '" type="button" class="btn btn-primary"
                                    data-toggle="modal" data-target="#exampleModal5">
                                Ratings
                            </button>
                        </div>
                        <br></div>
                </div>
                ';
                        }
                    } else {
                        echo "No Data from Database";
                    }
                } else {
                    $sql = "SELECT * FROM equipments join users on equipments.spid = users.userid  WHERE equipStatus = 'Available' ORDER BY equipPrice";
                    $r = $conn->query($sql);

                    if ($r->num_rows > 0) {

                        while ($row = $r->fetch_assoc()) {
                            $image = $row['equipimage'];
                            $x = substr($row['equipDesc'], 0, 100);
                            echo '
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="card h-100">
                        <br>
                        <div class="text-center">
                            <button data-id="' . $row['equipId'] . '" type="button" class="btn btn-primary"
                                    data-toggle="modal" data-target="#exampleModal">
                                Book
                            </button>
                        </div>
                        <br>
                        ' . '<img src="data:image/jpeg;base64,' . base64_encode($image) . '" height="400"/>' . '
                        <div class="card-body">
                            <h5 class="card-title">
                                <h4>
                                    <small>Equipment</small>
                                    :' . $row['equipName'] . '
                                </h4>
                            </h5>
                            <h4>
                                <small>Price</small>
                                : ' . $row['equipPrice'] . ' <small>/hour</small>
                            </h4>
                            <h4>
                                <small>Service Provider</small>
                                : ' . $row['fname'] . " " . $row['lname'] . '
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
                        </div>
                        <div class="card-footer"></div>
                        ';


                            $sql = "SELECT stars FROM ratings WHERE equipId = " . $row['equipId'];
                            $nn = $conn->query($sql);
                            $st = 0;
                            $fc = 0;
                            while ($ro = $nn->fetch_assoc()) {
                                $st2 = (int)$ro['stars'];

                                $st += $st2;
                                $fc++;


                            }


                            if ($nn->num_rows == 0) {
                                echo "<h5 class='text-center'>No Ratings Yet</h5>";
                            } else {
                                echo '<h5 class="text-center">Ratings : <strong>' . $st / $fc . '</strong>/5</h5>';
                            }


                            echo '<br>
                        <div class="text-center">
                            <button data-id="' . $row['equipId'] . '" type="button" class="btn btn-primary"
                                    data-toggle="modal" data-target="#exampleModal5">
                                Ratings
                            </button>
                        </div>
                        <br></div>
                </div>
                ';
                        }
                    } else {
                        echo "No Data from Database";
                    }
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


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="client/book.php" method="post">
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
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>Operator</th>
                        </thead>

                        <tbody>
                        <tr>
                            <td>
                                <?php
                                $da = date("Y-m-d");
                                $nda = Date("Y-m-d", strtotime($da . " + 1 days"));
                                echo '<input onchange="checkDate(this.value);"  required type="date" min="' . $nda . '" class="form-control" name="dr" placeholder="Date to Rent">';
                                ?>
                            </td>
                            <td><?php
                                $da = date("H:i");
                                echo '<input id="tym" required type="time" max="24:00:00" min="' . $da . '" class="form-control" name="ti" >';
                                ?>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios"
                                           id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        With Operator
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios"
                                           id="exampleRadios2" value="option2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Without Operator
                                    </label>
                                </div>
                            </td>

                        </tr>
                        </tbody>
                    </table>

                    <input id="ayd1" type="hidden" class="form-control" name="ayd">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Book">
                </div>
        </form>
    </div>
</div>


<!-- Bootstrap core JavaScript -->
<script src="client/vendor/jquery/jquery.min.js"></script>
<script src="client/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Main JS-->
<script src="client/search.js"></script>

</body>


<script>
    $(document).ready(function () {
        $('#exampleModal').on("show.bs.modal", function (ev) {
            let id = $(ev.relatedTarget).data('id');
            console.log(id)
            $('#ayd1').val(id);

        })
    });

</script>

<script>
    function checkdura(x) {
        y = x.length;
        document.getElementById("err").value = x
        if (y === 0) {
            alert("Please a valid duration!");

        }
    }

</script>

<script>

    function checkDate(x) {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();

        if (dd < 10) {
            dd = '0' + dd;
        }

        if (mm < 10) {
            mm = '0' + mm;
        }
        var to = yyyy + '-' + mm + '-' + dd;

        if (to < x) {
            var x = document.getElementById("tym").min = "";
        } else {

        }
        console.log(yyyy + '-' + mm + '-' + dd);
        console.log(x);
    }


    $(document).ready(function () {
        $('#exampleModal5').on("show.bs.modal", function (ev) {
            let id = $(ev.relatedTarget).data('id');
            console.log(id)

            $('#ayd').val(id);

            getRate(id)


        })
    });


    function sorta(x) {
        var myParam = location.search.split('catid=')[1]
        console.log(myParam)
        console.log(x)

        if(x === 'equipPrice'){
            console.log("aww2")
            if(myParam){
                var url = window.location.href;
                url += '&catid=' + myParam
                window.location.replace("index.php?catid=" +myParam)
            }else {
                var url = window.location.href;
                console.log(url)
                window.location.replace("index.php")
                console.log("22")
            }
        }else if(myParam){
            $.ajax({

                url: 'php/sort.php?ayd=' + myParam + '&s=' + x ,
                dataType: 'JSON',
                processData: false,

                success: function(data){
                    let c = '';
                    if (!Array.isArray(data) || !data.length) {
                        // array does not exist, is not an array, or is empty
                        c = "<tr><td>No Result</td></tr>";
                        $('#dito').html(c);
                    }else {
                        let dat = '';
                        let da = '';

                        for (let i = 0; i < data.length; i++) {
                            if (data[i][4] === 'Available') {
                                da = '<div class="text-center"><button data-id="' + data[i][0] + '" type="button" class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal">' +
                                    'Rent</button>';

                            }

                            console.log(data[i][1])


                            dat += '<div class="col-lg-6 col-md-6 mb-4">' +
                                '<br>' +
                                da
                                +
                                '</div><br>' +
                                '<img src="data:image/jpeg;base64,' + data[i][8] + '" height="400" />' +


                                '<div class="card-body">' +
                                    '<h5 class="card-title">' +
                                        '<small>Equipment</small>' + data[i][1] +
                                    '</h5>' +
                                    '<h5 class="card-title">' +
                                        '<small>Price</small>' + data[i][2] +
                                    '</h5>' +
                                    '<h5 class="card-title">' +
                                        '<small>Service Provider</small>' + data[i][3] + ' ' + data[i][4] + '/hour'+
                                    '</h5>' +
                                    '<h5 class="card-title">' +
                                        '<small>Color</small>' + data[i][5] +
                                    '</h5>' +
                                    '<h4>' +
                                        '<small>Description</small>&nbsp; '+ data[i][6] +
                                        '<button  value="' + data[i][0] + '" data-id="' + data[i][0] + '" type="button" '+
                                        'class="btn btn-info rm" data-toggle="modal" data-target="#exampleModal7">Read More</button>'+
                                    '</h4>' +
                                '</div>'


                        }
                        $('#dito').html(dat);
                        $(".rm").on("click",function () {
                            let x = $(this).val()
                            console.log(x +"asd")

                            $.ajax({

                                url:"php/getDesc.php?se=" + x,
                                dataType: 'JSON',
                                processData: false,

                                success: function(data){
                                    console.log(data)
                                    let c = '';
                                    if (!Array.isArray(data) || !data.length) {
                                        // array does not exist, is not an array, or is empty
                                        c = "<tr><td>No Result</td></tr>";
                                        $('#idtoy').html(c);
                                    }else {
                                        $('#idtoy').html(data);


                                    }
                                }
                            })
                        })
                    }
                }
            })
        }else{
            $.ajax({

                url: 'php/sort.php?s=' + x,
                dataType: 'JSON',
                processData: false,

                success: function(data){
                    let c = '';
                    if (!Array.isArray(data) || !data.length) {
                        // array does not exist, is not an array, or is empty
                        c = "<tr><td>No Result</td></tr>";
                        $('#dito').html(c);
                    }else {
                        let dat = '';
                        let da = '';

                        for (let i = 0; i < data.length; i++) {
                            if (data[i][4] === 'Available') {
                                da = '<div class="text-center"><button data-id="' + data[i][0] + '" type="button" class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal">' +
                                    'Rent</button>';


                            }
                            console.log(data[i][1])


                            dat += '<div class="col-lg-6 col-md-6 mb-4">' +
                                '<br>' +
                                da
                                +
                                '</div><br>' +
                                '<img src="data:image/jpeg;base64,' + data[i][8] + '" height="400" />' +


                                '<div class="card-body">' +
                                '<h5 class="card-title">' +
                                '<small>Equipment</small>' + data[i][1] +
                                '</h5>' +
                                '<h5 class="card-title">' +
                                '<small>Price</small>' + data[i][2] +
                                '</h5>' +
                                '<h5 class="card-title">' +
                                '<small>Service Provider</small>' + data[i][3] + ' ' + data[i][4] + '/hour'+
                                '</h5>' +
                                '<h5 class="card-title">' +
                                '<small>Color</small>' + data[i][5] +
                                '</h5>' +
                                '<h4>' +
                                '<small>Description</small>&nbsp; '+ data[i][6] +
                                '<button  value="' + data[i][0] + '" data-id="' + data[i][0] + '" type="button" '+
                                'class="btn btn-info rm" data-toggle="modal" data-target="#exampleModal7">Read More</button>'+
                                '</h4>' +
                                '</div>'




                        }
                        $('#dito').html(dat);

                        $(".rm").on("click",function () {
                            let x = $(this).val()
                            console.log(x +"asd")

                            $.ajax({

                                url:"php/getDesc.php?se=" + x,
                                dataType: 'JSON',
                                processData: false,

                                success: function(data){
                                    console.log(data)
                                    let c = '';
                                    if (!Array.isArray(data) || !data.length) {
                                        // array does not exist, is not an array, or is empty
                                        c = "<tr><td>No Result</td></tr>";
                                        $('#idtoy').html(c);
                                    }else {
                                        $('#idtoy').html(data);


                                    }
                                }
                            })
                        })
                    }
                }
            })
        }



    }

    function getRate(x) {
        $id = x;
        $.ajax({
            url: 'php/getRate.php',
            data: {ayd: $id},
            dataType: 'JSON',
            success: function (data) {
                if (!Array.isArray(data) || !data.length) {
                    // array does not exist, is not an array, or is empty
                    c = "<tr><td>No Feedback Yet</td></tr>";
                    $('#tab').html(c);
                    console.log("test")
                } else {
                    console.log(data);

                    let a = '';
                    let x = '';


                    for (let i = 0; i < data.length; i++) {
                        x += "<tr>" +
                            "<td>" + data[i][3] + "</td>" + "<td>" + data[i][4] + "</td>";
                    }
                    $('#tab').html(x);
                }

            }
        });
    }


</script>


</html>
