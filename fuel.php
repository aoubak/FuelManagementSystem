<?php
include("view/partials/head.php");
include("includes/dbManager.php");
?>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include("view/partials/sidebar.php");
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                include("view/partials/nav.php");
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Modal -->
                    <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg " role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title font-weight-bold " id="exampleModalLongTitle">Enter Order Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body ">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col d-flex flex-column d-block">
                                            <label for="fuel type" class="form-select-sm  font-weight-bold">Fuel Type</label>
                                            <select class="custom-select form-select-sm" aria-label=".form-select-sm example">
                                                <option selected>Choose...</option>
                                                <option value="1">Petrol</option>
                                                <option value="2">Desiel</option>
                                                <option value="3">Gas</option>
                                            </select>
                                            <label for="" class="font-weight-bold">Total Liters</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col d-flex flex-column d-block">
                                            <label for="fuel type" class="form-select-sm example font-weight-bold">Supplier</label>
                                            <select class="custom-select form-select-sm" aria-label=".form-select-sm example">
                                                <option selected>Choose...</option>
                                                <option value="1">AKSOM</option>
                                                <option value="2">HASS</option>
                                                <option value="3">3CCC</option>
                                            </select>
                                            <label for="" class="font-weight-bold">Total Cost</label>
                                            <input type="text" class="form-control" aria-label=".cost">
                                        </div>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Submit order</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- NEW FUEL MMODEL -->
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="includes/dbManager.php" method="post">
                                    <div class="modal-header text-white bg-primary ">
                                        <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Enter Fuel Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col d-flex flex-column d-block">
                                                <label for="fuel type" class="font-weight-bold">Select Fuel Type</label>
                                                <select name="fuelType" class="custom-select form-select-sm" aria-label=".form-select-sm example">
                                                    <option selected>Choose...</option>
                                                    <option value="Petrol">Petrol</option>
                                                    <option value="Desiel">Desiel</option>
                                                    <option value="Gas">Gas</option>
                                                    <option value="Kerosene">Kerosene</option>
                                                </select>


                                            </div>
                                            <div class="col d-flex flex-column d-block">
                                                <label for="fuel type" class="font-weight-bold">Unit Price</label>
                                                <input type="text" name="unitPrice" class="form-control">


                                            </div>

                                        </div>
                                        <div class="row d-flex ">
                                            <div class="col d-flex flex-column">
                                                <label for="" class="font-weight-bold">Available Liters</label>
                                                <input type="text" name="availableLiters" class="form-control" aria-label=".cost">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" name="addNewFuel" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- model update fuel -->
                    <div class="modal fade bd-updateStatus-modal-lg" id="FuelStatusModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg " role="document">
                            <form action="includes/dbManager.php" method="post">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title font-weight-bold " id="exampleModalLongTitle">Update Fuel status </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">

                                        <div class="row d-flex justify-content-center ">
                                            <div class="col d-flex flex-column d-block ViewFuelStatus">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="upFuelStatus" class="btn btn-primary">Update</button>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                    <!-- alert delete -->
                    <div class="modal  alertDelete fade" tabindex="-1">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <form action="includes/dbManager.php" method="post">
                                    <input type="hidden" value="" name="FuelID" id="FuelID" class="form-control">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title font-weight-bold ">Delete Fuel</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>


                                    <div class="modal-body">
                                        <p> Are you sure, <br> you want to <span class="text-danger">delete</span> this data! please <strong>confirm</strong> .</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="deleteFuel" class="btn btn-danger">Yes ! Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <!-- Page Heading -->
                    <div
                        class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Fuels</h1>
                        <!-- <a href="#"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i>
                            Add new order</a> -->
                    </div>



                    <!-- Content Row -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Fuel List</h6>
                            <div class="actions">
                                <div class="dropdown  bg-white ">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu shadow-sm shadow-lg mr-4" aria-labelledby="dropdownMenu2">
                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target=".bd-example-modal-lg"> <i class="fa-solid fa-plus bg-primary text-white p-1 rounded"></i> New Order</a>
                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#staticBackdrop"> <i class="fa-solid fa-plus bg-primary text-white p-1 rounded"></i> New Fuel </a>
                                        <a href="fuel_history.php" class="dropdown-item"> Veiw order history</a>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_SESSION['checkfuel'])) {

                            ?>
                                <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                                    <strong> <?php echo $_SESSION['checkfuel']; ?></strong>
                                </div>
                            <?php

                                unset($_SESSION['checkfuel']);
                            }
                            ?>

                            <?php
                            if (isset($_SESSION['status'])) {

                            ?>
                                <div class="alert alert-success d-flex justify-content-between align-items-center" role="alert">
                                    <strong> <?php echo $_SESSION['status']; ?></strong>
                                </div>
                            <?php

                                unset($_SESSION['status']);
                            }
                            ?>

                            <?php
                            if (isset($_SESSION['delete'])) {

                            ?>
                                <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                                    <strong> <?php echo $_SESSION['delete']; ?></strong>
                                </div>
                            <?php

                                unset($_SESSION['delete']);
                            }
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>Fuel ID</th>
                                            <th>Fuel Type</th>
                                            <th>Available Liters </th>
                                            <th>Status</th>
                                            <th>Action</th>


                                        </tr>
                                    </thead>
                                    <tfoot class="bg-gray-800 text-white">
                                        <tr>
                                            <th>Fuel ID</th>
                                            <th>Fuel Type</th>
                                            <th>Available Liters </th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <?php
                                        $fuels = getFuels();
                                        foreach ($fuels as $fuel) {

                                        ?>

                                            <tr>
                                                <td class="FuelID"><?php echo $fuel['FuelID']; ?></td>
                                                <td><?php echo $fuel['FuelType']; ?> </td>
                                                <td><?php echo $fuel['AvailableLiters']; ?> <span class="text-primary font-weight-bold p-1 rounded">Ltrs</span></td>
                                                <td>
                                                    <?php
                                                    if ($fuel['Status'] == 0) {
                                                        echo '<span  class="bg-danger text-white p-1 rounded">In Active</span> ';
                                                    }
                                                    if ($fuel['Status'] == 1) {
                                                        echo '<span  class="bg-success text-white p-1 border-0 rounded">Active</span>';
                                                    }
                                                    ?>
                                                    <button class="btn btn-info btn-sm updateFuelStatus">
                                                        <i class="fa-solid fa-pen-to-square fa-sm"></i></button>
                                                </td>
                                                <td><button class="btn btn-primary btn-sm updateStation">
                                                        <i class="fa-solid fa-pen-to-square fa-sm"></i></button>
                                                    <button class="btn btn-danger btn-sm deleteFuel">
                                                        <i class="fa-solid fa-trash-can fa-sm"></i></button>
                                                </td>
                                            </tr>

                                        <?php  } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to
                        Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are
                    ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button"
                        data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <!-- jquery scripts -->
    <script>
        // delte function
        $(document).ready(function() {
            $('.deleteFuel').click(function(e) {
                e.preventDefault();

                var FuelID = $(this).closest('tr').find('.FuelID').text();

                console.log(FuelID);
                $('#FuelID').val(FuelID);
                $('.alertDelete').modal('show');


            });
        });

        // update status function
        $(document).ready(function() {
            $('.updateFuelStatus').click(function(e) {
                e.preventDefault();

                var FuelID = $(this).closest('tr').find('.FuelID').text();

                // console.log(StationID);
                $.ajax({
                    method: "POST",
                    url: "includes/dbManager.php",
                    data: {
                        'updateFuelStatus': true,
                        'FuelID': FuelID,
                    },
                    success: function(response) {
                        console.log(response);
                        $('.ViewFuelStatus').html(response);
                        $('#FuelStatusModel').modal('show');

                    }
                });

            });
        });
    </script>

</body>

</html>