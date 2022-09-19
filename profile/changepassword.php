<?php
include("../include/config.php");
$check = mysqli_fetch_array(mysqli_query($conn,"SELECT admin_id FROM admin WHERE password='".md5($_POST['password'])."' AND admin_id=".$_SESSION['admin_id'].""));
if(count($check)==0){
    $update = mysqli_query($conn,"UPDATE admin SET `password`='".md5($_POST['password'])."' WHERE admin_id=".$_SESSION['admin_id']."");
    if($update){
    //Password updated
    $_SESSION['password']="1";
    }
}else{
    //incorrect password
    $_SESSION['password']="2";
}



header("location:../profile")
?>