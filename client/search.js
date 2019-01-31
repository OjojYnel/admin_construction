$(document).ready(function () {

    $("#sear").on("click",function () {
        let x = $('#search').val()
        console.log(x)

        $.ajax({

            url:"client/search.php?se=" + x,
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
                        if (data[i][5] === 'Available') {
                            da = '<div class="text-center"><button data-id="' + data[i][0] + '" type="button" class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal">' +
                                'Rent</button>';
                        }else{
                            da = '<a></a>';
                        }
                        
                        
                    dat += '<div class="col-lg-4 col-md-6 mb-4">' +
                            '<div class="card h-100"><br>' +
                        da
                             +
                            '</div><br>' +
                            '<img src="data:image/jpeg;base64,' + data[i][5] + '" />' +
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

    $("#rm").on("click",function () {
        let x = $('#rm').val()
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


