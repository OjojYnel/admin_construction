$(document).ready(function () {

    $("#exampleModal5").on("show.bs.modal",function () {
        let x = $('#search').val()
        console.log(x)

        $.ajax({

            url:"search.php?se=" + x,
            dataType: 'JSON',
            success: function(data){
                if (!Array.isArray(data) || !data.length) {
                    // array does not exist, is not an array, or is empty
                    c = "<tr><td>No Result</td></tr>";
                    $('#tbody').html(c);
                }else {
                    let dat = '';
                    let da = '';
                    console.log(data)
                    for (let i = 0; i < data.length; i++) {

                        if (data[i][4] !== 'Rented'){
                            da = "<td><button data-id='" + data[i][5]  + "' type='button' class='btn btn-primary'  data-toggle='modal' data-target='#exampleModal'>Rent</button></td></tr>";
                        } else {
                            da = "<td>Not Available</td></tr>";
                        }
                        
                        dat += "<tr>" +
                            "<td>" + data[i][0] + "</td>" +
                            "<td>" + data[i][1] + "</td>" +
                            "<td>" + data[i][2] + "</td>" +
                            "<td>" + data[i][3] + "</td>" +
                            "<td>" + data[i][4] + "</td>" + da;
                            

                    }
                    $('#tbody').html(dat);
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


