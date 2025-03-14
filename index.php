<?php

include("view/partials/head.php");
include("includes/dbManager.php");
checkLogin();
if (isLogin()==false){
    header("location:login.php");
}



$conn = getConnection();
$result = $conn->query("SELECT  UnitPrice  FROM `fuels` WHERE FuelType = 'Petrol'");
$rows = $result->fetch_all(MYSQLI_ASSOC);
foreach ($rows as $Petrol) {
}


$conn = getConnection();
$result = $conn->query("SELECT  UnitPrice  FROM `fuels` WHERE FuelType = 'Diesel'");
$rows = $result->fetch_all(MYSQLI_ASSOC);
foreach ($rows as $Diesel) {
}


$conn = getConnection();
$result = $conn->query("SELECT  UnitPrice  FROM `fuels` WHERE FuelType = 'GAS'");
$rows = $result->fetch_all(MYSQLI_ASSOC);
foreach ($rows as $GAS) {
}


$conn = getConnection();
$result = $conn->query("SELECT  UnitPrice  FROM `fuels` WHERE FuelType = 'KEROSENE'");
$rows = $result->fetch_all(MYSQLI_ASSOC);
foreach ($rows as $KEROSENE) {
}


?>



<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        include("view/partials/sidebar.php");
        ?>


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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target=".bd-example-modal-lg"><i
                                class="fa fa-gas-pump fa-sm text-white-50"></i> Price Control</a>
                    </div>
                    <!-- Button trigger modal -->
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        Launch demo modal
                    </button> -->

                    <!-- Modal -->
                    <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg " role="document">
                            <div class="modal-content">
                            <form action="includes/dbManager.php" method="post">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title font-weight-bold " id="exampleModalLongTitle">FUEL PRICE CONTROL</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body ">
                                
                                    <table class="table table-bordered table-striped" id="dataTable" width="100%">
                                        <thead class="rounded bg-primary text-white font-weight-bold" cellspacing="0">
                                            <tr>
                                                <td>Fuel Type</td>
                                                <td>Current Price Per Liter</td>
                                                <td>New price Per Liter</td>
                                            </tr>
                                        <tbody>
                                            
                                                <tr>
                                                    <td class="font-weight-bold">Diesel</td>
                                                    <td><input type="text" class="form-control text-dark " name="diesel" value="$ <?php echo $Diesel['UnitPrice']; ?>" placeholder="$ 1.00" disabled="disabled"></td>

                                                    <td><input type="text" class="form-control" name="diesel" value="<?php echo $Diesel['UnitPrice']; ?>" placeholder="New Price Here..."></td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Petrol</td>
                                                    <td><input type="text" class="form-control text-dark" name="petrol" value="$ <?php echo $Petrol['UnitPrice']; ?>" placeholder="$ 1.7.00" disabled="disabled"></td>
                                                    <td><input type="text" class="form-control" name="petrol" value="<?php echo $Petrol['UnitPrice']; ?>" placeholder="New Price Here..."></td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Gas</td>
                                                    <td><input type="text" class="form-control text-dark" name="gas" value="$ <?php echo $GAS['UnitPrice']; ?>" placeholder="$ 1.3.00" disabled="disabled"></td>
                                                    <td><input type="text" class="form-control" name="gas" value=" <?php echo $GAS['UnitPrice']; ?>" placeholder="New Price Here..."></td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Kerosene</td>
                                                    <td><input type="text" class="form-control text-dark" name="kerosene" value="$ <?php echo $KEROSENE['UnitPrice']; ?>" placeholder="$ 1.9.00" disabled="disabled"></td>
                                                    <td><input type="text" class="form-control" name="kerosene" value="<?php echo $KEROSENE['UnitPrice']; ?>" placeholder="New Price Here..."></td>
                                                </tr>
                                        </tbody>
                                        </thead>
                                    </table>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="updateFuelPrice" class="btn btn-primary">Update price</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
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
                    <div class="row">
                        <div class="col-xl-3  col-md-6">
                        <h5>Today <span class="font-weight-bold text-dark">price</span></h6>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary rounded  border-primary text-uppercase mb-1">
                                                <?php
                                                echo date('m/d/Y');
                                                ?>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">PETROL</div>
                                        </div>

                                        <div class="col-auto text-center rounded">

                                            <h3 class="text-bold text-danger m-0 border border-1 border-bottom-primary p-2  rounded font-weight-bold">$<?php echo $Petrol['UnitPrice']; ?>/L</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary rounded  border-primary text-uppercase mb-1">
                                                <?php
                                                echo date('m/d/Y');
                                                ?>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">DIESEL</div>
                                        </div>

                                        <div class="col-auto text-center rounded">

                                            <h3 class="text-bold text-danger border border-1 border-bottom-success p-1 rounded m-0 font-weight-bold">$<?php echo $Diesel['UnitPrice']; ?>/L</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary rounded  border-primary text-uppercase mb-1">
                                                <?php
                                                echo date('m/d/Y');
                                                ?>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">GAS</div>
                                        </div>

                                        <div class="col-auto text-center rounded">
                                            <h3 class="text-bold text-danger border border-1 border-bottom-danger p-1 rounded m-0 font-weight-bold">$<?php echo $GAS['UnitPrice']; ?>/Kg</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary rounded  border-primary text-uppercase mb-1">
                                                <?php
                                                echo date('m/d/Y');
                                                ?>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">KEROSENE</div>
                                        </div>

                                        <div class="col-auto text-center rounded">
                                            <h3 class="text-bold text-danger border border-1 border-bottom-warning p-1 rounded m-0 font-weight-bold">$<?php echo $KEROSENE['UnitPrice']; ?>/L</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3  col-md-6">
                        <h5>Today <span class="font-weight-bold text-dark">sales</span></h6>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary rounded  border-primary text-uppercase mb-1">
                                                <?php
                                                echo date('m/d/Y');
                                                ?>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">PETROL</div>
                                        </div>

                                        <div class="col-auto text-center rounded">

                                            <h3 class="text-bold text-danger m-0 border border-1 border-bottom-primary p-2  rounded font-weight-bold">$0.00</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary rounded  border-primary text-uppercase mb-1">
                                                <?php
                                                echo date('m/d/Y');
                                                ?>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">DIESEL</div>
                                        </div>

                                        <div class="col-auto text-center rounded">

                                            <h3 class="text-bold text-danger border border-1 border-bottom-success p-1 rounded m-0 font-weight-bold">$0.00</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary rounded  border-primary text-uppercase mb-1">
                                                <?php
                                                echo date('m/d/Y');
                                                ?>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">GAS</div>
                                        </div>

                                        <div class="col-auto text-center rounded">
                                            <h3 class="text-bold text-danger border border-1 border-bottom-danger p-1 rounded m-0 font-weight-bold">$0.00</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary rounded  border-primary text-uppercase mb-1">
                                                <?php
                                                echo date('m/d/Y');
                                                ?>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">KEROSENE</div>
                                        </div>

                                        <div class="col-auto text-center rounded">
                                            <h3 class="text-bold text-danger border border-1 border-bottom-warning p-1 rounded m-0 font-weight-bold">$0.00</h3>
                                        </div>
                                    </div>
                                </div>
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
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Fuel Station Managment 2025</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>