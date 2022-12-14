<?php
include("../include/header.php");
?>

 <!-- Main Content -->
 <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">role</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View-role</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">

                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"></span></span>View role</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                    <!-- <section class="hk-sec-wrapper"   style="display:none">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <table id="datable_3" class="table table-hover w-100 display">
                                        <thead>
                                                <tr>
                                                <th>ID</th>
                                                    <th>Action</th>
                                                    <th>Full Name</th>
                                                    <th>Email</th>
                                                    <th>Phone date</th>
                                                    <th>Created At</th>
                                                    <th>Updated At</th>
                                                </tr>
                                            </thead>
                                            <tbody id="roleexport">
                                            <?php
                                            while($row = mysqli_fetch_array($data)){
                                            ?>

                                            
                                                <tr>
                                                    <td><?php echo $row['role_id']; ?></td>
                                                    <td>Action</td>
                                                    <td><?php echo $row['role_name']; ?></td>
                                                    <td><?php echo $row['status']; ?></td>
                                                    <td><?php echo $row['created_at']; ?></td>
                                                    <td><?php echo $row['updated_at']; ?></td>
                                                </tr>
                                            
                                            <?php
                                            }
                                            ?>
                                            </tbody>   
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </section> -->
                    <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                        <thead>
                                                <tr>
                                                <th>ID</th>
                                                    <th>Action</th>
                                                    <th>Role Name</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                    <th>Updated At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                            <?php
                                            $data = mysqli_query($conn,"SELECT * FROM `role` WHERE `delete`=0");

                                            while($row = mysqli_fetch_array($data)){
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['role_id'] ?></td>
                                                    <td>
                                                        <a class="btn btn-primary" href="../add-role?edit=<?php echo $row['role_id']; ?>">Edit</a>
                                                        <button class="btn btn-danger" onclick="deleterole(<?php echo $row['role_id']; ?>)">Delete</button>
                                                    </td>
                                                    <td><?php echo $row['role_name'] ?></td>
                                                    <td><?php echo $row['status'] ?></td>
                                                    <td><?php echo $row['created_at'] ?></td>
                                                    <td><?php echo $row['updated_at'] ?></td>
                                                </tr>
                                            
                                            <?php
                                            }
                                            ?>
                                            </tbody>   
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Action</th>
                                                    <th>Role Name</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                    <th>Updated At</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                        
                        
                    </div>
                </div>
                <!-- /Row -->

            </div>
            <!-- /Container -->

        </div>
        <!-- /Main Content -->

<?php
include("../include/footer.php");
?>
<script>

    function deleterole(id){
        
        $.ajax({
        url: "../ajax/delete/deleterole.php",
        dataType: "text",
        type: "POST",
        async: true,
        data: {"id":id},
        success: function (data) {
            toastr.success(data)
            location.reload()
        },
        error: function(err){
            console.log("err: ",err);
        }
    }); 
    }
     
</script>
<?php
if($_SESSION['delete']=="1"){
    
    ?>

    <script>
        $(document).ready(function(){
                toastr.error("role deleted successfully")
            })
    </script>
    <?php
    unset($_SESSION['delete']);
} ?>