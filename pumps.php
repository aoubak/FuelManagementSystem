<?php
include("view/partials/head.php");
include("includes/dbManager.php");
checkLogin();
if (isLogin() == false) {
    header("location:login.php");
}
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
                    <div class="modal fade bd-insert-modal-lg" id="exampleModalCenterUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg " role="document">
                        <form action="includes/dbManager.php" method="post">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title font-weight-bold " id="exampleModalLongTitle">Enter Pump Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body ">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col d-flex flex-column d-block">
                                            <label for="fuel type" class="form-select-sm  font-weight-bold">Pump Name</label>
                                            <input type="text" name="pumpName" class="form-control">
                                            <label for="" class="font-weight-bold">Pomp Code</label>
                                            <input type="text" name="pumpDesc" class="form-control" aria-label=".cost">

                                           
                                        </div>
                                        <div class="col d-flex flex-column d-block">
                                            <label for="fuel type" class="form-select-sm example font-weight-bold">Fuel Type</label>
                                            <select name="fuelID" class="custom-select form-select-sm" aria-label=".form-select-sm example">
                                                <option selected>-- Choose --</option>
                                                <?php
                                                $fuels = getFuels();
                                                foreach ($fuels as $fuel) {

                                                ?>
                                                    <option value="<?php echo $fuel['FuelID']; ?>"><?php echo $fuel['FuelType']; ?></option>
                                                <?php } ?>
                                            </select>

                                            <label for="" class="font-weight-bold">Station</label>
                                            <select name="stationID" class="custom-select form-select-sm" aria-label=".form-select-sm example">
                                                <option selected>-- Choose --</option>
                                                <?php
                                                $stations = getStations();
                                                foreach ($stations as $station) {

                                                ?>
                                                    <option value="<?php echo $station['StationID']; ?>"><?php echo $station['Name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            
                                        </div>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="addPump" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                           </form>
                        </div>
                    </div>
                    <!-- modal -->
                    <div class="modal fade bd-updateStatus-modal-lg" id="PumpStatusModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg " role="document">
                            <form action="includes/dbManager.php" method="post">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title font-weight-bold " id="exampleModalLongTitle">Update Pump Status </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">

                                        <div class="row d-flex justify-content-center ">
                                            <div class="col d-flex flex-column d-block ViewPumpStatus">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="upPumpsStatus" class="btn btn-primary">Update</button>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                    <!-- modal -->

                    <div class="modal fade updatePumpModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content ViewPumps" id="">

                            </div>
                        </div>
                    </div>
                    <!-- alert delete -->
                    <div class="modal  alertDelete fade" tabindex="-1">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <form action="includes/dbManager.php" method="post">
                                    <input type="hidden" value="" name="pumpID" id="pumpID" class="form-control">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title font-weight-bold ">Delete Pump</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>


                                    <div class="modal-body">
                                        <p> Do you want to <span class="text-danger">delete</span> this data! please confirm.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="deletePump" class="btn btn-danger">Yes ! Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Page Heading -->
                    <div
                        class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Pumps</h1>
                        <!-- <a href="#"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i>
                            Add new order</a> -->
                    </div>



                    <!-- Content Row -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">

                            <h6 class="m-0 font-weight-bold text-primary">Pump List</h6>
                            <div class="actions">
                                <div class="dropdown  bg-white ">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu shadow-sm shadow-lg mr-4" aria-labelledby="dropdownMenu2">
                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target=".bd-insert-modal-lg"> <i class="fa-solid fa-plus bg-primary text-white p-1 rounded"></i> Add new Pump</a>

                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="card-body">

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
                                <div class="alert alert-success d-flex justify-content-between align-items-center" role="alert">
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
                                            <th>PumpID</th>
                                            <th>Pump Name </th>
                                            <th>Pump Desc </th>
                                            <th>Fuel ID</th>
                                            <th>StationID</th>
                                            <th>Status</th>
                                            <th>Action</th>


                                        </tr>
                                    </thead>
                                    <tfoot class="bg-gray-800 text-white">
                                        <tr>
                                            <th>PumpID</th>
                                            <th>Pump Name </th>
                                            <th>Pump Desc </th>
                                            <th>Fuel ID</th>
                                            <th>StationID</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $pumps = getPumps();
                                        foreach ($pumps as $pump) {
                                        ?>


                                            <tr>
                                                <td class="pumpID"> <?php echo $pump['pumpID'] ?></td>
                                                <td><?php echo $pump['pumpName'] ?> </td>
                                                <td><?php echo $pump['pumpDesc'] ?> </td>
                                                <td> <span class=" "><?php echo $pump['fuelID'] ?></span></td>
                                                <td><?php echo $pump['stationID'] ?></td>
                                                <!-- <td><?php echo $pump['createdAt'] ?></td> -->
                                                <td>
                                                    <?php
                                                    if ($pump['status'] == 0) {
                                                        echo '<span  class="bg-danger text-white p-1 rounded">In Active</span> ';
                                                    }
                                                    ?>

                                                    <?php
                                                    if ($pump['status'] == 1) {
                                                        echo '<span  class="bg-success text-white p-1 border-0 rounded">Active</span>';
                                                    }

                                                    ?>

                                                    <button class="btn btn-info btn-sm updatePumpStatus">
                                                        <i class="fa-solid fa-pen-to-square fa-sm"></i></button>
                                                </td>
                                                <td><button class="btn btn-primary btn-sm updatePumpView">
                                                        <i class="fa-solid fa-pen-to-square fa-sm"></i></button>
                                                    <button class="btn btn-danger btn-sm deletePump">
                                                        <i class="fa-solid fa-trash-can fa-sm"></i></button>
                                                </td>

                                            </tr>
                                        <?php } ?>
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
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title " id="exampleModalLabel">Ready to
                        Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select <span class="text-danger">"Logout"</span> below if you are
                    ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button"
                        data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="logout.php">Logout</a>
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

    <script>
        $(document).ready(function() {
            $('.updatePumpStatus').click(function(e) {
                e.preventDefault();

                var pumpID = $(this).closest('tr').find('.pumpID').text();

                console.log(pumpID);
                $.ajax({
                    method: "POST",
                    url: "includes/dbManager.php",
                    data: {
                        'updatePumpStatus': true,
                        'pumpID': pumpID,
                    },
                    success: function(response) {
                        console.log(response);
                        $('.ViewPumpStatus').html(response);
                        $('#PumpStatusModel').modal('show');

                    }
                });

            });
        });

        // update pumps
        $(document).ready(function() {
            $('.updatePumpView').click(function(e) {
                e.preventDefault();

                var pumpID = $(this).closest('tr').find('.pumpID').text();

                // console.log(StationID);
                $.ajax({
                    method: "POST",
                    url: "includes/dbManager.php",
                    data: {
                        'updatePumpView': true,
                        'pumpID': pumpID,
                    },
                    success: function(response) {
                        console.log(response);
                        $('.ViewPumps').html(response);
                        $('.updatePumpModal').modal('show');

                    }
                });

            });
        });

        // delete pumps
        $(document).ready(function() {
            $('.deletePump').click(function(e) {
                e.preventDefault();

                var pumpID = $(this).closest('tr').find('.pumpID').text();

                // console.log(StationID);
                $('#pumpID').val(pumpID);
                $('.alertDelete').modal('show');


            });
        });
    </script>



</body>

</html>