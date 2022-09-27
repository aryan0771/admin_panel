<?php
include("../include/header.php");
?>
<?php
function uploadImage($image){
    $filename = strtotime("now").$image['name'];

    $destination = '../../images/car_image/' . $filename;

    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    $file = $image['tmp_name'];
    $size = $image['size'];

    if (!in_array($extension, ['jpg', 'png', 'jpeg'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($image['size'] > 1000000) {
        echo "File too large!";
    } else {
        move_uploaded_file($file, $destination);
        return $filename;
            
    }
}
if(isset($_GET['edit'])){
    $data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM car WHERE car_id='".$_GET['edit']."'"));
    $car_name = $data['car_name'];
    $color = $data['color'];
    $number_plate = $data['number_plate'];
    $city_id = $data['city_id'];
    $model_year = $data['model_year'];
    $km_driven = $data['km_driven'];
    $deposit = $data['deposit'];
    $fuel_type = $data['fuel_type'];
    $baggage_capacity = $data['baggage_capacity'];
    $seating_capacity = $data['seating_capacity'];
    $range = $data['range'];
    $engine_size = $data['engine_size'];
    $driving_type = $data['driving_type'];
    $car_description = $data['car_description'];
    $status = $data['status'];
    $filename=$data['car_image'];
    
}

if(isset($_POST['create-car']))
{
    $car_name = $_POST['car_name'];
    $color = $_POST['color'];
    $number_plate = $_POST['number_plate'];
    $city_id = $_POST['city_id'];
    $model_year = $_POST['model_year'];
    $km_driven = $_POST['km_driven'];
    $deposit = $_POST['deposit'];
    $fuel_type = $_POST['fuel_type'];
    $baggage_capacity = $_POST['baggage_capacity'];
    $seating_capacity = $_POST['seating_capacity'];
    $range = $_POST['range'];
    $engine_size = $_POST['engine_size'];
    $driving_type = $_POST['driving_type'];
    $car_description = $_POST['car_description'];
    $status = $_POST['status'];
    if(isset($_GET['edit']))
    {
        //All part for edit
        $checkadmin = mysqli_fetch_assoc(mysqli_query($conn,"SELECT car_id FROM car WHERE car_name='".$car_name."' AND car_id!=".$_GET['edit']." AND `delete`=0"));
        if(count($checkadmin)==0){

            if(isset($_FILES['car_image']) && ! empty($_FILES['car_image']['name'])){
                $image=$_FILES['car_image'];
        
                $filename = uploadImage($image);
            }

                $addadmin = mysqli_query($conn,"UPDATE car SET car_name='".$car_name."',color='".$color."',number_plate='".$number_plate."',
                city_id='".$city_id."',model_year='".$model_year."',km_driven='".$km_driven."',deposit='".$deposit."',fuel_type='".$fuel_type."',
                baggage_capacity='".$baggage_capacity."',seating_capacity='".$seating_capacity."',`range`='".$range."',
                engine_size='".$engine_size."',driving_type='".$driving_type."',car_description='".$car_description."',
                status='".$status."',car_image='".$filename."' WHERE car_id=".$_GET['edit']."");
            
            ?>
            <script>
                $(document).ready(function(){
                    toastr.success("Car updated successfully");
                })
            </script>
            <?php
        }else{
            //Duplicate entry for email or phone
            ?>
            <script>
                $(document).ready(function(){
                    toastr.error("Car already exists");
                })
            </script>
            <?php

        }
    }
    else
    {
        $image=$_FILES['car_image'];
        
        $filename = uploadImage($image);

        $checkcar = mysqli_fetch_assoc(mysqli_query($conn,"SELECT car_id FROM car WHERE car_name='".$car_name."'"));
        
        if(count($checkcar)==0){
            
            //add query
            $addadmin = mysqli_query($conn,"INSERT INTO car SET car_name='".$car_name."',color='".$color."',number_plate='".$number_plate."',
            city_id='".$city_id."',model_year='".$model_year."',km_driven='".$km_driven."',deposit='".$deposit."',fuel_type='".$fuel_type."',
            baggage_capacity='".$baggage_capacity."',seating_capacity='".$seating_capacity."',`range`='".$range."',
            engine_size='".$engine_size."',driving_type='".$driving_type."',car_description='".$car_description."',
            status='".$status."',car_image='".$filename."'");
            
            $car_name = "";
            $color = "";
            $number_plate = "";
            $city_id ="";
            $model_year = "";
            $km_driven ="";
            $deposit = "";
            $fuel_type ="";
            $baggage_capacity = "";
            $seating_capacity = "";
            $range = "";
            $engine_size = "";
            $driving_type = "";
            $car_description = "";
            $status = "";
            ?>
            <script>
                $(document).ready(function(){
                    toastr.success("Car created successfully")
                })
            </script>
            <?php
        }else{
            //Duplicate entry for email or phone
            ?>
            <script>
                $(document).ready(function(){
                    toastr.error("Car already exists")
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
                    <li class="breadcrumb-item"><a href="#">Car</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php if(isset($_GET['edit'])){echo "Edit";}else{echo "Add";} ?> Car</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"></span></span><?php if(isset($_GET['edit'])){echo "Edit";}else{echo "Add";} ?> Car</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <form action="" method="post" id="add-car-validation" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="email">Car Name</label>
                                                    <input class="form-control" name="car_name" placeholder="Enter car name" type="text" value="<?php if(isset($car_name)){echo $car_name;} ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="email">Enter number plate</label>
                                                    <input class="form-control" name="number_plate" placeholder="Enter number plate" type="text" value="<?php if(isset($number_plate)){echo $number_plate;} ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="country">City</label>
                                                    <select class="form-control custom-select d-block w-100" name="city_id" id="city_dropdown">
                                                    
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="email">Model year</label>
                                                    <input class="form-control" name="model_year" placeholder="Enter model year" type="number" value="<?php if(isset($model_year)){echo $model_year;} ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="color">Color</label>
                                                    <input class="form-control" name="color" placeholder="Enter car color" type="text" value="<?php if(isset($color)){echo $color;} ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="email">Km driven</label>
                                                    <input class="form-control" name="km_driven" placeholder="Enter KM Driven" type="text" value="<?php if(isset($km_driven)){echo $km_driven;} ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="deposit">Deposit</label>
                                                    <input class="form-control" name="deposit" placeholder="Enter deposit" type="number" value="<?php if(isset($deposit)){echo $deposit;} ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="email">Fuel type</label>
                                                    <input class="form-control" name="fuel_type" placeholder="Enter fuel type" type="text" value="<?php if(isset($fuel_type)){echo $fuel_type;} ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="email">Seating capacity</label>
                                                    <input class="form-control" name="seating_capacity" placeholder="Enter seating capacity" type="number" value="<?php if(isset($seating_capacity)){echo $seating_capacity;} ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="email">Baggage capacity</label>
                                                    <input class="form-control" name="baggage_capacity" placeholder="Enter baggage capacity" type="number" value="<?php if(isset($baggage_capacity)){echo $baggage_capacity;} ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="range">Range</label>
                                                    <input class="form-control" name="range" placeholder="Enter range" type="number" value="<?php if(isset($range)){echo $range;} ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="engine_size">Engine size</label>
                                                    <input class="form-control" name="engine_size" placeholder="Enter engine size" type="text" value="<?php if(isset($engine_size)){echo $engine_size;} ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="email">Driving type</label>
                                                    <input class="form-control" name="driving_type" placeholder="Enter driving type" type="text" value="<?php if(isset($driving_type)){echo $driving_type;} ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <input class="form-control" name="status" placeholder="Enter Status" type="text" value="<?php if(isset($status)){echo $status;} ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                        <label for="email">Car Description</label>
                                                        <input class="form-control" name="car_description" placeholder="Enter car description" type="text" value="<?php if(isset($car_description)){echo $car_description;} ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Car image</label>
                                                    <input class="form-control" name="car_image" type="file" onchange="readURL(this)">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <img id="img" src="../../images/car_image/<?php if(isset($filename)){echo $filename;}else{echo"select-image-vector-12503576.jpg";} ?>" height="300" width="300" style="margin-top:3%" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        
                                        <button class="btn btn-primary" name="create-car" type="submit"><?php if(isset($_GET['edit'])){echo "Save changes";}else{echo "Create";} ?></button>
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
    loadcity();
    function readURL(input) {
    if (input.files && input.files[0]) {
    
      var reader = new FileReader();
      reader.onload = function (e) { 
        document.querySelector("#img").setAttribute("src",e.target.result);
      };

      reader.readAsDataURL(input.files[0]); 
    }
  }
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
            
        $("#add-car-validation").validate({
            rules:{
                car_name:{
                    required:true,
                    String:true,
                },
                number_plate:{
                    required:true
                },
                city:{
                    required:true
                },
                model_year:{
                    required:true
                },
                color:{
                    required:true
                },
                km_driven:{
                    required:true
                },
                deposit:{
                    required:true
                },
                fuel_type:{
                    required:true
                },
                seating_capacity:{
                    required:true
                },
                baggage_capacity:{
                    required:true
                },
                range:{
                    required:true
                },
                engine_size:{
                    required:true
                },
                driving_type:{
                    required:true
                },
                status:{
                    required:true
                },
                car_description:{
                    required:true
                },
                <?php if(!isset($_GET['edit'])){ ?>
                car_image:{
                    required:true
                },
                <?php } ?>
                status:{
                    required:true
                },
            },
            messages:{
                car_name:{
                    required:"Full name is required",
                },
                number_plate:{
                    required:"Number plate is required"
                },
                city:{
                    required:"Car city required"
                },
                model_year:{
                    required:"Model year required"
                },
                color:{
                    required:"Car color required"
                },
                km_driven:{
                    required:"KM Driven required"
                },
                deposit:{
                    required:"Deposit required"
                },
                fuel_type:{
                    required:"Fuel type required"
                },
                seating_capacity:{
                    required:"Seating capacity required"
                },
                baggage_capacity:{
                    required:"Baggage capacity required"
                },
                range:{
                    required:"Range required"
                },
                engine_size:{
                    required:"Engine size required"
                },
                driving_type:{
                    required:"Driving type required"
                },
                status:{
                    required:"Car status required"
                },
                car_description:{
                    required:"Car description required"
                },
                <?php if(!isset($_GET['edit'])){ ?>
                car_image:{
                    required:"Car image is required"
                },
                <?php } ?>
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
