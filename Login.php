<?php
session_start();
if (isset($_SESSION['user']['email'])) {
    header('location:USER/Index.php');
} else {
?>
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

    <body id="LoginForm">
        <div class="container">
            <h1 class="form-heading">login Form</h1>
            <div class="login-form">
                <div class="main-div">
                    <div class="panel">
                        <h2> Login </h2>
                        <p style="color:red;" id="alert"></p>
                    </div>
                    <form id="Login" method="POST">
                        <p id="alert"></p>
                        <div class="form-group">
                            <label style="float:left;color:#E0AE00;" for="inputEmail">Enter email*</label>
                            <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email Address" required>
                        </div>
                        <div class="form-group">
                            <label style="float:left;color:#E0AE00;" for="inputPassword">Enter password*</label>
                            <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">
                        </div>
                        <div class="forget">
                            <p style="color: #E0AE00;">New User ? <a style="text-decoration:none;" href="Signup.php">Create account</a></p>
                        </div>
                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Login</button>

                    </form>
                </div>
            </div>
            <?php
            include_once('Footer.php');
            ?>
    </body>
    <script>
        $(document).ready(function() {
            $("#submit").click(function(e) {
                e.preventDefault();
                if ($('#inputEmail').val() != "" && $('#inputPassword').val() != "") {
                    var inputEmail = $("#inputEmail").val();
                    var inputPassword = $("#inputPassword").val();
                    $.ajax({
                        url: 'Helper.php',
                        type: 'POST',
                        data: {
                            inputEmail: inputEmail,
                            inputPassword: inputPassword,
                            action: 'CheckUser',
                        },
                        success: function(data) {
                            if (data == 1) {
                                alert("Welcome to your pannel !!");
                                location.replace("USER/Index.php");
                            } else if (data == 0) {
                                $("#alert").html("Invalid Username or password !!!");
                                $("#inputEmail").val("");
                                $("#inputPassword").val("");
                            } else if (data == 2) {
                                alert("Welcome to admin pannel !!");
                                location.replace("ADMIN/Index.php");
                            }
                        }
                    })
                } else {
                    $("#alert").html("Please fill all the required details !!");
                }
            })
        });
    </script>
<?php
}
?>

    </html>