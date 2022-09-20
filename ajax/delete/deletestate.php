<?php
include("../../include/config.php");
$q = mysqli_query($conn,"UPDATE `state` SET `delete`=1 WHERE `state_id`=".$_POST['id']);
$_SESSION['delete']="1";
if($q){
    echo "Deleted successfully";
}else{
    echo "Something went wrong";
}
?>