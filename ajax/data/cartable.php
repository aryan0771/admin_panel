<?php
include("../../include/config.php");
$data = mysqli_query($conn,"SELECT * FROM `car` WHERE `delete`=0");
while($row=mysqli_fetch_array($data)){
?>
<tr>
    <td><?php echo $row['car_id'] ?></td>
    <td>
        <a class="btn btn-primary" href="../add-car?edit=<?php echo $row['car_id']; ?>">Edit</a>
        <button class="btn btn-danger" onclick="deletecar(<?php echo $row['car_id']; ?>)">Delete</button>
    </td>
    <td><?php echo $row['car_name']."</br>".$row['number_plate'] ?></td>
    <td><?php echo $row['fuel_type']."(".$row['model_year'].")" ?></td>
    <td> <img src="../../images/car_image/<?php echo $row['car_image'] ?>" alt="" srcset="" height="100" width="100"></td>
    <td><?php echo $row['status'] ?></td>
    <td><?php echo $row['deposit'] ?></td>
</tr>
<?php
}
?>