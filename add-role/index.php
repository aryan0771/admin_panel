<?php
include("../include/header.php");
?>
<?php
if(isset($_GET['edit'])){
    $data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM role"));
    $role_name = $data['role_name'];
    $status = $data['status'];
}

if(isset($_POST['create-role']))
{
    $role_name = $_POST['role_name'];
    $status = $_POST['status'];
    if(isset($_GET['edit']))
    {
        //All part for edit
        $checkrepeat = mysqli_fetch_assoc(mysqli_query($conn,"SELECT role_id FROM role WHERE role_name='".$role_name."' AND role_id!=".$_GET['edit'].""));
        
        if(count($checkrepeat)==0){
                
                //Edit query
                $update = mysqli_query($conn,"UPDATE role SET role_name='".$role_name."',status='".$status."' WHERE `role_id`=".$_GET['edit']."");
            
            
            ?>
            <script>
                $(document).ready(function(){
                    toastr.success("Role updated successfully");
                })
            </script>
            <?php
        }else{
            //Duplicate entry for email or phone
            ?>
            <script>
                $(document).ready(function(){
                    toastr.error("Role already exists");
                })
            </script>
            <?php

        }
    }
    else
    {
        //All part works for add
        $checkrepeat = mysqli_fetch_assoc(mysqli_query($conn,"SELECT role_id FROM role WHERE role_name='".$role_name."'"));
        
            if(count($checkrepeat)==0){

                //add query
                $addrole = mysqli_query($conn,"INSERT INTO role SET role_name='".$role_name."',status='".$status."'");
                
                $role_name = "";
                $status = "";
                ?>
                <script>
                    $(document).ready(function(){
                        toastr.success("Role created successfully")
                    })
                </script>
                <?php
            }else{
                //Duplicate entry for email or phone
                ?>
                <script>
                    $(document).ready(function(){
                        toastr.error("Role already exists")
                    })
                </script>
                <?php

            }
        
    }
}
    

?>
<!-- Main Content -->
<div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Role</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php if(isset($_GET['edit'])){echo "Edit";}else{echo "Add";} ?> role</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"></span></span><?php if(isset($_GET['edit'])){echo "Edit";}else{echo "Add";} ?> Role</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="role name">Role Name</label>
                                            <input class="form-control" name="role_name" placeholder="Enter role name" type="text" value="<?php if(isset($role_name)){echo $role_name;} ?>">
                                        </div>
                                            <div class="col-md-4 mb-10">
                                                <label for="state">Status</label>
                                                <select class="form-control custom-select d-block w-100" name="status" value="<?php if(isset($status)){echo $status;} ?>">
                                                    <option value="enabled" <?php if(isset($status)){ if($status=="unblock"){ echo "selected";}} ?>>Enabled</option>
                                                    <option value="disabled" <?php if(isset($status)){ if($status=="block"){ echo "selected";}} ?>>Disabled</option>
                                                </select>
                                            </div>
                                        
                                        <hr>
                                        
                                        <button class="btn btn-primary" name="create-role" type="submit"><?php if(isset($_GET['edit'])){echo "Save changes";}else{echo "Create";} ?></button>
                                    </form>
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
<?php include("../include/footer.php") ?>

