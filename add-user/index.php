<?php
include("../include/header.php");
?>
<?php
if(isset($_GET['edit'])){
    $data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM user"));
    $full_name = $data['full_name'];
    $phone = $data['phone'];
    $email = $data['email'];
    $password = $data['password'];
    $date_of_birth = $data['date_of_birth'];
    $confirm_password = $data['password'];   
    $status = $data['status'];
    $country_id = $data['country_id'];
    $state_id = $data['state_id'];
    $city_id = $data['city_id'];
}

if(isset($_POST['create-user']))
{
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $date_of_birth = $_POST['date_of_birth'];
    $status = $_POST['status'];
    $country_id = $_POST['country_id'];
    $state_id = $_POST['state_id'];
    $city_id = $_POST['city_id'];
    if(isset($_GET['edit']))
    {
        //All part for edit
        $checkuser = mysqli_fetch_assoc(mysqli_query($conn,"SELECT user_id FROM user WHERE (email='".$email."' OR phone='".$phone."') AND user_id!=".$_GET['edit'].""));
        
        if(count($checkuser)==0){
            //Check password changed or not
            if(strlen($password)=="32"){
                //Edit query
                $adduser = mysqli_query($conn,"UPDATE user SET full_name='".$full_name."',phone='".$phone."',email='".$email."',status='".$status."',country_id='".$country_id."',city_id='".$city_id."',state_id='".$state_id."',date_of_birth='".$date_of_birth."' WHERE `user_id`=".$_GET['edit']."");
            
            }else{
                //Edit query
                $adduser = mysqli_query($conn,"UPDATE user SET full_name='".$full_name."',phone='".$phone."',email='".$email."',password='".md5($password)."',status='".$status."',country_id='".$country_id."',city_id='".$city_id."',state_id='".$state_id."',date_of_birth='".$date_of_birth."' WHERE `user_id`=".$_GET['edit']."");
            
            }
            
            
            ?>
            <script>
                $(document).ready(function(){
                    toastr.success("User updated successfully");
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
        $checkuser = mysqli_fetch_assoc(mysqli_query($conn,"SELECT user_id FROM user WHERE email='".$email."' OR phone='".$phone."'"));
        
            if(count($checkuser)==0){

                //add query
                $adduser = mysqli_query($conn,"INSERT INTO user SET full_name='".$full_name."',phone='".$phone."',email='".$email."',password='".md5($password)."',status='".$status."',country_id='".$country_id."',city_id='".$city_id."',state_id='".$state_id."',date_of_birth='".$date_of_birth."'");
                
                $full_name = "";
                $phone = "";
                $email = "";
                $password = "";
                $confirm_password = "";
                $date_of_birth = "";
                $status = "";
                $country_id = "";
                $state_id = "";
                $city_id = "";
                ?>
                <script>
                    $(document).ready(function(){
                        toastr.success("user created successfully")
                    })
                </script>
                <?php
            }else{
                //Duplicate entry for email or phone
                ?>
                <script>
                    $(document).ready(function(){
                        toastr.error("user already exists")
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
                    <li class="breadcrumb-item"><a href="#">user</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php if(isset($_GET['edit'])){echo "Edit";}else{echo "Add";} ?> user</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"></span></span><?php if(isset($_GET['edit'])){echo "Edit";}else{echo "Add";} ?> user</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <form action="" method="post" id="add-user-validation">
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
                                            <input class="form-control" id="password" name="password" value="<?php if(isset($password)){echo $password;} ?>" placeholder="Enter password" type="password">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Confirm password</label>
                                            <input class="form-control" name="confirm_password" value="<?php if(isset($confirm_password)){echo $confirm_password;} ?>" placeholder="Enter confirm password" type="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="date_of_birth">Birth date</label>
                                            <input class="form-control" name="date_of_birth" value="<?php if(isset($date_of_birth)){echo $date_of_birth;} ?>" placeholder="Select date" type="date">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5 mb-10">
                                                <label for="country">Country</label>
                                                <select class="form-control custom-select d-block w-100" name="country_id" onchange="loadstate(this.value)" id="country_dropdown">
                                                    
                                                </select>
                                            </div>
                                            <div class="col-md-5 mb-10">
                                                <label for="country">State</label>
                                                <select class="form-control custom-select d-block w-100" name="state_id" onchange="loadcity(this.value)" id="state_dropdown">
                                                    
                                                </select>
                                            </div>
                                            <div class="col-md-5 mb-10">
                                                <label for="country">City</label>
                                                <select class="form-control custom-select d-block w-100" name="city_id" id="city_dropdown">
                                                    
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-10">
                                                <label for="state">Status</label>
                                                <select class="form-control custom-select d-block w-100" name="status" value="<?php if(isset($status)){echo $status;} ?>">
                                                    <option value="unblock" <?php if(isset($status)){ if($status=="unblock"){ echo "selected";}} ?>>Unblock</option>
                                                    <option value="block" <?php if(isset($status)){ if($status=="block"){ echo "selected";}} ?>>Block</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        
                                        <button class="btn btn-primary" name="create-user" type="submit"><?php if(isset($_GET['edit'])){echo "Save changes";}else{echo "Create";} ?></button>
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

<script>
    function loadcountry()
    {
        
        $.ajax({
        url: "../ajax/data/country.php",
        type: "POST",
        async: true,
        //data: {"id":id},
        success: function (data) {
            $('#country_dropdown').html(data)
            loadstate();
        },
        error: function(err){
            console.log("err: ",err);
        }
        });
    }
    function loadstate(id)
    {
        
        $.ajax({
        url: "../ajax/data/state.php",
        type: "POST",
        async: true,
        data: {"id":id},
        success: function (data) {
            $('#state_dropdown').html(data)
            loadcity();

        },
        error: function(err){
            console.log("err: ",err);
        }
        });
    }
    function loadcity(id)
    {
        
        $.ajax({
        url: "../ajax/data/city.php",
        type: "POST",
        async: true,
        data: {"id":id},
        success: function (data) {
            $('#city_dropdown').html(data)
        },
        error: function(err){
            console.log("err: ",err);
        }
        }); 
    }
    loadcountry();
    


</script>
<script>
    $(document).ready(function(){
        jQuery.validator.addMethod("laxEmail", function(value, element) {
            // allow any non-whitespace characters as the host part
            return this.optional( element ) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@(?:\S{1,63})$/.test( value );
            }, 'Please enter a valid email address.');
            jQuery.validator.addMethod("String", function(value, element) {
            // allow any non-whitespace characters as the host part
            return this.optional( element ) || /^[a-zA-Z ]+$/.test( value );
            }, 'Please enter valid details.');
            jQuery.validator.addMethod("Phone", function(value, element) {
            // allow any non-whitespace characters as the host part
            return this.optional( element ) || /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/.test( value );
            }, 'Please enter valid phone nummber.');
            jQuery.validator.addMethod("Validpassword", function(value, element) {
            // allow any non-whitespace characters as the host part
            return this.optional( element ) || /^[A-Za-z0-9\d=!\-@._*]+$/.test( value );
            }, 'Please enter valid password.');
            
        $("#add-user-validation").validate({
            rules:{
                full_name:{
                    required:true,
                    String:true,
                },
                phone:{
                    required:true,
                    Phone:true
                },
                email:{
                    required:true,
                    laxEmail:true
                },
                password:{
                    required:true,
                    Validpassword:true,
                    
                },
                confirm_password:{
                    equalTo : "#password"
                },
                status:{
                    required:true
                },
            },
            messages:{
                full_name:{
                    required:"Full name is required",
                },
                email:{
                    required:"Email is required"
                },
                phone:{
                    required:"Phone is required"
                },
                password:{
                    required:"Password is required",
                },
                confirm_password:{
                    equalTo : "Password dosen't match"
                },
                status:{
                    required:"Status is required"
                }
            },
            errorPlacement: function(error, element) {
            if(element.attr("name") == "status") {
                error.appendTo( element.parent("div").next("div") );
            } else {
                error.insertAfter(element);
            }
            }
        })
    })
</script>

