<?php
include("../include/header.php");
?>
<?php
if(isset($_GET['edit'])){
    $data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM country WHERE country_id='".$_GET['edit']."'"));
    $country_name = $data['country_name'];
    $status = $data['status'];
}

if(isset($_POST['create-country']))
{
    $country_name = $_POST['country_name'];
    $status = $_POST['status'];
    if(isset($_GET['edit']))
    {
        //All part for edit
        $checkrepeat = mysqli_fetch_assoc(mysqli_query($conn,"SELECT country_id FROM country WHERE country_name='".$country_name."' AND country_id!=".$_GET['edit'].""));
        
        if(count($checkrepeat)==0){
                
                //Edit query
                $update = mysqli_query($conn,"UPDATE country SET country_name='".$country_name."',status='".$status."' WHERE `country_id`=".$_GET['edit']."");
            
            
            ?>
            <script>
                $(document).ready(function(){
                    toastr.success("Country updated successfully");
                })
            </script>
            <?php
        }else{
            //Duplicate entry for email or phone
            ?>
            <script>
                $(document).ready(function(){
                    toastr.error("Country already exists");
                })
            </script>
            <?php

        }
    }
    else
    {
        //All part works for add
        $checkrepeat = mysqli_fetch_assoc(mysqli_query($conn,"SELECT country_id FROM country WHERE country_name='".$country_name."'"));
        
            if(count($checkrepeat)==0){

                //add query
                $addcountry = mysqli_query($conn,"INSERT INTO country SET country_name='".$country_name."',status='".$status."'");
                
                $country_name = "";
                $status = "";
                ?>
                <script>
                    $(document).ready(function(){
                        toastr.success("country created successfully")
                    })
                </script>
                <?php
            }else{
                //Duplicate entry for email or phone
                ?>
                <script>
                    $(document).ready(function(){
                        toastr.error("country already exists")
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
                    <li class="breadcrumb-item"><a href="#">country</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php if(isset($_GET['edit'])){echo "Edit";}else{echo "Add";} ?> Country</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"></span></span><?php if(isset($_GET['edit'])){echo "Edit";}else{echo "Add";} ?> Country</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <form action="" method="post" id="add-country-validation">
                                        <div class="form-group">
                                            <label for="country name">Country Name</label>
                                            <input class="form-control" name="country_name" placeholder="Enter country name" type="text" value="<?php if(isset($country_name)){echo $country_name;} ?>">
                                        </div>
                                            <div class="col-md-4 mb-10" id="status-validation">
                                                <label for="state">Status</label>
                                                <select class="form-control custom-select d-block w-100" name="status" value="<?php if(isset($status)){echo $status;} ?>">
                                                    <option value="enabled" <?php if(isset($status)){ if($status=="unblock"){ echo "selected";}} ?>>Enabled</option>
                                                    <option value="disabled" <?php if(isset($status)){ if($status=="block"){ echo "selected";}} ?>>Disabled</option>
                                                </select>
                                            </div>
                                            <div>

                                            </div>
                                        
                                        <hr>
                                        
                                        <button class="btn btn-primary" name="create-country" type="submit"><?php if(isset($_GET['edit'])){echo "Save changes";}else{echo "Create";} ?></button>
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
        $("#add-country-validation").validate({
            rules:{
                country_name:{
                    required:true,
                    String:true
                },
                status:{
                    required:true
                }
            },
            messages:{
                country_name:{
                    required:"Country name is required"
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

