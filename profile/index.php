<?php
include("../include/header.php");
$data=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `admin` WHERE `admin_id`=".$_SESSION['admin_id'].""));
?>
<!-- Main Content -->
<div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"></span></span>My Profile</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <form action="updateprofile.php" method="post">
                                        <div class="form-group">
                                            <label for="email">Full Name</label>
                                            <input class="form-control" name="full_name" placeholder="Enter full name" type="text" value="<?php if(isset($data)){echo $data['full_name'];} ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Phone</label>
                                            <input class="form-control" name="phone" placeholder="Enter phone number" type="text" value="<?php if(isset($data)){echo $data['phone'];} ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input class="form-control" name="email" value="<?php if(isset($data)){echo $data['email'];} ?>" placeholder="Enter email" type="email">
                                        </div>

                                        
                                        <hr>
                                        
                                        <button class="btn btn-primary" name="update-profile" type="submit">Update profile</button>
                                    </form>
                                </div>
                            </div>
                        </section>
                        <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"></span></span>Change Password</h4>
                        </div>
                        <section class="hk-sec-wrapper">

                            <div class="row">
                                <div class="col-sm">
                                    <form action="changepassword.php" method="post">
                                        <div class="form-group">
                                            <label for="email">Old Password</label>
                                            <input class="form-control" name="old_password" placeholder="Enter old password" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">New Password</label>
                                            <input class="form-control" name="new_password" placeholder="Enter new password" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Confirm Password</label>
                                            <input class="form-control" name="confirm_password" placeholder="Enter confirm password" type="email">
                                        </div>

                                        
                                        <hr>
                                        
                                        <button class="btn btn-primary" name="change-password" type="submit">Update profile</button>
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
<?php
include("../include/footer.php")
?>
<?php
if(isset($_SESSION['update'])){
    if($_SESSION['update']=="1"){
?>
<script>
        $(document).ready(function(){
                toastr.success("Profile updated successfully")
            })
    </script>
<?php

} else{?>
<script>
        $(document).ready(function(){
                toastr.error("Email or phone already exists")
            })
    </script>
<?php
}
}
unset($_SESSION['update']);
?>

<?php
if(isset($_SESSION['password]'])){
    if($_SESSION['password']=="1"){
?>
<script>
        $(document).ready(function(){
                toastr.success("Password updated successfully")
            })
    </script>
<?php

} else{?>
<script>
        $(document).ready(function(){
                toastr.error("Incorrect Old Password")
            })
    </script>
<?php
}
}
unset($_SESSION['password']);
?>