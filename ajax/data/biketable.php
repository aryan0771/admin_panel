<?php
include("../../include/config.php");
$data = mysqli_query($conn,"SELECT * FROM `bike` WHERE `delete`=0");
while($row=mysqli_fetch_array($data)){
?>
<tr>
    <td><?php echo $row['bike_id'] ?></td>
    <td>
        <a class="btn btn-primary" href="../add-bike?edit=<?php echo $row['bike_id']; ?>">Edit</a>
        <button class="btn btn-danger" onclick="deletebike(<?php echo $row['bike_id']; ?>)">Delete</button>
    </td>
    <td><?php echo $row['bike_name']."</br>".$row['number_plate'] ?></td>
    <td><?php echo $row['fuel_type']."(".$row['model_year'].")" ?></td>
    <td> <img src="../../images/bike_image/<?php echo $row['bike_image'] ?>" alt="" srcset="" height="100" width="100"></td>
    <td><?php echo $row['status'] ?></td>
    <td><?php echo $row['deposit'] ?></td>
</tr>
<?php
}
?>