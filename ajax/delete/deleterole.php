<?php
include("../../include/config.php");
$q = mysqli_query($conn,"UPDATE `role` SET `delete`=1 WHERE `role_id`=".$_POST['id']);
$_SESSION['delete']="1";
if($q){
    echo "Deleted successfully";
}else{
    echo "Something went wrong";
}
?>
                                        