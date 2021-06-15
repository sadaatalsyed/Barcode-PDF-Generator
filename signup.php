<?php
include_once('config.php');

$conn=mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);

 if ( !$conn ) {
    echo mysqli_error( $connection );
    throw new Exception( "Database cannot Connect" );
}
else{
    echo "Connection successful";
}
if(isset($_POST['submit'])){
   
    $name=$_POST['name'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    echo $name."--".$username."__".$email."__";
    $query="insert into users(name,user_name,email,password) values('$name','$username','$email','$password')";
    mysqli_query($conn,$query);

    header("location:login.php");
}

?>