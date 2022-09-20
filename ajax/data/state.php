<?php
include("../../include/config.php");
$query = "";
if(isset($_POST['id'])){
    $query = "country_id='".$_POST['id']."' AND";
}
$data = mysqli_query($conn,"SELECT * FROM `state` WHERE ".$query." `delete`=0");
while($row=mysqli_fetch_array($data)){
?>
<option value="<?php echo $row['state_id'] ?>"><?php echo $row['state_name'] ?></option>
<?php
}
?>