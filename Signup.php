<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <link rel="stylesheet" href="Index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<?php
include_once('Header.php');
?>

<body style="padding:0px 0px;width:100%;" id="LoginForm">
    <div style="padding:0px 0px;width:100%;" class="container">
        <div class="login-form">
            <div class="main-div">
                <div class="panel">
                    <h2>Please Sign Up </h2>
                </div>
                <form id="Login" method="POST">
                    <p style="color:red;" id="alert"></p>
                    <div class="form-group">
                        <label style="float:left;color:#E0AE00;" for="inputEmail">Enter email*</label>
                        <input type="email" class="form-control" name ="inputEmail" id="inputEmail" placeholder="Enter email address" required>
                    </div>
                    <div id="otp">
                        <input style="display:none;" type="number" class="form-control" id="inputotp" name="inputotp" placeholder="Enter OTP" required><br>
                        <button style="display:none;" class="btn btn-primary" id="verify">Verify</button>
                        <p id="verify2"></p>
                    </div>
                    <div class="form-group">
                        <label style="float:left;color:#E0AE00;" for="inputName">Enter name*</label>
                        <input type="text" class="form-control"  name ="inputName" disabled id="inputName" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label style="float:left;color:#E0AE00;" for="inputNumber">Enter mobile number*</label>
                        <input type="number" class="form-control"  name ="inputNumber" disabled id="inputNumber" placeholder="Email mobiile number" required>
                    </div>
                    <div class="form-group">
                        <label style="float:left;color:#E0AE00;" for="inputPassword">Enter password*</label>
                        <input type="password" class="form-control"  name ="inputPassword" disabled id="inputPassword" placeholder="Create new password" required>
                    </div>
                    <div class="form-group">
                        <label style="float:left;color:#E0AE00;" for="file">Profile*</label>
                        <input style="color:#E0AE00;" type="file"  name ="file" name="file" id="file"><br><br>
                    </div>
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">SIGN UP</button>
                </form>
            </div>
        </div>

        <?php
        include_once('Footer.php');
        ?>
</body>
<script>
    $(document).ready(function() {
        $("#Login").submit(function(e) {
            e.preventDefault();
            var formddatas = new FormData(document.getElementById("Login"));
            formddatas.append('file', $('input[type=file]')[0].files[0]);
            formddatas.append('action', 'signup');
            if ($('#inputName').val() != "") {
                // var inputEmail = $("#inputEmail").val();
                // var inputName = $("#inputName").val();
                // var inputNumber = $("#inputNumber").val();
                // var inputPassword = $("#inputPassword").val();
                $.ajax({
                    url: 'Helper.php',
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: formddatas,
                    // data: {

                    // action: 'signup',
                    // inputEmail: inputEmail,
                    // inputName: inputName,
                    // inputNumber: inputNumber,
                    // inputPassword: inputPassword,
                    // },
                    success: function(data) {
                        if (data) {
                            let jdata = JSON.parse(data);
                            if (jdata.status == 1) {
                                location.replace('Login.php');
                            }
                        } else if (jdata.status == 0) {
                            location.replace('Signup.php');
                        }

                    }
                })
            } else {
                $("#alert").html("Please fill all the required details !!");
            }

        })
    });
    $(document).ready(function() {
        $("#inputEmail").on('change', function(e) {
            e.preventDefault();
            var inputEmail = $("#inputEmail").val();
            $.ajax({
                url: 'Helper.php',
                method: 'POST',
                data: {
                    inputEmail: inputEmail,
                    action: 'CheckUserEmail'
                },
                success: function(data) {
                    let jdata = JSON.parse(data);
                    if (jdata.status == 1) {
                        $("#alert").html("Email Already Exist *");
                        $("#inputotp").css("display", "none");
                        $("#verify").css("display", "none");
                    } else if (jdata.status == 0) {
                        $("#alert").html("");
                        $("#inputotp").css("display", "block");
                        $("#verify").css("display", "block");
                        var inputEmail = $("#inputEmail").val();
                        $.ajax({
                            url: 'Helper.php',
                            method: 'POST',
                            data: {
                                inputEmail: inputEmail,
                                action: 'SendOtp'
                            },
                            success: function(data) {
                                let jdata = JSON.parse(data);
                                if (jdata.status == 1) {
                                    $("#verify2").html("Otp Sent Successfully !!");
                                } else if (jdata.status == 0) {
                                    $("#verify2").html("Otp not sent !");

                                }

                            }
                        })
                    }
                }

            })

        })
    });
    $(document).ready(function() {
        $("#verify").on('click', function(e) {
            e.preventDefault();
            var inputotp = $("#inputotp").val();
            $.ajax({
                url: 'Helper.php',
                method: 'POST',
                data: {
                    inputotp: inputotp,
                    action: 'CheckOtp'
                },
                success: function(data) {
                    let jdata = JSON.parse(data);
                    if (jdata.status == 1) {
                        $('#verify2').html("OTP Verified successfully !!");
                        $('#verify').css("display", "none");
                        $("#inputName").prop("disabled", false);
                        $("#inputNumber").prop("disabled", false);
                        $("#inputPassword").prop("disabled", false);
                        $("#inputotp").prop("disabled", true);
                    } else if (jdata.status == 0) {
                        $('#verify2').html("OTP not valid !!");
                    }
                }
            })
        })
    });
</script>

</html>