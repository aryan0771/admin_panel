<?php
include("../include/config.php");
$check = mysqli_fetch_array(mysqli_query($conn,"SELECT admin_id FROM admin WHERE (email='".$_POST['email']."' OR phone='".$_POST['phone']."') AND admin_id='".$_SESSION['admin_id']."'"));

if(count($check)==0){
    $update = mysqli_query($conn,"UPDATE admin SET `full_name`='".$_POST['full_name']."',email='".$_POST['email']."',`phone`='".$_POST['phone']."' WHERE admin_id=".$_SESSION['admin_id']."");
    if($update){
    $_SESSION['update']="1";
    }
}else{
    $_SESSION['update']="2";
}

header("location:../profile")
?>