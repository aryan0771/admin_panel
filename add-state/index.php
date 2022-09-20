<?php
include("../include/header.php");
?>
<?php
if(isset($_GET['edit'])){
    $data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM state WHERE state_id='".$_GET['edit']."'"));
    $state_name = $data['state_name'];
    $country_id = $data['country_id'];
    $status = $data['status'];
}

if(isset($_POST['create-state']))
{
    $state_name = $_POST['state_name'];
    $country_id = $_POST['country_id'];
    $status = $_POST['status'];
    if(isset($_GET['edit']))
    {
        //All part for edit
        $checkrepeat = mysqli_fetch_assoc(mysqli_query($conn,"SELECT state_id FROM state WHERE state_name='".$state_name."' AND state_id!=".$_GET['edit'].""));
        
        if(count($checkrepeat)==0){
                
                //Edit query
                $update = mysqli_query($conn,"UPDATE state SET state_name='".$state_name."',status='".$status."',country_id='".$country_id."' WHERE `state_id`=".$_GET['edit']."");
            
            
            ?>
            <script>
                $(document).ready(function(){
                    toastr.success("State updated successfully");
                })
            </script>
            <?php
        }else{
            //Duplicate entry for email or phone
            ?>
            <script>
                $(document).ready(function(){
                    toastr.error("State already exists");
                })
            </script>
            <?php

        }
    }
    else
    {
        //All part works for add
        $checkrepeat = mysqli_fetch_assoc(mysqli_query($conn,"SELECT state_id FROM state WHERE state_name='".$state_name."'"));
        
            if(count($checkrepeat)==0){

                //add query
                $addstate = mysqli_query($conn,"INSERT INTO state SET state_name='".$state_name."',country_id='".$country_id."',status='".$status."'");
                
                $state_name = "";
                $status = "";
                ?>
                <script>
                    $(document).ready(function(){
                        toastr.success("State created successfully")
                    })
                </script>
                <?php
            }else{
                //Duplicate entry for email or phone
                ?>
                <script>
                    $(document).ready(function(){
                        toastr.error("State already exists")
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
                    <li class="breadcrumb-item"><a href="#">state</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php if(isset($_GET['edit'])){echo "Edit";}else{echo "Add";} ?> state</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"></span></span><?php if(isset($_GET['edit'])){echo "Edit";}else{echo "Add";} ?> state</h4>
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
                                            <label for="state name">State Name</label>
                                            <input class="form-control" name="state_name" placeholder="Enter state name" type="text" value="<?php if(isset($state_name)){echo $state_name;} ?>">
                                        </div>
                                        <div class="form-group">
                                        <div class="col-md-4 mb-10">
                                                <label for="state">Country</label>
                                                <select class="form-control custom-select d-block w-100" name="country_id" value="<?php if(isset($country_id)){echo $country_id;} ?>">

                                                <?php
                                                $data = mysqli_query($conn,"SELECT * FROM country WHERE `delete`=0");
                                                while($row=mysqli_fetch_array($data)){
                                                    ?>
                                                    <option value="<?php echo $row['country_id']; ?>" <?php if(isset($country_id)){ if($country_id==$row['country_id']){ echo "selected";}} ?>><?php echo $row['country_name']; ?></option>

                                                    <?php
                                                }
                                                ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                            <div class="col-md-4 mb-10">
                                                <label for="state">Status</label>
                                                <select class="form-control custom-select d-block w-100" name="status" value="<?php if(isset($status)){echo $status;} ?>">
                                                    <option value="enabled" <?php if(isset($status)){ if($status=="unblock"){ echo "selected";}} ?>>Enabled</option>
                                                    <option value="disabled" <?php if(isset($status)){ if($status=="block"){ echo "selected";}} ?>>Disabled</option>
                                                </select>
                                            </div>
                                        
                                        <hr>
                                        
                                        <button class="btn btn-primary" name="create-state" type="submit"><?php if(isset($_GET['edit'])){echo "Save changes";}else{echo "Create";} ?></button>
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

