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

                    <div class="modal fade" id="receiptModal" role="dialog" aria-hidden="true" tabindex="-1">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">

                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="exampleModalCenter">Fuel Sales Receipt</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="receiptContent">
                                    <div class="row">
                                        <div class="col">
                                            <div class="header text-center">
                                                <h4>Fuel Management System</h4>
                                                <p>86 Main St.</p>
                                                <p>Gacayte, MainVT2045</p>
                                                <p>+252907796534</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Receipt content will load here -->
                                </div>

                                <div class="modal-footer">
                                    <button onclick="printDiv('receiptContent')" class="btn btn-success">Print</button>
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
                            <h6 class="m-0 font-weight-bold text-primary">Generate Report</h6>
                            <div class="actions">
                                <div class="dropdown  bg-white ">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu shadow-sm shadow-lg mr-4" aria-labelledby="dropdownMenu2">
                                        <a href="sales.php" class="dropdown-item"> <i class='fa-solid fa-dollar-sign bg-primary text-white p-1 rounded'></i> Sales</a>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            $total_liters = 0;
                            $total_amount = 0;
                            if (isset($_POST['search'])) {
                                $from_date = $_POST['from_date'];
                                $to_date   = $_POST['to_date'];

                                $conn = getConnection();
                                $sql = "SELECT * FROM sales WHERE created_at BETWEEN '$from_date' AND '$to_date' ORDER BY id DESC";
                                $result = $conn->query($sql);
                            }




                            ?>

                            <h4 class="font-weight-bol text-dark">Search Sales Report by Date:</h4>


                            <form method="post">
                                

                                    <div class="col d-flex flex-column flex-md-row bg-light border border-1 rounded">

                                        <div class="col-6 p-2 d-flex  align-items-center">
                                            <span class="font-weight-bold text-dark">From</span>
                                            <input type="date" name="from_date" required id="" class="form-control mr-2 ml-2">
                                            <span class="font-weight-bold text-dark">To</span>

                                        </div>
                                        <div class="col-6 p-2 bor rounded d-flex  align-items-center">
                                            <input type="date" name="to_date" required id="" class="form-control mr-2">
                                            <button type="submit" name="search" class="btn btn-success">Search</button>
                                            <?php if (isset($result)) { ?>
                                                <button class="btn btn-danger ml-1" type="button" onclick="window.location.href='sales_history.php'">Clear</button>
                                            <?php } ?>
                                        </div>

                                    </div>

                                
                            </form>
                            <div class="table-responsive">
                                
                                <?php

                                if (isset($result)) {
                                    echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                <tr>
                                        <th>Invoice No</th>
                                        <th>Fuel Type</th>
                                        <th>Liters</th>
                                        <th>Price</th>
                                        <th>Total Amount</th>
                                        <th>Date Sold</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>';


                                    while ($row = $result->fetch_assoc()) {
                                        $total_liters += $row['ltrSold'];
                                        $total_amount += $row['amount'];


                                        echo "
                                        <tbody>
                                        <tr>
                                            <td>" . $row['invoice_no'] . "</td>
                                            <td>" . $row['fuelType'] . "</td>
                                            <td>" . $row['ltrSold'] . " <span class='text-primary font-weight-bold p-1 rounded'>Ltrs</span></td>
                                            <td>" . $row['unitPrice'] . "</td>
                                            <td><span class='text-primary font-weight-bold p-1 rounded'>$</span>" . $row['amount'] . "</td>
                                            <td>" . $row['created_at'] . "</td>
                                            <td> 
                                                <button class='btn btn-info btn-sm' onclick=\"confirmCreateReceipt('" . $row['invoice_no'] . "')\">Receipt</button>
                                            </td>
                                        </tr>
                                        <tbody>
                                        ";
                                    }
                                ?>
                                    <tr align="center" class="bg-dark text-white font-weight-bold">
                                        <td colspan="2">TOTAL</td>

                                        <td colspan="0"><?= $total_liters ?> ltr</td>
                                        <td></td>
                                        <td>$ <?= $total_amount ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    </table>
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

      function confirmCreateReceipt(invoice_no) {}
        function confirmCreateReceipt(invoice_no) {
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
                        generateReceipt(invoice_no);
                    })
                }
            })
        }


        function generateReceipt(invoice_no) {
            $.ajax({
                url: 'includes/dbManager.php', // Inside this handle receipt creation
                type: 'POST',
                data: {
                    invoice_no: invoice_no,
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