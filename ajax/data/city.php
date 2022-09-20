<?php
include("../../include/config.php");
$query = "";
if(isset($_POST['id'])){
    $query = "state_id='".$_POST['id']."' AND";
}
$data = mysqli_query($conn,"SELECT * FROM `city` WHERE ".$query." `delete`=0");
while($row=mysqli_fetch_array($data)){
?>
<option value="<?php echo $row['city_id'] ?>"><?php echo $row['city_name'] ?></option>
<?php
}
?>