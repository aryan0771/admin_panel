<?php
include("../include/header.php");
?>
<?php
if(isset($_GET['edit'])){
    $data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM admin"));
    $full_name = $data['full_name'];
    $phone = $data['phone'];
    $email = $data['email'];
    $password = $data['password'];
    $confirm_password = $data['password'];
    $role_id = $data['role_id'];
    $status = $data['status'];
}

if(isset($_POST['create-admin']))
{
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role_id = $_POST['role_id'];
    $status = $_POST['status'];
    if(isset($_GET['edit']))
    {
        //All part for edit
        $checkadmin = mysqli_fetch_assoc(mysqli_query($conn,"SELECT admin_id FROM admin WHERE (email='".$email."' OR phone='".$phone."') AND admin_id!=".$_GET['edit'].""));
        
        if(count($checkadmin)==0){
            //Check password changed or not
            if(strlen($password)=="32"){
                //Edit query
                $addadmin = mysqli_query($conn,"UPDATE admin SET full_name='".$full_name."',phone='".$phone."',email='".$email."',role_id='".$role_id."',status='".$status."' WHERE `admin_id`=".$_GET['edit']."");
            
            }else{
                //Edit query
                $addadmin = mysqli_query($conn,"UPDATE admin SET full_name='".$full_name."',phone='".$phone."',email='".$email."',password='".md5($password)."',role_id='".$role_id."',status='".$status."' WHERE `admin_id`=".$_GET['edit']."");
            
            }
            
            
            ?>
            <script>
                $(document).ready(function(){
                    toastr.success("Admin updated successfully");
                })
            </script>
            <?php
        }else{
            //Duplicate entry for email or phone
            ?>
            <script>
                $(document).ready(function(){
                    toastr.error("Email or phone already exists");
                })
            </script>
            <?php

        }
    }
    else
    {
        //All part works for add
        $checkadmin = mysqli_fetch_assoc(mysqli_query($conn,"SELECT admin_id FROM admin WHERE email='".$email."' OR phone='".$phone."'"));
        
            if(count($checkadmin)==0){

                //add query
                $addadmin = mysqli_query($conn,"INSERT INTO admin SET full_name='".$full_name."',phone='".$phone."',email='".$email."',password='".md5($password)."',role_id='".$role_id."',status='".$status."'");
                
                $full_name = "";
                $phone = "";
                $email = "";
                $password = "";
                $confirm_password = "";
                $role_id = "";
                $status = "";
                ?>
                <script>
                    $(document).ready(function(){
                        toastr.success("Admin created successfully")
                    })
                </script>
                <?php
            }else{
                //Duplicate entry for email or phone
                ?>
                <script>
                    $(document).ready(function(){
                        toastr.error("Admin already exists")
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
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php if(isset($_GET['edit'])){echo "Edit";}else{echo "Add";} ?> admin</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"></span></span><?php if(isset($_GET['edit'])){echo "Edit";}else{echo "Add";} ?> Admin</h4>
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
                                            <label for="email">Full Name</label>
                                            <input class="form-control" name="full_name" placeholder="Enter full name" type="text" value="<?php if(isset($full_name)){echo $full_name;} ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Phone</label>
                                            <input class="form-control" name="phone" placeholder="Enter phone number" type="text" value="<?php if(isset($phone)){echo $phone;} ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input class="form-control" name="email" value="<?php if(isset($email)){echo $email;} ?>" placeholder="Enter email" type="email">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Password</label>
                                            <input class="form-control" name="password" value="<?php if(isset($password)){echo $password;} ?>" placeholder="Enter password" type="password">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Confirm password</label>
                                            <input class="form-control" name="confirm_password" value="<?php if(isset($confirm_password)){echo $confirm_password;} ?>" placeholder="Enter confirm password" type="password">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5 mb-10">
                                                <label for="country">Role</label>
                                                <select class="form-control custom-select d-block w-100" name="role_id" value="<?php if(isset($role_id)){echo $role_id;} ?>">
                                                    <option value="0">Admin</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-10">
                                                <label for="state">Status</label>
                                                <select class="form-control custom-select d-block w-100" name="status" value="<?php if(isset($status)){echo $status;} ?>">
                                                    <option value="unblock" <?php if(isset($status)){ if($status=="unblock"){ echo "selected";}} ?>>Unblock</option>
                                                    <option value="block" <?php if(isset($status)){ if($status=="block"){ echo "selected";}} ?>>Block</option>
                                                </select>
                                            </div>
                                            <!-- <div class="col-md-3 mb-10">
                                                <label for="zip">Zip</label>
                                                <input class="form-control" id="zip" placeholder="" type="text">
                                            </div> -->
                                        </div>
                                        <hr>
                                        
                                        <button class="btn btn-primary" name="create-admin" type="submit"><?php if(isset($_GET['edit'])){echo "Save changes";}else{echo "Create";} ?></button>
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

