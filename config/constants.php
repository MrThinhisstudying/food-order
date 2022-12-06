<?php
    //Start Session
    session_start();


 //Execute Querry and Save Data in Database
 //Create Constants to Store Non Repeating Values
define('SITEURL','http://localhost/food-order/');
 define('LOCALHOST','localhost');
define('DB_USERBANE', 'root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');
 $conn = mysqli_connect(LOCALHOST, DB_USERBANE, DB_PASSWORD) or die(mysqli_error()); //Database Connection
 $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); //Selecting Database


 //  $hs ="localhost";
//  $us ="root";
//  $ps = "";
//  $dbs ="order-food";

//  $db = new mysqli($hs, $us, $ps, $dbs);
?>