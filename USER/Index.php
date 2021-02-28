<?php
session_start();
if (isset($_SESSION['user']['email']) && $_SESSION['user']['password']) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
        <link rel="stylesheet" href="../Index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <title>Ride Details</title>
    </head>

    <body>
        <?php include_once('HeaderU.php') ?>
        <div class="conatainer0">
            <div class="container1">
                <p>Total Amount Paid</p>
                <p id="TAP"></p>
                <button id="CRides" class="btn btn-primary">click for details</button>
            </div>
            <div class="container2">
                <p>Pending Rides</p>
                <p id="TAP1"></p>
                <button id="PRides" class="btn btn-primary">click for details</button>
            </div>
            <div class="container3">
                <p>Total Rides</p>
                <p id="TAP2"></p>
                <button id="TRides" class="btn btn-primary">click for details</button>
            </div>
            <div class="container4">
                <p>Cancel Rides</p>
                <p id="TAP3"></p>
                <button id="TARides" class="btn btn-primary">click for details</button>
            </div>
        </div>
        <div class="DataTable">
            <table>
                <thead>
                    <tr id="head">
                        <th>Ride_id</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Total_fare</th>
                        <th>Luggage</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="description">
                </tbody>
            </table>
            <div class="BookRide">
                <a href="../Index.php">
                    <button class="btn btn-primary">Book a Ride !!</button>
                </a>
            </div>
        </div>

        <div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1>Customer Rides details</h1>
                    </div>
                    <div class="modal-body">
                    </div>

                </div>
            </div>
        </div>

        <?php
        include_once('Footer.php');
        ?>
    </body>

<?php
} else {
    die("You can't Access");
} ?>

<script>
    //CANCEL BUTTON 

    function cancel(e) {
        window.confirm("Do you want to delete this row ??");
        $.ajax({
            url: '../Helper.php',
            type: 'POST',
            data: {
                cancel: e,
                action: 'cancel',
            },
            success: function(data) {
                if (data == 1) {
                    location.replace('Index.php');
                } else if (data == 0) {
                    alert("Something went wrong !!");
                }

            }
        })
    }
    //Default Rides

    $(document).ready(function() {
        $('#PRides').prop("disabled", true);
        $.ajax({
            url: '../Helper.php',
            type: 'POST',
            data: {
                action: 'PRides'
            },
            success: function(data) {
                let da = JSON.parse(data);
                let len = da.length;
                for (let i = 0; i < len; i++) {
                    $("#description").append("<tr>");
                    $("#description").append("<td>" + da[i]['ride_id'] + "</td>");
                    $("#description").append("<td>" + da[i]['from'] + "</td>");
                    $("#description").append("<td>" + da[i]['to'] + "</td>");
                    $("#description").append("<td>" + da[i]['total_fare'] + "-/Rs.</td>");
                    $("#description").append("<td>" + da[i]['luggage'] + "Kg.</td>");
                    $("#description").append("<td><button onclick='cancel(" + da[i]['ride_id'] + ")' id='cancel'class='btn btn-primary'>cancel</button><br><button onclick='viewdetails(" + da[i]['ride_id'] + ")' id='viewdetails' class='btn btn-primary'>view details</button></td>");
                    $("#description").append("</tr>");
                }
            }
        })
    })

    //Total amount paid RIDES 

    $(document).ready(function() {
        $("#CRides").click(function() {
            $('#CRides').prop("disabled", true);
            $('td').css('display', 'none');
            $('#PRides').prop("disabled", false);
            $('#TRides').prop("disabled", false);
            $('#TARides').prop("disabled", false);

            $.ajax({
                url: '../Helper.php',
                type: 'POST',
                data: {
                    action: 'CRides'
                },
                success: function(data) {
                    let da = JSON.parse(data);
                    let len = da.length;
                    for (let i = 0; i < len; i++) {
                        $("#description").append("<tr>");
                        $("#description").append("<td>" + da[i]['ride_id'] + "</td>");
                        $("#description").append("<td>" + da[i]['from'] + "</td>");
                        $("#description").append("<td>" + da[i]['to'] + "</td>");
                        $("#description").append("<td>" + da[i]['total_fare'] + "-/Rs.</td>");
                        $("#description").append("<td>" + da[i]['luggage'] + "Kg.</td>");
                        $("#description").append("<td><button id='viewdetails' onclick='viewdetails(" + da[i]['ride_id'] + ")' class='btn btn-primary'>view details</button></td>");
                        $("#description").append("</tr>");
                    }

                }
            })
        })
    });



    //PENDING RIDES 

    $(document).ready(function() {
        $("#PRides").click(function() {
            $('#PRides').prop("disabled", true);
            $('td').css('display', 'none');
            $('#CRides').prop("disabled", false);
            $('#TRides').prop("disabled", false);
            $('#TARides').prop("disabled", false);

            $.ajax({
                url: '../Helper.php',
                type: 'POST',
                data: {
                    action: 'PRides'
                },
                success: function(data) {
                    let da = JSON.parse(data);
                    let len = da.length;
                    for (let i = 0; i < len; i++) {
                        $("#description").append("<tr>");
                        $("#description").append("<td>" + da[i]['ride_id'] + "</td>");
                        $("#description").append("<td>" + da[i]['from'] + "</td>");
                        $("#description").append("<td>" + da[i]['to'] + "</td>");
                        $("#description").append("<td>" + da[i]['total_fare'] + "-/Rs.</td>");
                        $("#description").append("<td>" + da[i]['luggage'] + "Kg.</td>");
                        $("#description").append("<td><button id='cancel'onclick='cancel(" + da[i]['ride_id'] + ")' class='btn btn-primary'>cancel</button><br><button onclick='viewdetails(" + da[i]['ride_id'] + ")' id='viewdetails' class='btn btn-primary'>view details</button></td>");
                        $("#description").append("</tr>");
                    }

                }
            })
        })
    });

    //Total Rides 

    $(document).ready(function() {
        $("#TRides").click(function() {
            $('#TRides').prop("disabled", true);
            $('td').css('display', 'none');
            $('#CRides').prop("disabled", false);
            $('#PRides').prop("disabled", false);
            $('#TARides').prop("disabled", false);

            $.ajax({
                url: '../Helper.php',
                type: 'POST',
                data: {
                    action: 'TRides'
                },
                success: function(data) {
                    let da = JSON.parse(data);
                    let len = da.length;
                    for (let i = 0; i < len; i++) {
                        if (da[i]['status'] == 1) {
                            $("#description").append("<tr>");
                            $("#description").append("<td>" + da[i]['ride_id'] + "</td>");
                            $("#description").append("<td>" + da[i]['from'] + "</td>");
                            $("#description").append("<td>" + da[i]['to'] + "</td>");
                            $("#description").append("<td>" + da[i]['total_fare'] + "-/Rs.</td>");
                            $("#description").append("<td>" + da[i]['luggage'] + "Kg.</td>");
                            $("#description").append("<td><button id='viewdetails' onclick='viewdetails(" + da[i]['ride_id'] + ")' class='btn btn-primary'>view details</button><br><button id='cancel' onclick='cancel(" + da[i]['ride_id'] + ")' class='btn btn-primary'>cancel</button></td>");
                            $("#description").append("</tr>");
                        }
                        $("#description").append("<tr>");
                        $("#description").append("<td>" + da[i]['ride_id'] + "</td>");
                        $("#description").append("<td>" + da[i]['from'] + "</td>");
                        $("#description").append("<td>" + da[i]['to'] + "</td>");
                        $("#description").append("<td>" + da[i]['total_fare'] + "-/Rs.</td>");
                        $("#description").append("<td>" + da[i]['luggage'] + "Kg.</td>");
                        $("#description").append("<td><button id='viewdetails' onclick='viewdetails(" + da[i]['ride_id'] + ")' class='btn btn-primary'>view details</button></td>");
                        $("#description").append("</tr>");
                    }

                }
            })
        })
    });

    // Cancel Rides
    $(document).ready(function() {
        $("#TARides").click(function() {
            $('#TARides').prop("disabled", true);
            $('td').css('display', 'none');
            $('#CRides').prop("disabled", false);
            $('#PRides').prop("disabled", false);
            $('#TRides').prop("disabled", false);

            $.ajax({
                url: '../Helper.php',
                type: 'POST',
                data: {
                    action: 'TARides'
                },
                success: function(data) {
                    let da = JSON.parse(data);
                    let len = da.length;
                    for (let i = 0; i < len; i++) {
                        $("#description").append("<tr>");
                        $("#description").append("<td>" + da[i]['ride_id'] + "</td>");
                        $("#description").append("<td>" + da[i]['from'] + "</td>");
                        $("#description").append("<td>" + da[i]['to'] + "</td>");
                        $("#description").append("<td>" + da[i]['total_fare'] + "-/Rs.</td>");
                        $("#description").append("<td>" + da[i]['luggage'] + "Kg.</td>");
                        $("#description").append("<td><button id='viewdetails' onclick='viewdetails(" + da[i]['ride_id'] + ")' class='btn btn-primary'>view details</button></td>");
                        $("#description").append("</tr>");
                    }

                }
            })
        })
    });

    function viewdetails(e) {
        // alert(e);
        $.ajax({
            url: '../Helper.php',
            type: 'POST',
            data: {
                ride_id: e,
                action: 'viewDetails',
            },
            success: function(data) {
                let da = JSON.parse(data);
                let len = da.length;
                // console.log(len);
                for (let i = 0; i < len; i++) {
                    if (da[i]['status']==0){
                        $(".modal-body").html("<h3>Total Fare =" + da[i]['total_fare'] + "-/Rs.</h3><hr>" + "<h4>Status = "+'cancelled'+"</h4><hr>" +"<p>Booking Date =" + da[i]['ride_date'] + "</p>" + "<p>Pickup Point =" + da[i]['from'] + "</p>" + "<p>Drop Point = " + da[i]['to'] + "</p>" + "<p> Total Distance = " + da[i]['total_distance'] + "Km. </p>" + "<p>Total Luggage = " + da[i]['luggage'] + "Kg.</p>" + "<p>Total Distance = " + da[i]['total_distance'] + "</p>");
                    }
                    else if (da[i]['status']==1){
                        $(".modal-body").html("<h3>Total Fare =" + da[i]['total_fare'] + "-/Rs.</h3><hr>" + "<h4>Status = "+'Pending'+"</h4><hr>" +"<p>Booking Date =" + da[i]['ride_date'] + "</p>" + "<p>Pickup Point =" + da[i]['from'] + "</p>" + "<p>Drop Point = " + da[i]['to'] + "</p>" + "<p> Total Distance = " + da[i]['total_distance'] + "Km. </p>" + "<p>Total Luggage = " + da[i]['luggage'] + "Kg.</p>" + "<p>Total Distance = " + da[i]['total_distance'] + "</p>");
                    }
                    else if (da[i]['status']==2){
                        $(".modal-body").html("<h3>Total Fare =" + da[i]['total_fare'] + "-/Rs.</h3><hr>" + "<h4>Status = "+'Completed'+"</h4><hr>" +"<p>Booking Date =" + da[i]['ride_date'] + "</p>" + "<p>Pickup Point =" + da[i]['from'] + "</p>" + "<p>Drop Point = " + da[i]['to'] + "</p>" + "<p> Total Distance = " + da[i]['total_distance'] + "Km. </p>" + "<p>Total Luggage = " + da[i]['luggage'] + "Kg.</p>" + "<p>Total Distance = " + da[i]['total_distance'] + "</p>");
                    }

                        $("#exampleModalCenter").modal('show');
                }
            },
            error: function(data) {
                alert(data);
            }
        })
    }

    $(document).ready(function(){
        // alert();
        $.ajax({
            url:'../Helper.php',
            type:'POST',
            data:{action:'info'},
            success:function(data){
                let da = JSON.parse(data);
                let len = da.length;
                let TotalAmount = 0;
                let PendingRide = 0;
                let CancelledRide = 0;
                    for (let i = 0; i < len; i++) {
                        if(da[i]['status']==2){
                             TotalAmount += parseInt(da[i]['total_fare']);
                        }
                        else if(da[i]['status']==1){
                            PendingRide += 1;
                        }
                        else if(da[i]['status']==0){
                            CancelledRide += 1;
                        }
                    }
                    $("#TAP").html(TotalAmount);
                    $("#TAP1").html(PendingRide);
                    $("#TAP2").html(len);
                    $("#TAP3").html(CancelledRide);

            }
            
        })
    })
</script>

    </html>