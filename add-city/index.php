<?php
include("../include/header.php");
?>
<?php
if(isset($_GET['edit'])){
    $data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM city WHERE city_id='".$_GET['edit']."'"));
    $city_name = $data['city_name'];
    $state_id = $data['state_id'];
    $status = $data['status'];
}

if(isset($_POST['create-city']))
{
    $city_name = $_POST['city_name'];
    $state_id = $_POST['state_id'];
    $status = $_POST['status'];
    if(isset($_GET['edit']))
    {
        //All part for edit
        $checkrepeat = mysqli_fetch_assoc(mysqli_query($conn,"SELECT city_id FROM city WHERE city_name='".$city_name."' AND city_id!=".$_GET['edit'].""));
        
        if(count($checkrepeat)==0){
                
                //Edit query
                $update = mysqli_query($conn,"UPDATE city SET city_name='".$city_name."',status='".$status."',state_id='".$state_id."' WHERE `city_id`=".$_GET['edit']."");
            
            
            ?>
            <script>
                $(document).ready(function(){
                    toastr.success("city updated successfully");
                })
            </script>
            <?php
        }else{
            //Duplicate entry for email or phone
            ?>
            <script>
                $(document).ready(function(){
                    toastr.error("city already exists");
                })
            </script>
            <?php

        }
    }
    else
    {
        //All part works for add
        $checkrepeat = mysqli_fetch_assoc(mysqli_query($conn,"SELECT city_id FROM city WHERE city_name='".$city_name."'"));
        
            if(count($checkrepeat)==0){

                //add query
                $addcity = mysqli_query($conn,"INSERT INTO city SET city_name='".$city_name."',state_id='".$state_id."',status='".$status."'");
                
                $city_name = "";
                $status = "";
                ?>
                <script>
                    $(document).ready(function(){
                        toastr.success("city created successfully")
                    })
                </script>
                <?php
            }else{
                //Duplicate entry for email or phone
                ?>
                <script>
                    $(document).ready(function(){
                        toastr.error("city already exists")
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
                    <li class="breadcrumb-item"><a href="#">City</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php if(isset($_GET['edit'])){echo "Edit";}else{echo "Add";} ?> City</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"></span></span><?php if(isset($_GET['edit'])){echo "Edit";}else{echo "Add";} ?> City</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <form action="" method="post" id="add-city-validation">
                                        <div class="form-group">
                                            <label for="city name">City Name</label>
                                            <input class="form-control" name="city_name" placeholder="Enter city name" type="text" value="<?php if(isset($city_name)){echo $city_name;} ?>">
                                        </div>
                                        <div class="form-group">
                                        <div class="col-md-4 mb-10">
                                                <label for="city">State</label>
                                                <select class="form-control custom-select d-block w-100" name="state_id" value="<?php if(isset($state_id)){echo $state_id;} ?>">

                                                <?php
                                                $data = mysqli_query($conn,"SELECT * FROM state WHERE `delete`=0");
                                                while($row=mysqli_fetch_array($data)){
                                                    ?>
                                                    <option value="<?php echo $row['state_id']; ?>" <?php if(isset($state_id)){ if($state_id==$row['state_id']){ echo "selected";}} ?>><?php echo $row['state_name']; ?></option>

                                                    <?php
                                                }
                                                ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                            <div class="col-md-4 mb-10">
                                                <label for="city">Status</label>
                                                <select class="form-control custom-select d-block w-100" name="status" value="<?php if(isset($status)){echo $status;} ?>">
                                                    <option value="enabled" <?php if(isset($status)){ if($status=="unblock"){ echo "selected";}} ?>>Enabled</option>
                                                    <option value="disabled" <?php if(isset($status)){ if($status=="block"){ echo "selected";}} ?>>Disabled</option>
                                                </select>
                                            </div>
                                        
                                        <hr>
                                        
                                        <button class="btn btn-primary" name="create-city" type="submit"><?php if(isset($_GET['edit'])){echo "Save changes";}else{echo "Create";} ?></button>
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
$(document).ready(function(){
    jQuery.validator.addMethod("String", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional( element ) || /^[a-zA-Z ]+$/.test( value );
        }, 'Please enter valid details.');
    $("#add-city-validation").validate({
        rules:{
            city_name:{
                required:true,
                String:true
            },
            state_id:{
                required:true
            },
            status:{
                required:true
            }
        },
        messages:{
            city_name:{
                required:"City name is required"
            },
            state_id:{
                required:"State is required"
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

