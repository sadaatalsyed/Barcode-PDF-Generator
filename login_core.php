<?php

session_start();
include_once('config.php');

$conn=mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);

 if ( !$conn ) 
 {
    echo mysqli_error( $connection );
    throw new Exception( "Database cannot Connect" );
}
else
{
        $action = $_REQUEST['action'] ?? '';

        if ( 'login' == $action ) {
            $password = $_REQUEST['password'] ?? '';
            $username = $_REQUEST['username'] ?? '';
            $name = $_REQUEST['name'] ?? '';

            if ( $username && $password) 
            {
                    echo $username;    
                $query = "SELECT * FROM users WHERE user_name='{$username}'";
                $result = mysqli_query( $conn, $query );
                 
                if($data = mysqli_fetch_assoc( $result ))
                {    
                    echo "in";
                    if (count($data)>0) 
                    { 
                        echo "YESSSSSSSSSSSSSSSS+EEEEE";
                        $_passsword = $data['password'] ?? '';
                        echo $_passsword;
                        $_email = $data['email'] ?? '';
                        $_id = $data['id'] ?? '';
                        $_username = $data['username'] ?? '';
                     
                        echo $password."-------".$_passsword;

                        // if ( password_verify( $password, $_passsword ) )
                        if ($password==$_passsword )
                        {
                            $_SESSION['id'] = $_id;
                            echo "Session ID:".$_SESSION['id'];
                           echo "verify password";
                           header( "location:index.php" );
                            die();
                        }
                        else{
                           echo "not verify password";

                            $error="Your Password is not correct";
                           // header('location:login.php?error='.$error);
                            die();
                        }
                    }
                  

               } 
               else
               {
                   echo "this line";
                $error="This user_name does not exist";
               header('location:login.php?error='.$error);
                die();
               }
           }
           else{
            $error="Your email or Password is not correct.Please fill all the fields.";
            header('location:login.php?error='.$error);
             die();
           }

     }
}


?>