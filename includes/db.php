<?php
    /*change these parameters to constant, which is more secure than passing parameters into connect directly.
    * Because once you define a constant, the constant cannot be modified.
    * This way is to protect against you accidentally modifying any of the connection parameters, thereby causing 
    * failure to connect to DB.
    */
    $db['db_host'] = 'localhost';
    $db['db_user'] = 'root';
    $db['db_password'] ="";
    $db['db_name'] = "go_recipe";

    foreach($db as $key => $value){
        
        define(strtoupper($key), $value);// change key to uppercase
    }
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//    if($connection){
//        echo "We are connected!";
//    }
?>