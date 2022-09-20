<?php
include("../../include/config.php");
$q = mysqli_query($conn,"UPDATE `country` SET `delete`=1 WHERE `country_id`=".$_POST['id']);
$_SESSION['delete']="1";
if($q){
    echo "Deleted successfully";
}else{
    echo "Something went wrong";
}
?>