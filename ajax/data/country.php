<?php
include("../../include/config.php");
$data = mysqli_query($conn,"SELECT * FROM `country` WHERE `delete`=0");
while($row=mysqli_fetch_array($data)){
?>
<option value="<?php echo $row['country_id'] ?>"><?php echo $row['country_name'] ?></option>
<?php
}
?>