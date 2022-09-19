<?php
session_start();
 $hostName = "localhost";
 $userName = "root";
 $password = "";
 $dbName = "admin_panel";
 $conn= new mysqli($hostName,$userName,$password,$dbName);
 if($conn){
    //echo "connected";
 }else{
    //echo "not connected";
 }

  ?>