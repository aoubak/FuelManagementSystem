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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h1 class="h3 mb-0 text-gray-800">Manage Your System Preferences</h1>
                    </div>


                    <p>Customize your platform to suit your operations. Use this settings panel to update company details, adjust fuel pricing, configure stations and pumps, manage users, and control invoice or tax settings.</p>


                    <!-- Content Row -->

                    <div class="row mb-4">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Company Info
                                </div>
                                <div class="card-body">
                                    <div class="row flex gap-4">
                                        <div class="col">
                                            <h6 class="font-weight-bold">Company Name</h6>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col">
                                            <h6 class="font-weight-bold">Email</h6>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row flex gap-4">
                                        <div class="col">
                                            <h6 class="font-weight-bold">Address</h6>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col">
                                            <h6 class="font-weight-bold">Phone</h6>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <hr>
                                    <button class="btn btn-primary mt-2">Save Changes</button>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Station Setup
                                </div>
                                <div class="card-body">
                                    <div class="row flex gap-4">
                                        <div class="col">
                                            <h6 class="font-weight-bold">Current Stations</h6>
                                            <span class=""> You have
                                                <span class="text-success font-weight-bold"> <?php
                                                                                                CountStations();
                                                                                                ?> Stations</span>

                                            </span>
                                        </div>
                                        <div class="col">
                                            <a href="stations.php" class="btn btn-primary">Manage Station</a>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Employee Management
                                </div>
                                <div class="card-body">
                                    <div class="row flex gap-4">

                                        <div class="col">
                                            <h6 class="font-weight-bold">Current Employees</h6>
                                            <span class=""> You have
                                                <span class="text-success font-weight-bold">
                                                    <?php 
                                                    CountEmployees();
                                                    ?> Employees
                                                    </span>

                                            </span>
                                        </div>
                                        <div class="col">
                                            <a href="stations.php" class="btn btn-primary">Manage Employees</a>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Customer Management
                                </div>
                                <div class="card-body">
                                    <div class="row flex gap-4">

                                        <div class="col">
                                            <h6 class="font-weight-bold">Current Customers</h6>
                                            <span class=""> You have
                                                <span class="text-success font-weight-bold">
                                                    <?php 
                                                    CountCustomers();
                                                    ?> Customers
                                                    </span>

                                            </span>
                                        </div>
                                        <div class="col">
                                            <!-- <h6 class="font-weight-bold">Add Station</h6> -->
                                            <a href="employees.php" class="btn btn-primary">Manage Customers</a>
                                        </div>


                                    </div>
                                </div>
                            </div>
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
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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

</body>

</html>