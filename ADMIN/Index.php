<?php
session_start();
if (isset($_SESSION['admin']['email'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
        <link rel="stylesheet" href="Index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <title>Ride Details</title>
    </head>

    <body>
        <?php include_once('Header.php') ?>
        <div class="conatainer0">
            <div class="container1">
                <p>All Users</p>
                <p id="AUData"></p>
                <button id="AUsers" class="btn btn-primary">click for details</button>
            </div>
            <div class="container1">
                <p>All Rides</p>
                <p id="ARData"></p>
                <button id="ARides" class="btn btn-primary">click for details</button>
            </div>
            <div class="container3">
                <p>Total Earnings</p>
                <p id="earnings"></p>
                <p>All Completed Rides</p>
                <p id="TEData"></p>
                <button id="TEarnings" class="btn btn-primary">click for details</button>
            </div>
            <div class="container4">
                <p>All Cancelled Rides</p>
                <p id="ACaRData"></p>
                <button id="ACaRides" class="btn btn-primary">click for details</button>
            </div>
            <div class="container4">
                <p>All pending Rides</p>
                <p id="APRData"></p>
                <button id="APRides" class="btn btn-primary">click for details</button>
            </div>
        </div>
        <table>
            <thead id="thead">
            </thead>
            <tbody id="tbody">
            </tbody>
        </table>
        <?php
        include_once('Footer.php')
        ?>
    </body>

    <script>
        $(document).ready(function() {
            $("#APRides").click(function() {
                $("th").css("display", "none");
                $("td").css("display", "none");
                $('#APRides').prop("disabled", true);
                $('#ARides').prop("disabled", false);
                $('#AUsers').prop("disabled", false);
                $('#ACRides').prop("disabled", false);
                $('#TEarnings').prop("disabled", false);
                $('#ACaRides').prop("disabled", false);
                $.ajax({
                    url: '../Helper.php',
                    type: 'POST',
                    data: {
                        action: 'APRides'
                    },
                    success: function(data) {
                        let da = JSON.parse(data);
                        let len = da.length;
                        $("#APRData").html(len);
                        $("#thead").append("<tr>");
                        $("#thead").append("<th>Ride id</th>");
                        $("#thead").append("<th>User Id</th>");
                        $("#thead").append("<th>From</th>");
                        $("#thead").append("<th>Luggage</th>");
                        $("#thead").append("<th>Book date</th>");
                        $("#thead").append("<th>To</th>");
                        $("#thead").append("<th>Total distance</th>");
                        $("#thead").append("<th>Fare</th>");
                        $("#thead").append("<th>Status</th>");
                        $("#thead").append("<th>Action</th>");
                        $("#thead").append("</tr>");
                        for (let i = 0; i < len; i++) {
                            $("#tbody").append("<tr>");
                            $("#tbody").append("<td>" + da[i]['ride_id'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['customer_user_id'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['from'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['luggage'] + "Kg.</td>");
                            $("#tbody").append("<td>" + da[i]['ride_date'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['to'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['total_distance'] + "Km.</td>");
                            $("#tbody").append("<td>" + da[i]['total_fare'] + "-/Rs.</td>");
                            $("#tbody").append("<td><button class='btn btn-warning' disabled>Pending</button></td>");
                            $("#tbody").append("<td><button onclick='approve(" + da[i]['ride_id'] + ")' class='btn btn-success'>Approve</button> <button onclick='cancel(" + da[i]['ride_id'] + ")' class='btn btn-danger'>Cancel</button></td>");
                        }
                    }

                })
            })
        });
        $(document).ready(function() {
            $("#ACaRides").click(function() {
                $("th").css("display", "none");
                $("td").css("display", "none");
                $('#ACaRides').prop("disabled", true);
                $('#ARides').prop("disabled", false);
                $('#AUsers').prop("disabled", false);
                $('#ACRides').prop("disabled", false);
                $('#TEarnings').prop("disabled", false);
                $('#APRides').prop("disabled", false);
                $.ajax({
                    url: '../Helper.php',
                    type: 'POST',
                    data: {
                        action: 'ACaRides'
                    },
                    success: function(data) {
                        let da = JSON.parse(data);
                        let len = da.length;
                        $("#ACaRData").html(len);
                        $("#thead").append("<tr>");
                        $("#thead").append("<th>Ride id</th>");
                        $("#thead").append("<th>User Id</th>");
                        $("#thead").append("<th>From</th>");
                        $("#thead").append("<th>Luggage</th>");
                        $("#thead").append("<th>Book date</th>");
                        $("#thead").append("<th>To</th>");
                        $("#thead").append("<th>Total distance</th>");
                        $("#thead").append("<th>Fare</th>");
                        $("#thead").append("<th>Status</th>");
                        $("#thead").append("</tr>");
                        for (let i = 0; i < len; i++) {
                            $("#tbody").append("<tr>");
                            $("#tbody").append("<td>" + da[i]['ride_id'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['customer_user_id'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['from'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['luggage'] + "Kg.</td>");
                            $("#tbody").append("<td>" + da[i]['ride_date'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['to'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['total_distance'] + "Km.</td>");
                            $("#tbody").append("<td>" + da[i]['total_fare'] + "-/Rs.</td>");
                            $("#tbody").append("<td><button class='btn btn-danger' disabled>Cancelled</button></td>");
                        }
                    }

                })
            })
        });
        $(document).ready(function() {
            $("#TEarnings").click(function() {
                $("th").css("display", "none");
                $("td").css("display", "none");
                $('#TEarnings').prop("disabled", true);
                $('#ARides').prop("disabled", false);
                $('#AUsers').prop("disabled", false);
                $('#ACRides').prop("disabled", false);
                $('#ACaRides').prop("disabled", false);
                $('#APRides').prop("disabled", false);
                $.ajax({
                    url: '../Helper.php',
                    type: 'POST',
                    data: {
                        action: 'TEarnings'
                    },
                    success: function(data) {
                        let da = JSON.parse(data);
                        let len = da.length;
                        let earning = 0;
                        $("#TEData").html(len);
                        $("#thead").append("<tr>");
                        $("#thead").append("<th>Ride id</th>");
                        $("#thead").append("<th>User Id</th>");
                        $("#thead").append("<th>From</th>");
                        $("#thead").append("<th>Luggage</th>");
                        $("#thead").append("<th>Book date</th>");
                        $("#thead").append("<th>To</th>");
                        $("#thead").append("<th>Total distance</th>");
                        $("#thead").append("<th>Fare</th>");
                        $("#thead").append("<th>Status</th>");
                        $("#thead").append("</tr>");
                        for (let i = 0; i < len; i++) {
                            earning += parseInt(da[i]['total_fare']);
                            $("#tbody").append("<tr>");
                            $("#tbody").append("<td>" + da[i]['ride_id'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['customer_user_id'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['from'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['luggage'] + "Kg.</td>");
                            $("#tbody").append("<td>" + da[i]['ride_date'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['to'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['total_distance'] + "Km.</td>");
                            $("#tbody").append("<td>" + da[i]['total_fare'] + "-/Rs.</td>");
                            $("#tbody").append("<td><button class='btn btn-success' disabled>Completed</button></td>");
                            $("#earnings").html(earning);

                        }
                    }

                })
            })
        });
        $(document).ready(function() {
            $("#AUsers").click(function() {
                $("th").css("display", "none");
                $("td").css("display", "none");
                $('#AUsers').prop("disabled", true);
                $('#ARides').prop("disabled", false);
                $('#TEarnings').prop("disabled", false);
                $('#ACRides').prop("disabled", false);
                $('#ACaRides').prop("disabled", false);
                $('#APRides').prop("disabled", false);
                $.ajax({
                    url: '../Helper.php',
                    type: 'POST',
                    data: {
                        action: 'AUsers'
                    },
                    success: function(data) {
                        let da = JSON.parse(data);
                        let len = da.length;
                        $("#AUData").html(len);
                        $("#thead").append("<tr>");
                        $("#thead").append("<th>Sign-up date</th>");
                        $("#thead").append("<th>Email id</th>");
                        $("#thead").append("<th>Mobile</th>");
                        $("#thead").append("<th>Name</th>");
                        $("#thead").append("<th>User id</th>");
                        $("#thead").append("<th>Status</th>");
                        $("#thead").append("<th>Action</th>");
                        $("#thead").append("</tr>");
                        for (let i = 0; i < len; i++) {
                            $("#tbody").append("<tr>");
                            $("#tbody").append("<td>" + da[i]['dateofsignup'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['email_id'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['mobile'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['name'] + "Kg.</td>");
                            $("#tbody").append("<td>" + da[i]['user_id'] + "</td>");
                            if (da[i]['status'] == 0) {
                                $("#tbody").append("<td><button class='btn btn-danger' disabled>BLOCKED</button></td>");
                                $("#tbody").append("<td><button onclick='unblock(" + da[i]['user_id'] + ")' class='btn btn-success'>UNBLOCK</button></td>");
                            } else if (da[i]['status'] == 1) {
                                $("#tbody").append("<td><button class='btn btn-success' disabled>UNBLOCKED</button></td>");
                                $("#tbody").append("<td><button onclick='block(" + da[i]['user_id'] + ")' class='btn btn-danger'>BLOCK</button></td>");
                            }
                        }
                    }
                })
            })
        });
        $(document).ready(function() {
            $("#ARides").click(function() {
                $("th").css("display", "none");
                $("td").css("display", "none");
                $('#ARides').prop("disabled", true);
                $('#AUsers').prop("disabled", false);
                $('#TEarnings').prop("disabled", false);
                $('#ACRides').prop("disabled", false);
                $('#ACaRides').prop("disabled", false);
                $('#APRides').prop("disabled", false);
                $.ajax({
                    url: '../Helper.php',
                    type: 'POST',
                    data: {
                        action: 'ARides'
                    },
                    success: function(data) {
                        let da = JSON.parse(data);
                        let len = da.length;
                        $("#ARData").html(len);
                        $("#thead").append("<tr>");
                        $("#thead").append("<th>Ride id</th>");
                        $("#thead").append("<th>User Id</th>");
                        $("#thead").append("<th>From</th>");
                        $("#thead").append("<th>Luggage</th>");
                        $("#thead").append("<th>Book date</th>");
                        $("#thead").append("<th>To</th>");
                        $("#thead").append("<th>Total distance</th>");
                        $("#thead").append("<th>Fare</th>");
                        $("#thead").append("<th>Action</th>");
                        $("#thead").append("<th>Status</th>");
                        $("#thead").append("</tr>");
                        for (let i = 0; i < len; i++) {
                            $("#tbody").append("<tr>");
                            $("#tbody").append("<td>" + da[i]['ride_id'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['customer_user_id'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['from'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['luggage'] + "Kg.</td>");
                            $("#tbody").append("<td>" + da[i]['ride_date'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['to'] + "</td>");
                            $("#tbody").append("<td>" + da[i]['total_distance'] + "Km.</td>");
                            $("#tbody").append("<td>" + da[i]['total_fare'] + "-/Rs.</td>");
                            if (da[i]['status'] == 1) {
                                $("#tbody").append("<td><button onclick='cancel(" + da[i]['ride_id'] + ")' class='btn btn-danger'>cancel</button> <button onclick='approve(" + da[i]['ride_id'] + ")' class='btn btn-success'>approve</button></td>");
                                $("#tbody").append("<td><button class='btn btn-warning' disabled>Pending</button></td>");
                            } else if (da[i]['status'] == 0) {
                                $("#tbody").append("<td><button class='btn btn-danger' disabled>cancel</button> <button class='btn btn-success' disabled>approve</button></td>");
                                $("#tbody").append("<td><button class='btn btn-danger' disabled>Cancelled</button></td>");
                            } else if (da[i]['status'] == 2) {
                                $("#tbody").append("<td><button class='btn btn-danger' disabled>cancel</button> <button  class='btn btn-success' disabled>approve</button></td>");
                                $("#tbody").append("<td><button class='btn btn-success' disabled>Completed</button></td>");
                            }
                            $("#tbody").append("</tr>");
                        }
                    }
                })
            })
        });

        function approve(e) {
            // alert(e);
            $.ajax({
                url: '../Helper.php',
                type: 'POST',
                data: {
                    e: e,
                    action: 'approve'
                },
                success: function(data) {
                    if (data == 1) {
                        location.replace('Index.php');
                    } else if (data == 0) {
                        alert("Please try again");
                    }
                }
            })
        }

        function cancel(e) {
            $.ajax({
                url: '../Helper.php',
                type: 'POST',
                data: {
                    e: e,
                    action: 'cancell'
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

        function block(e) {
            $.ajax({
                type: 'POST',
                url: '../Helper.php',
                data: {
                    ew: e,
                    action: 'block'
                },
                success: function(data) {
                    if (data == 1) {
                        alert("succcessfully blocked !");
                        location.replace('Index.php');
                    } else if (data == 0) {
                        alert("something went wrong !!");
                    }
                }

            })
        }

        function unblock(e) {
            $.ajax({
                type: 'POST',
                url: '../Helper.php',
                data: {
                    e: e,
                    action: 'unblock'
                },
                success: function(data) {
                    if (data == 1) {
                        alert("succcessfully unblocked !");
                        location.replace('Index.php');
                    } else if (data == 0) {
                        alert("something went wrong !!");
                    }
                }

            })
        }
    </script>

<?php
} else {
    die("You can't Access");
} ?>

    </html>