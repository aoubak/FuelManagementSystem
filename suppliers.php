<?php
// if(!session_id()) session_start();;

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

                    <!-- Modal insert-->
                    <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg " role="document">
                            <form action="includes/dbManager.php" method="post">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title font-weight-bold " id="exampleModalLongTitle">Enter Supplier Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col d-flex flex-column d-block">
                                                <label for="fuel type" class="font-weight-bold">Supplier name</label>
                                                <input type="text" name="supplierName" class="form-control">
                                                <label for="fuel type" class="font-weight-bold">Location</label>
                                                <input type="text" name="location" class="form-control">
                                            </div>
                                            <div class="col d-flex flex-column d-block">

                                                <label for="" class="font-weight-bold">Email</label>
                                                <input type="text" name="email" class="form-control" aria-label=".cost">

                                                <label for="" class="font-weight-bold">Contact numer</label>
                                                <input type="text" name="contactNumber" class="form-control" aria-label=".cost">
                                            </div>

                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="addSupplier" class="btn btn-primary">Submit</button>
                                    </div>
                            </form>
                        </div>
                    </div>

                    <!-- model update -->

                </div>

                <!-- Modal -->
                <div class="modal fade bd-updateStatus-modal-lg" id="SupplierStatusModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg " role="document">
                        <form action="includes/dbManager.php" method="post">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title font-weight-bold " id="exampleModalLongTitle">Update Station status </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body ">

                                    <div class="row d-flex justify-content-center ">
                                        <div class="col d-flex flex-column d-block ViewSupplierStatus">
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="upSuppleirStatus" class="btn btn-primary">Update</button>
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
                                <input type="hidden" value="" name="supplierID" id="supplierID" class="form-control">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title font-weight-bold ">Delete Supplier</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>


                                <div class="modal-body">
                                    <p> Do you want to <span class="text-danger">delete</span> this data! please confirm.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="deleteSupplier" class="btn btn-danger">Yes ! Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--  -->

                <!-- alert Update -->
                <div class="modal fade updateSuppleirModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content ViewSupplier" id="">

                        </div>
                    </div>
                </div>
                <!-- Page Heading -->
                <div
                    class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Suppliers</h1>
                    <!-- <a href="#"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i>
                            Add new order</a> -->
                </div>



                <!-- Content Row -->
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Suppliers</h6>
                        <div class="actions">
                            <div class="dropdown  bg-white ">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu shadow-sm shadow-lg mr-4" aria-labelledby="dropdownMenu2">
                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target=".bd-example-modal-lg"> <i class="fa-solid fa-plus bg-primary text-white p-1 rounded"></i> Add new sppliers</a>
                                    <!-- <a href="fuel_history.php" class="dropdown-item"> Veiw order history</a> -->

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
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
                            <?php
                            if (isset($_SESSION['delete'])) {

                            ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong> <?php echo $_SESSION['delete']; ?></strong>
                                </div>
                            <?php

                                unset($_SESSION['delete']);
                            }
                            ?>



                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>SupplierID</th>
                                        <th>Name</th>
                                        <th>Emial</th>
                                        <th>Contact Number</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Actions</th>



                                    </tr>
                                </thead>
                                <tfoot class="bg-gray-800 text-white">
                                    <tr>
                                        <th>SupplierID</th>
                                        <th>Name</th>
                                        <th>Emial</th>
                                        <th>Contact Number</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                    <?php

                                    $suppliers = getSuppliers();

                                    foreach ($suppliers as $supplier) {
                                    ?>
                                        <tr>
                                            <td class="supplierID"><?php echo $supplier['id']; ?></td>
                                            <td><?php echo $supplier['name']; ?></td>
                                            <td><?php echo $supplier['email']; ?></td>
                                            <td><?php echo $supplier['contactNumber']; ?></td>
                                            <td><?php echo $supplier['location']; ?></td>
                                            <td>
                                                <?php
                                                if ($supplier['status'] == 0) {
                                                    echo '<span  class="bg-danger  pointer-event text-white p-1 rounded">In Active</span> ';
                                                }
                                                if ($supplier['status'] == 1) {
                                                    echo '<span  class="bg-success pointer-event  text-white p-1 border-0 rounded">Active</span>';
                                                }
                                                ?>

                                                <button class="btn btn-info btn-sm updateSupplierStatus " data-toggle="modal" data-target=".bd-updateStationStatus-modal-lg">
                                                    <i class="fa-solid fa-pen-to-square fa-sm"></i></button>
                                            </td>
                                            <td><button class="btn btn-primary btn-sm updateSupplierView">
                                                    <i class="fa-solid fa-pen-to-square fa-sm"></i></button>
                                                <button class="btn btn-danger btn-sm deleteSupplier">
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

</body>

<script>
    $(document).ready(function() {
        $('.updateSupplierStatus').click(function(e) {
            e.preventDefault();

            var supplierID = $(this).closest('tr').find('.supplierID').text();

            // console.log(StationID);
            $.ajax({
                method: "POST",
                url: "includes/dbManager.php",
                data: {
                    'updateSupplierStatus': true,
                    'supplierID': supplierID,
                },
                success: function(response) {
                    console.log(response);
                    $('.ViewSupplierStatus').html(response);
                    $('#SupplierStatusModel').modal('show');

                }
            });

        });
    });

    // update supplier
    $(document).ready(function() {
        $('.updateSupplierView').click(function(e) {
            e.preventDefault();

            var supplierID = $(this).closest('tr').find('.supplierID').text();

            // console.log(StationID);
            $.ajax({
                method: "POST",
                url: "includes/dbManager.php",
                data: {
                    'updateSupplierView': true,
                    'supplierID': supplierID,
                },
                success: function(response) {
                    console.log(response);
                    $('.ViewSupplier').html(response);
                    $('.updateSuppleirModal').modal('show');

                }
            });

        });
    });

    // delete supplier
    $(document).ready(function() {
        $('.deleteSupplier').click(function(e) {
            e.preventDefault();

            var supplierID = $(this).closest('tr').find('.supplierID').text();

            // console.log(StationID);
            $('#supplierID').val(supplierID);
            $('.alertDelete').modal('show');


        });
    });
</script>


</html>