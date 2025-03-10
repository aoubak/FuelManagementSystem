<?php
include("view/partials/head.php");
include("includes/dbManager.php");
checkLogin();
if (isLogin()==false){
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
                    <!-- Page Heading -->
                    <div
                        class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Sales History</h1>
                        <!-- <a href="#"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i>
                            Add new order</a> -->
                    </div>



                    <!-- Content Row -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Sales History</h6>
                            <div class="actions">
                                <div class="dropdown  bg-white ">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu shadow-sm shadow-lg mr-4" aria-labelledby="dropdownMenu2">
                                        <a href="fuel.php" class="dropdown-item"> Veiw Fuel</a>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                        <p class="font-weight-bold text-dark text-center">Search sales based on date sold</p>
                            <div class="col-12 d-flex flex-row d-sm-block mb-3  ">
                                
                                <div class="col-6 p-2 rounded d-flex border border-1 align-items-center">
                                    <span class="font-weight-bold text-dark">From</span>
                                    <input type="date" name="" id="" class="form-control mr-2 ml-2">
                                    <span class="font-weight-bold text-dark">To</span>

                                </div>
                                <div class="col-6 p-2 bor rounded d-flex border border-1 align-items-center">
                                    <input type="date" name="" id="" class="form-control mr-2">
                                    <button type="submit" class="btn btn-success">Search</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>FuelID</th>
                                            <th>Fuel Type</th>
                                            <th>Total Liters Supplied</th>
                                            <th>Cost</th>
                                            <th>Supplier</th>
                                            <th>Date</th>

                                        </tr>
                                    </thead>
                                    <tfoot class="bg-gray-800 text-white">
                                        <tr>
                                            <th>FuelID</th>
                                            <th>Fuel Type</th>
                                            <th>Total Liters Supplied</th>
                                            <th>Cost</th>
                                            <th>Supplier</th>
                                            <th>Date</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <!-- PETROL ROW -->
                                        <?PHP
                                        $petrols = getPetrol();
                                        foreach ($petrols as $petrol) {


                                        ?>
                                            <tr>
                                                <td><?php echo $petrol['FuelID']; ?></td>
                                                <td><?php echo $petrol['FuelType']; ?> </td>
                                                <td><?php echo $petrol['TotalLiterSupplied']; ?><span class="bg-primar font-weight-bold text-success p-1 rounded">Ltrs</span></td>
                                                <td> <span class="bg-sucess text-success font-weight-bold p-1 rounded ">$</span><?php echo $petrol['Cost']; ?></td>
                                                <td> <?php echo $petrol['Supplier']; ?> </td>
                                                <td><?php
                                                    $newData = date("d-M-Y", strtotime($petrol['Date']));
                                                    echo $newData;
                                                    ?></td>
                                            </tr>
                                        <?php } ?>

                                        <!-- Desiel Row -->
                                        <?PHP
                                        $deisels = getDeisel();
                                        foreach ($deisels as $deisel) {


                                        ?>
                                            <tr>
                                                <td><?php echo $deisel['FuelID']; ?></td>
                                                <td><?php echo $deisel['FuelType']; ?> </td>
                                                <td><?php echo $deisel['TotalLiterSupplied']; ?><span class="bg-primar font-weight-bold text-success p-1 rounded">Ltrs</span></td>
                                                <td> <span class="bg-sucess text-success font-weight-bold p-1 rounded ">$</span><?php echo $deisel['Cost']; ?></td>
                                                <td> <?php echo $deisel['Supplier']; ?> </td>
                                                <td><?php
                                                    $newData = date("d-M-Y", strtotime($deisel['Date']));
                                                    echo $newData;
                                                    ?></td>
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
                <div class="modal-body">Select "Logout" below if you are
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

</body>

</html>