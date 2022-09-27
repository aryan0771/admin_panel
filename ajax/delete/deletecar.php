<?php
include("../../include/config.php");
$q = mysqli_query($conn,"UPDATE `car` SET `delete`=1 WHERE `car_id`=".$_POST['id']);
$_SESSION['delete']="1";
if($q){
    echo "Deleted successfully";
}else{
    echo "Something went wrong";
}
?>