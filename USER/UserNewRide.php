<?php
session_start();
if (isset($_SESSION['user']['email'])) {
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="icon" href="https://lh3.googleusercontent.com/MKqBRB5pxA_c0iOLBkbpAPBe_wNyN8O5_X3ffXaWo8zsSvB4Emu8aWqkB7vjYtEx0usRQh8=s48" />
    <title>CED CAB</title>
    <script src="//code.jquery.com/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/1.1.1/typed.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    include_once("Header.php");
    ?>
    <div class="main">
        <p style="letter-spacing: 2px;font-size: 2.5rem;">
            Book a City Taxi to your destination from <span style="color:#E4B820;" id="example1">&nbsp;</span>
        </p>
        <p style="color: black; letter-spacing: 2px;font-size: 1.5rem;">
            Choose from a range of categories and prices
        </p>
        <div class="mainform">
            <button id="taxi">CITY TAXI</button>
            <hr />
            <p style="letter-spacing: 2px; font-size: 2em">
                Your everyday travel partner
            </p>
            <p style="letter-spacing: 2px; font-size: 1.5em; opacity: 0.6;margin-top: -20px;">
                AC Cabs for point to point travel
            </p>
            <p style="color:red" id="warning"></p>
            <form id="formID" method="POST">
                <label for="">&nbsp;&nbsp;PICKUP POINT&nbsp;</label>
                <select type="text" id="pickUpPoint" class="pickUpPoint" name="pickUpPoint" placeholder="pickup Location">
                    <option value="-1" default>Enter Pickup point</option>
                </select><br><br>
                <label for="">&nbsp;&nbsp;DROP POINT&nbsp;&nbsp;&nbsp;</label>
                <select type="text" id="dropPoint" class="dropPoint" name="dropPoint">
                    <option value="-1" default>Enter Drop Location</option>
                </select><br><br>
                <label for="">&nbsp;&nbsp;CAB TYPE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <select type="text" id="carType" class="carType" name="carType" onchange="carTyped()">
                    <option value="-1">Select CAB Type</option>
                    <option value="CedMicro">CedMicro</option>
                    <option value="CedMini">CedMini</option>
                    <option value="CedRoyal">CedRoyal</option>
                    <option value="CedSUV">CedSUV</option>
                </select><br><br>
                <label for="">&nbsp;&nbsp;Luggage&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="number" id="luggage" name="luggage" placeholder="Enter Luggage in KG."><br><br>
                <label for="">&nbsp;&nbsp;Profile&nbsp;&nbsp;Pic&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="file" id="file"><br><br>
                <button type="submit" id="submit" name="submit">Total Fare</button>
            </form>
        </div>
    </div>
    <?php include_once("Footer.php"); ?>
    <div class="modal foot_modal" id="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ride Details</h5>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <a href="Index.php">
                        <button id="confirm_ride" class="btn btn-primary">Confirm Ride</button></a>
                    <button class="btn btn-secondary" id="closeModal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $(example1).typed({
            strings: [
                "Charbagh.",
                "BBD.",
                "Kesarganj.",
                "Indira Nagar.",
                "Barabanki.",
                "Faizabad.",
                "Basti.",
                "Gorakhpur.",
            ],
            typeSpeed: 200,
            backspaceSpeed: 20,
            backspaceDelay: 800,
            repeatDelay: 2000,
            repeat: true,
            autoStart: true,
            startDelay: 100,
            loop: true,
        });
    });

    $("#pickUpPoint").change(function() {
        $("#dropPoint option").show();
        $("#dropPoint option[value=" + $(this).val() + "]").hide();
    });
    $("#dropPoint").change(function() {
        $("#pickUpPoint option").show();
        $("#pickUpPoint option[value=" + $(this).val() + "]").hide();
    });

    $(document).ready(function() {
        $("#submit").click(function(e) {
            e.preventDefault();
            let p = $('#pickUpPoint').val();
            let d = $('#dropPoint').val();
            let c = $('#carType').val();
            if (p != 0 && d != 0 && c != 0) {
                var pickUpPoint = $("#pickUpPoint").val();
                var dropPoint = $("#dropPoint").val();
                var carType = $("#carType").val();
                var luggage = $("#luggage").val();
                $.ajax({
                    url: '../Helper.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        pickUpPoint: pickUpPoint,
                        dropPoint: dropPoint,
                        carType: carType,
                        luggage: luggage,
                        action: "CalculateFare"
                    },
                    success: function(data) {
                        console.log(data);
                        let final = JSON.parse(JSON.stringify((data)));
                        $(".modal-body").html("<h3> Total Fare ="+final['totalfare']+ "-/ Rs.</h3>" + "<p> Total Luggage Price = " + final["luggageprice"] + "-/ Rs.</p>" + "<p> Total Distance = " + final['TotalDis'] + "KM</p>" + "<p>Pickup Point = " + final['pickUpPoint'] + "</p>" + "<p>Drop Point = " + final['DropPoint'] + "</p>" + "<p>Cab Type = " + final['cabType'] + "</p>");
                        $("#modal").modal('show');
                    }
                })
            } else {
                $("#warning").html("Please select all the fields !")
            }
        })
    })

    function carTyped() {
        let selected = document.getElementById("carType").value;
        if (selected == "CedMicro") {
            document.getElementById("luggage").value = "";
            document.getElementById("luggage").disabled = true;
            document.getElementById("luggage").placeholder =
                "Luggage is not allowed for current car.";
        } else {
            document.getElementById("luggage").value = "";
            document.getElementById("luggage").disabled = false;
            document.getElementById("luggage").placeholder = "Enter Luggage in KG.";
        }
    }
    $("#closeModal").click(function() {
        $("#modal").modal('hide');
    });


    $(document).ready(function() {
        getfunction();
    });

    function getfunction() {
        $.ajax({
            url: '../Helper.php',
            type: 'POST',
            data: {
                action: 'getData'
            },
            success: function(data) {
                let jdata = JSON.parse(data);
                console.log(jdata);
                let len = jdata.length;
                for (let i = 0; i < len; i++) {
                    $("#pickUpPoint").append("<option value=" + jdata[i]['id'] + ">" + jdata[i]['name'] + "</option>");
                    $("#dropPoint").append("<option value=" + jdata[i]['id'] + ">" + jdata[i]['name'] + "</option>");
                }
            }
        })
    }

</script>
</html>


<?php

} else {
    die("You are not a authorized user !!");
}
