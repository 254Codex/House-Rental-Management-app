<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
ob_start();
if(!isset($_SESSION['system'])){
    $system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
    foreach($system as $k => $v){
        $_SESSION['system'][$k] = $v;
    }
}
ob_end_flush();
?>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Lipa Nyumba App</title>
    
    <?php include('./header.php'); ?>
    <?php 
    if(isset($_SESSION['login_id']))
        header("location:index.php?page=home");
    ?>
    
    <style>
        body {
            margin: 0;
            height: 100vh; /* Full height of the viewport */
            display: flex; /* Use flexbox for layout */
        }
        main#main {
            display: flex; /* Use flexbox for main layout */
            width: 100%;
            height: 100%;
        }
        #login-left {
            flex: 1; /* Take up remaining space */
            background: #59b6ec61; /* Background color */
            display: flex;
            flex-direction: column; /* Stack images vertically */
            justify-content: center; /* Center images vertically */
            align-items: center; /* Center images horizontally */
        }
        #login-left img {
            width: 100%; /* Full width */
            height: auto; /* Maintain aspect ratio */
            margin-bottom: 10px; /* Space between images */
        }
        #login-right {
            flex: 0 0 40%; /* Fixed width of 40% */
            background: url('images/mansion.jpg') no-repeat center center;
            background-size: cover; /* Cover the entire div */
            display: flex;
            align-items: center;
            justify-content: center; /* Center the content vertically */
            z-index: 1; /* Ensure it is above other elements */
        }
        #login-right .card {
            margin: auto;
            z-index: 1;
        }
    </style>
</head>

<body>
    <main id="main" class="bg-light">
        <div id="login-left">
            <img src="images/scraper.jpg" alt="Image 1">
            <img src="images/image3.jpg" alt="Image 3">
        </div>

        <div id="login-right">
            <div class="w-100">
                <h4 class="text-white text-center"><b><?php echo $_SESSION['system']['name'] ?></b></h4>
                <br>
                <br>
                <div class="card col-md-8">
                    <div class="card-body">
                        <form id="login-form">
                            <div class="form-group">
                                <label for="username" class="control-label">Username</label>
                                <input type="text" id="username" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <script>
        $('#login-form').submit(function(e) {
            e.preventDefault();
            $('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
            if ($(this).find('.alert-danger').length > 0)
                $(this).find('.alert-danger').remove();
            $.ajax({
                url: 'ajax.php?action=login',
                method: 'POST',
                data: $(this).serialize(),
                error: err => {
                    console.log(err);
                    $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
                },
                success: function(resp) {
                    if (resp == 1) {
                        location.href = 'index.php?page=home';
                    } else {
                        $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>');
                        $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
                    }
                }
            });
        });
    </script>
</body>
</html>