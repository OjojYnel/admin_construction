$(document).ready(function () {

    $("#sear").on("click",function () {
        let x = $('#search').val()
        console.log(x)

        $.ajax({

            url:"client/search.php?se=" + x,
            dataType: 'JSON',

            success: function(data){
                let c = '';
                if (!Array.isArray(data) || !data.length) {
                    // array does not exist, is not an array, or is empty
                    c = "<tr><td>No Result</td></tr>";
                    $('#tbody').html(c);
                }else {
                    let dat = '';

                    for (let i = 0; i < data.length; i++) {
                    dat += '<div class="col-lg-4 col-md-6 mb-4">' +
                            '<div class="card h-100"><br>' +
                            '<div class="text-center"><button data-id="' + data[i][0] + '" type="button" class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal">' +
                            'Rent' +
                            '</button></div><br>' +
                            '<div class="card-body">' +
                            '<h4 class="card-title">' +
                            '<a href="#">' + data[i][1] + '</a>' +
                        '</h4>' +
                        '<h5>' + data[i][2] + '</h5>' +
                        '<p class="card-text">' + data[i][3] + '</p>' +
                        '</div>' +
                        '<div class="card-footer"></div>' +
                            '</div>' +
                            '</div>';

                    console.log(dat)

                    }
                    $('#dito').html(dat);
                }
            }
        })
    })


    $('#subrent').on("click",function () {
        let x = $("#rentinfo").val();
        let y = $("#eqid").val();
        console.log(x + " " + y )

        $.ajax({
            url:"rent.php?rent=" + x + "&&eqid=" + y,
            dataType: 'JSON',
            success: function(datum){
                console.log(datum)
                let m = "Success! Waiting for approval";
                alert(m);
                window.location.replace("view.php")
            }
        })

    })

})


