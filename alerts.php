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


                    <!-- Page Heading -->
                    <div
                        class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Alert Center</h1>
                        <!-- <a href="#"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i>
                            Add new order</a> -->
                    </div>



                    <!-- Content Row -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Alert Summery</h6>

                        </div>
                        <div class="card-body">
                            <?php



                            $conn = getConnection();
                            $sql = "SELECT FuelType, AvailableLiters FROM fuels WHERE AvailableLiters <= 500";
                            $result = $conn->query($sql);


                            ?>


                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Summery</th>
                                            <th>Last Updated</th>
                                            <th>Type</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        if (isset($result)) {
                                            echo '';
                                            while ($row = $result->fetch_assoc()) {
                                                echo "
                                        <tr>
                                        <td><div class='icon-circle bg-warning  '>
                                        <i class='fas fa-exclamation-triangle text-white'></i>
                              
                                                        </div></td>
                                            <td> <strong class='text-danger' >Low Fuel!</strong> " . $row['FuelType'] . " has only <strong class='text-danger'> " . $row['AvailableLiters'] . "L</strong> remaining.</td>
                                            
                                            <td>" . date("F d, Y") . " </td>
                                            <td><span class='text-danger font-weight-bold p-1 rounded'><i class='fa-solid fa-circle  fa-beat-fade text-warning' style='font-size: 12px';></i> Low Fuel</span></td>
                                            
                                        </tr>
                                       
                                        ";
                                            }
                                        ?></tbody>
                                    <tfoot>
                                        <tr class="bg-dark text-white font-weight-bold">
                                            <th>#</th>
                                            <th>Summery</th>
                                            <th>Last Updated</th>
                                            <th>Type</th>
                                          
                                        
                                        </tr>
                                    </tfoot>




                                <?php }
                                ?>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // 1. Confirm Alert -> 2. Loading -> 3. No Redirect -> 4. Auto Run generateReceipt() -> 5. Auto Show Modal

        //   function confirmCreateReceipt(invoice_no) {}
        function confirmCreateReceipt(transaction_no) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to create a new receipt?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Create it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Creating...',
                        text: 'Please wait...',
                        timer: 1000,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    }).then(() => {
                        // Directly run generateReceipt()
                        generateReceipt(transaction_no);
                    })
                }
            })
        }


        function generateReceipt(transaction_no) {
            $.ajax({
                url: 'includes/dbManager.php', // Inside this handle receipt creation
                type: 'POST',
                data: {
                    transaction_no: transaction_no,
                    create_receipt: true // Optional check in PHP
                },
                success: function(response) {
                    $('#receiptContent').html(response);
                    $('#receiptModal').modal('show');
                }
            });
        }

        // print function of receipt

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>


</body>

</html>