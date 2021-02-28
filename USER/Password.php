<?php
session_start();
if (isset($_SESSION['user']['email']) && ($_SESSION['user']['password'])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
        <link rel="stylesheet" href="../Index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <title>Update Profile</title>
    </head>

    <body>
        <?php
        include_once('HeaderU.php');
        ?>
        <div id="FormMain">
            <h3 style="color: #DCB11F;">Update Profile</h3><br><br>
            <label style="color: #DCB11F;">Current Password</label>
            <p style="color:red;" id="alert"></p>
            <p style="color:green;" id="alert1"></p>
            <div class="form-group pass_show">
                <input type="password" id="CPassword" class="form-control" placeholder="Current Password">
            </div>
            <label style="color: #DCB11F;">New Password</label>
            <div class="form-group pass_show">
                <input type="password" id="NPassword" class="form-control" placeholder="New Password">
            </div>
            <label style="color: #DCB11F;">New Name</label>
            <div class="form-group pass_show">
                <input type="text" id="NName" class="form-control" placeholder="New name">
            </div>
            <label style="color: #DCB11F;">New Email</label>
            <div class="form-group pass_show">
                <input type="number" id="NEmail" class="form-control" placeholder="New Mobile number">
            </div>
            <button style="background-color: #DCB11F;border:none;" id="btn" class="btn btn-primary">update profile</button>
        </div>
        <?php
        include_once('Footer.php');
        ?>
    </body>
    <script>
        $(document).ready(function() {
            $("#CPassword").on("change", function() {
                $("#NPassword").prop("disabled", true);
                $("#NName").prop("disabled", true);
                $("#NEmail").prop("disabled", true);
                var CPassword = $("#CPassword").val();
                $.ajax({
                    url: "../Helper.php",
                    type: "POST",
                    data: {
                        CPassword: CPassword,
                        action: 'CPassword'
                    },
                    success: function(data) {
                        if (data == 1) {
                            $("#alert").html("");
                            $("#alert1").html("Password Matched !");
                            $("#NPassword").prop("disabled", false);
                            $("#NName").prop("disabled", false);
                            $("#NEmail").prop("disabled", false);
                        } else if (data == 0) {
                            $("#alert1").html("");
                            $("#alert").html("Wrong password entered !!");
                        }

                    }

                })
            })
        });

        $(document).ready(function() {
            $("#btn").click(function() {
                var password = $("#NPassword").val();
                var name =  $("#NName").val();
                var number =  $("#NEmail").val();
                $.ajax({
                    url:'../Helper.php',
                    type:'POST',
                    data:{
                        password:password,
                        name:name,
                        number:number,
                        action:'update'
                    },
                    success:function(data){
                        if(data == 1){
                            alert('Successfully updated !!');
                            location.replace('Index.php');
                        }
                        else{
                            $("#alert1").html('');
                            $("#alert").html('Please try again !!');
                        }
                    }

                })


            })
        })
    </script>

    </html>

<?php

} else {
    echo "Session expired ;(  !!";
?>
    <button style="background-color: #DCB11F;border:none;" class="btn btn-primary"> <a href="../Login.php">LOGIN AGAIN</a></button>
<?php

}
?>