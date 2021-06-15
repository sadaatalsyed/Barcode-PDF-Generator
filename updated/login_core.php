<?php

session_start();
include_once('config.php');

$conn=mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);

 if ( !$conn ) {
    echo mysqli_error( $connection );
    throw new Exception( "Database cannot Connect" );
}
else{
    


$action = $_REQUEST['action'] ?? '';

if ( 'login' == $action ) {

   
    // $email = $_REQUEST['email'] ?? '';
    $password = $_REQUEST['password'] ?? '';
    $username = $_REQUEST['username'] ?? '';
    $name = $_REQUEST['name'] ?? '';

    if ( $email && $password) {
        $query = "SELECT * FROM users WHERE $username='{$username}'";
        $result = mysqli_query( $conn, $query );
        $data = mysqli_fetch_assoc( $result );
      
        if (count($data)>0) {

            $_passsword = $data['password'] ?? '';
            $_email = $data['email'] ?? '';
            $_id = $data['id'] ?? '';
            $_username = $data['username'] ?? '';

            $_SESSION['id'] = $_id;
         echo "Session ID:".$_SESSION['id'];
            header('location:index.php');
            die();

            // if ( password_verify( $password, $_passsword ) ) {

            //     $_SESSION['id'] = $_id;
            //     header( "location:index.php" );
            //     die();
            // }
        } else{
            $_SESSION['error']="You email or Password is not correct";
            header('location:login.php');
        }

    }
}
}


?>