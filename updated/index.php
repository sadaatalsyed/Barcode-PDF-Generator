<?php

session_start();
include_once('config.php');

$conn=mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);

 if ( !$conn ) {
    echo mysqli_error( $connection );
    throw new Exception( "Database cannot Connect" );
}

$sessionId = $_SESSION['id'] ?? '';

    if ( $sessionId) {
       // echo "$sessionId";
        
    }
    else{
        $_SESSION['error']="Email or password is not correct";
         header('location:login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet" media="all">
    <link href="css/style.css" rel="stylesheet" media="all">
    <title>Identcode</title>

</head>
</head>
<body>
<?php
  
 

?>
           
               <div class="container">
                    <h2 class="title"></h2>
                    <form action="barcode.php" method="POST">
                    <div class="input-group">
                        <!-- <select name="identcode" id="identcode" value="" placeholder="Select an identcode">
                        
               <?php
                    //     // $query="select * from parts";
                    //     $result=mysqli_query($conn,$query);
                    //     $parts=mysqli_fetch_assoc($result);
                    //     if(count($result)>0){
                    //     foreach($result as $part)
                    // {?>
                    //    <option name="ident"><?php //echo $part['identcode'];?></option>

             <?php //} } ?>

                        </select>      
                      </div>   -->
                      <div class="input-group">
                      <input type="text" autocomplete="on" name="identcode">
                      </div>
                        <div class="p-t-10">
                            <button class="btn btn--pill btn--green" name="OK" type="submit">OK</button>
                        </div>
                    </form>
                </div>

           
    <script src="vendor/jquery/jquery.min.js"></script>
</body>
</html>



