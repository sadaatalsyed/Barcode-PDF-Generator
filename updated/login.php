<?php
include_once('config.php');

$conn=mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);

 if ( !$conn ) {
    echo mysqli_error( $connection );
    throw new Exception( "Database cannot Connect" );
}
else{
  // echo "Connection successful";
}

session_start();
$sessionId = $_SESSION['id'] ?? '';
    if ( $sessionId) {
        header( "location:index.php" );
        die();
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Title Page-->
    <title>Sign Up</title>



    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Login</h2>
                    <form action="login_core.php" method="POST">
                       
					<!-- <?php//header( "location:login.php?error" );?> -->
                        <p><?php echo $_SESSION['error'];?></p>
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Username" name="user">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="password" placeholder="Password" name="password">
                        </div>

                        <input type="hidden" name="action" value="login">
                        <div class="p-t-10">
                            <button class="btn btn--pill btn--green" name="submit" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
</body>

</html>
