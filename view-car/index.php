<?php
include("../include/header.php");
?>

 <!-- Main Content -->
 <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View-Admin</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">

                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"></span></span>View Admin</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                    <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                        <thead>
                                                <tr>
                                                <th>ID</th>
                                                    <th>Action</th>
                                                    <th>Car Name</th>
                                                    <th>Fuel type</th>
                                                    <th>Image</th>
                                                    <th>Status</th>
                                                    <th>Deposit</th>
                                                </tr>
                                            </thead>
                                            <tbody id="car_table_data">
                                            
                                            </tbody>   
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Action</th>
                                                    <th>Car Name</th>
                                                    <th>Fuel type</th>
                                                    <th>Image</th>
                                                    <th>Status</th>
                                                    <th>Deposit</th>
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

    function deletecar(id){
        
        $.ajax({
        url: "../ajax/delete/deletecar.php",
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
    function loadcar()
    {
        
        $.ajax({
        url: "../ajax/data/cartable.php",
        type: "POST",
        async: true,
        success: function (data) {
            $('#car_table_data').html(data)
        },
        error: function(err){
            console.log("err: ",err);
        }
        }); 
    }
    loadcar();
</script>
<?php
if($_SESSION['delete']=="1"){
    
    ?>

    <script>
        $(document).ready(function(){
                toastr.error("Car deleted successfully")
            })
    </script>
    <?php
    unset($_SESSION['delete']);
} ?>