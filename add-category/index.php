<?php
include("../include/header.php");
?>
<?php
if(isset($_GET['edit'])){
    $data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM category WHERE category_id='".$_GET['edit']."'"));
    $category_name = $data['category_name'];
    $status = $data['status'];
}

if(isset($_POST['create-category']))
{
    $category_name = $_POST['category_name'];
    $status = $_POST['status'];
    if(isset($_GET['edit']))
    {
        //All part for edit
        $checkrepeat = mysqli_fetch_assoc(mysqli_query($conn,"SELECT category_id FROM category WHERE category_name='".$category_name."' AND category_id!=".$_GET['edit'].""));
        
        if(count($checkrepeat)==0){
                
                //Edit query
                $update = mysqli_query($conn,"UPDATE category SET category_name='".$category_name."',status='".$status."' WHERE `category_id`=".$_GET['edit']."");
            
            
            ?>
            <script>
                $(document).ready(function(){
                    toastr.success("Category updated successfully");
                })
            </script>
            <?php
        }else{
            //Duplicate entry for email or phone
            ?>
            <script>
                $(document).ready(function(){
                    toastr.error("Category already exists");
                })
            </script>
            <?php

        }
    }
    else
    {
        //All part works for add
        $checkrepeat = mysqli_fetch_assoc(mysqli_query($conn,"SELECT category_id FROM category WHERE category_name='".$category_name."'"));
        
            if(count($checkrepeat)==0){

                //add query
                $addcategory = mysqli_query($conn,"INSERT INTO category SET category_name='".$category_name."',status='".$status."'");
                
                $category_name = "";
                $status = "";
                ?>
                <script>
                    $(document).ready(function(){
                        toastr.success("category created successfully")
                    })
                </script>
                <?php
            }else{
                //Duplicate entry for email or phone
                ?>
                <script>
                    $(document).ready(function(){
                        toastr.error("category already exists")
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
                    <li class="breadcrumb-item"><a href="#">Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php if(isset($_GET['edit'])){echo "Edit";}else{echo "Add";} ?> Category</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"></span></span><?php if(isset($_GET['edit'])){echo "Edit";}else{echo "Add";} ?> category</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <form action="" method="post" id="add-category-validation">
                                        <div class="form-group">
                                            <label for="category name">Category Name</label>
                                            <input class="form-control" name="category_name" placeholder="Enter category name" type="text" value="<?php if(isset($category_name)){echo $category_name;} ?>">
                                        </div>
                                            <div class="col-md-4 mb-10">
                                                <label for="state">Status</label>
                                                <select class="form-control custom-select d-block w-100" name="status" value="<?php if(isset($status)){echo $status;} ?>">
                                                    <option value="enabled" <?php if(isset($status)){ if($status=="unblock"){ echo "selected";}} ?>>Enabled</option>
                                                    <option value="disabled" <?php if(isset($status)){ if($status=="block"){ echo "selected";}} ?>>Disabled</option>
                                                </select>
                                            </div>
                                        
                                        <hr>
                                        
                                        <button class="btn btn-primary" name="create-category" type="submit"><?php if(isset($_GET['edit'])){echo "Save changes";}else{echo "Create";} ?></button>
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
    $("#add-category-validation").validate({
        rules:{
            category_name:{
                required:true,
                String:true
            },
            status:{
                required:true
            }
        },
        messages:{
            category_name:{
                required:"category name is required"
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
