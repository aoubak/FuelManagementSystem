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
                    <div class="modal fade bd-addUser-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg " role="document">
                            <div class="modal-content">
                                <form action="includes/dbManager.php" class="employeeForm" method="post">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title font-weight-bold " id="exampleModalLongTitle">Enter Employee Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                     


                                        <div class="row d-flex justify-content-center">
                                            <div class="col d-flex flex-column d-block">



                                                <label for="fuel type" class="form-select-sm  font-weight-bold">Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="Name">
                                                <label for="fuel type" class="form-select-sm  font-weight-bold">Email</label>
                                                <input type="Email" name="email" class="form-control" placeholder="Name">
                                                <label for="" class="font-weight-bold">User Name</label>
                                                <input type="text" name="username" class="form-control" placeholder="Username">
                                                <label for="" class="font-weight-bold">Contact Number</label>
                                                <input type="text" name="contactNumber" class="form-control" placeholder="Contact Number">

                                            </div>
                                            <div class="col d-flex flex-column d-block">
                                                <label for="fuel type" class="font-weight-bold">Sex:</label>
                                                <select name="sex" class="custom-select form-select-sm" aria-label=".form-select-sm example">
                                                    <option selected>Choose...</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                                <label for="" class="font-weight-bold">Password</label>
                                                <input type="password" name="password" class="form-control" placeholder="Password">
                                                <!-- <label for="" class="font-weight-bold">Confirm Password</label>
                                                <input type="password" class="form-control" placeholder="Confirm Password"> -->
                                                <label for="fuel type" class="font-weight-bold">Staions:</label>

                                                <select name="staion" class="custom-select form-select-sm" aria-label=".form-select-sm example">
                                                    <?php
                                                    $stations = getStations();
                                                    foreach ($stations as $Station) {

                                                    ?>
                                                        <option value="<?php echo $Station['StationID']; ?>"><?php echo $Station['Name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="" class="font-weight-bold">Roles:</label>
                                                <select name="role" class="custom-select form-select-sm" aria-label=".form-select-sm example">
                                                    <option selected>Choose...</option>
                                                    <option value="Pump Operator">Pump Operator</option>
                                                    <option value="Accountant/Cashier">Accountant/Cashier</option>
                                                    <option value="Station Manager">Station Manager</option>
                                                    <option value="Mechanic/Technician">Mechanic/Technician</option>
                                                    <option value="Security Guard">Security Guard </option>
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" id="addEmployee" name="addEmployee" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Page Heading -->
                    <div
                        class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Employees</h1>
                        <!-- <a href="#"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i>
                            Add new order</a> -->
                    </div>



                    <!-- Content Row -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Employee List</h6>
                            <div class="actions">
                                <div class="dropdown  bg-white ">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu shadow-sm shadow-lg mr-4" aria-labelledby="dropdownMenu2">
                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target=".bd-addUser-modal-lg"> <i class="fa-solid fa-plus bg-primary text-white p-1 rounded"></i> New Empolyee</a>
                                        <!-- <a href="fuel_history.php" class="dropdown-item"> Veiw order history</a> -->

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_SESSION['checkMail'])) {

                            ?>
                                <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                                    <strong> <?php echo $_SESSION['checkMail']; ?></strong> 
                                </div>
                            <?php

                                unset($_SESSION['checkMail']);
                            }
                            ?>

                            <?php
                            if (isset($_SESSION['status'])) {

                            ?>
                                <div class="alert alert-success" role="alert">
                                    <strong> <?php echo $_SESSION['status']; ?></strong>
                                </div>
                            <?php

                                unset($_SESSION['status']);
                            }
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>EmployeeID</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Sex</th>
                                            <th>Contact</th>
                                            <th>StationID</th>
                                            <th>Status</th>
                                            <th>Actions</th>



                                        </tr>
                                    </thead>
                                    <tfoot class="bg-gray-800 text-white">
                                        <tr>
                                            <th>EmployeeID</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Sex</th>
                                            <th>Contact</th>
                                            <th>StationID</th>
                                            <th>Status</th>
                                            <th>Actions</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php

                                        $Employees = getEmployees();

                                        foreach ($Employees as $Employee) {

                                        ?>
                                            <tr>
                                                <td><?php echo $Employee['EmployeeID']; ?></td>
                                                <td><?php echo $Employee['Name']; ?></td>
                                                <td><?php echo $Employee['UserName']; ?></td>
                                                <td><span class="text-primary font-weight-bold p-1 rounded"><?php echo $Employee['Role']; ?></span></td>
                                                <td><?php echo $Employee['Sex']; ?></td>
                                                <td><?php echo $Employee['ContactNumber']; ?> </td>
                                                <td><?php echo $Employee['StationID']; ?> </td>
                                                <td> <?php
                                                        if ($Employee['Status'] == 0) {
                                                            echo '<span  class="bg-danger text-white p-1 rounded">In Active</span> ';
                                                        }
                                                        if ($Employee['Status'] == 1) {
                                                            echo '<span  class="bg-success text-white p-1 border-0 rounded">Active</span>';
                                                        }
                                                        ?> <button class="btn btn-info btn-sm m-1" data-toggle="modal" data-target=".bd-update-modal-lg">
                                                        <i class="fa-solid fa-pen-to-square fa-sm"></i></button> </td>
                                                <td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-update-modal-lg">
                                                        <i class="fa-solid fa-pen-to-square fa-sm"></i></button>
                                                    <button class="delete_data btn btn-danger btn-sm">
                                                        <i class="fa-solid fa-trash-can fa-sm"></i></button>
                                                </td>
                                            </tr>





                                        <?php }
                                        ?>




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

</body>

</html>