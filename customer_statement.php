<?php

use Vtiful\Kernel\Format;

include("view/partials/head.php");
include("includes/dbManager.php");
checkLogin();
if (isLogin() == false) {
    header("location:login.php");
}
?>

<style>
    @media print {

        /* Hide unnecessary UI elements */
        .header,
        .search-filters,
        .actions-dropdown,
        .pagination,
        .delete-button {
            display: none !important;
        }

        /* Adjust table for printing */
        body {
            margin: 0;
            padding: 0;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .data-table tfoot {
            font-weight: bold;
        }

        /* Ensure table breaks correctly across pages */
        .data-table tbody tr {
            page-break-inside: avoid;
        }
    }
</style>

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

                    <!-- alert delete -->
                    <div class="modal  alertDelete fade" tabindex="-1">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <form action="includes/dbManager.php" method="post">
                                    <input type="hidden" value="" name="id" id="id" class="form-control">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title font-weight-bold ">Delete Fuel Order</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>


                                    <div class="modal-body">
                                        <p> Do you want to <span class="text-danger">delete</span> this data! please confirm.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="deleteFuelOrder" class="btn btn-danger">Yes ! Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Page Heading -->
                    <div
                        class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Customer Report</h1>
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
                                        <a href="customers.php" class="dropdown-item"> <i class='fa-solid fa-clock-rotate-left  bg-primary text-white p-1 rounded'></i> Customers</a>

                                    </div>
                                </div>

                            </div>
                        </div>




                        <div class="card-body">


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

                            <?php
                            $total_liters = 0;
                            $total_amount = 0;

                            if (isset($_POST['search'])) {
                                $from_date = $_POST['from_date'];
                                $to_date   = $_POST['to_date'];
                                $customer_id  = $_POST['customer_id'];

                                $conn = getConnection();
                                $sql = "SELECT
                                            s.customer_id,
                                            c.first_name,
                                            s.transaction_no,
                                            s.fuelType,
                                            s.unitPrice,
                                            s.ltrSold,
                                            s.amount,
                                            s.sales_ref,
                                            s.tax,
                                            s.payment_method,
                                            s.created_at
                                        FROM
                                            sales s
                                        INNER JOIN customers c ON s.customer_id = c.customer_id
                                        WHERE
                                            s.created_at BETWEEN '$from_date' AND '$to_date'
                                            AND s.customer_id = '$customer_id'
                                        ORDER BY
                                            s.id DESC;";
                                $result = $conn->query($sql);
                            }

                            ?>

                            <h4 class="font-weight-bol text-dark">Search Order Report by Date:</h4>


                            <form method="post">
                                <div class="col d-flex flex-column flex-md-row mb-2 bg-light border border-1 rounded">
                                    
                                    <div class="col-6 p-2 d-flex  align-items-center">
                                        <select class="custom-select mr-2" name="customer_id" id="">
                                            <option selected disabled>Choose Customer</option>
                                            <?php
                                            $customers = getCustomers();
                                            foreach ($customers as $customer) {
                                            ?>
                                                <option value="<?php echo $customer["customer_id"] ?>"> <?php echo $customer["first_name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <span class="font-weight-bold text-dark">From</span>
                                        <input type="date" value="<?php echo isset($_POST['from_date']) ? $_POST['from_date'] : ''; ?>" name="from_date" required id="" class="form-control mr-2 ml-2">
                                        <span class="font-weight-bold text-dark">To</span>

                                    </div>
                                    <div class="col-6 p-2 bor rounded d-flex  align-items-center">
                                        <input type="date" id="fromDateInput" value="<?php echo isset($_POST['to_date']) ? $_POST['to_date'] : ''; ?>" name="to_date" required id="" class="form-control mr-2">
                                        <button type="submit" name="search" class="btn btn-success">Search</button>
                                        <?php if (isset($result)) { ?>
                                            <button class="btn btn-danger ml-1" type="button" onclick="window.location.href='customer_statement.php'">Clear</button>
                                        <?php } ?>
                                    </div>

                                </div>


                            </form>
                            <div class="table-responsive">
                                <button class=" btn btn-primary mb-2 print_report">Print</button>
                                <div id="dataTableWrapper">
                                    <table class="table data_table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>TRS_NO</th>
                                                <th>Fuel Type</th>
                                                <th>Liter Sold</th>
                                                <th>unite Price</th>
                                                <th>Amount</th>
                                                <th>Sales Ref</th>
                                                <th>Created At</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            if (isset($result)) {
                                                echo '
                                ';


                                                while ($row = $result->fetch_assoc()) {
                                                    $total_liters += $row['ltrSold'];
                                                    $total_amount += $row['amount'];


                                                    echo "
                                        
                                        <tr>
                                        
                                            <td class='id'>" . $row['customer_id'] . "</td>
                                            <td id='customer_name'>" . $row['first_name'] . "</td>
                                            <td>" . $row['transaction_no'] . "</td>
                                            <td>" . $row['fuelType'] . " </td>
                                            <td>" . $row['ltrSold'] . " <span class='text-primary font-weight-bold p-1 rounded'>Ltrs</span></td>
                                            <td><span class='text-primary font-weight-bold p-1 rounded'>$</span>" . $row['unitPrice'] . "</td>
                                            <td><span class='text-primary font-weight-bold p-1 rounded'>$</span>" . $row['amount'] . "</td>
                                            <td>" . $row['sales_ref'] . "</td>
                                            <td>" . date('d-m-Y', strtotime($row['created_at'])) . "</td>
                                            <td> <button class='btn btn-danger btn-sm deleteFuelOrder'>Delete</button> </td>
                                            
                                        </tr>
                                        ";
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr align="center" class="bg-dark text-white font-weight-bold">
                                                <td colspan="0">TOTAL</td>
                                                <td></td>
                                                <td></td>
                                                <td><?= $total_liters ?> ltr</td>
                                                <td></td>
                                                <td></td>
                                                <td>$ <?= $total_amount ?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>

                                    <?php }
                                    ?>

                                    </table>
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




    <script>
        document.querySelector('.print_report').addEventListener('click', function() {
            // Get the current table HTML (excluding the Delete column and interactive elements)
            let tableHtml = document.querySelector('.data_table').outerHTML;

            // Create a temporary div to manipulate the HTML
            let tempDiv = document.createElement('div');
            tempDiv.innerHTML = tableHtml;

            const fromDateInput = document.querySelector('input[name="from_date"]');
            const toDateInput = document.querySelector('input[name="to_date"]');


            const fromDate = fromDateInput ? fromDateInput.value : '';
            const toDate = toDateInput ? toDateInput.value : '';

            // Format for display (ensures "N/A" only if no date is selected)
            const displayFromDate = fromDate || 'N/A';
            const displayToDate = toDate || 'N/A';
            
            console.log(displayFromDate, displayToDate);

            // Remove the 'Action' column (Delete button) from the temporary table
            tempDiv.querySelectorAll('th:last-child, td:last-child').forEach(el => el.remove());
            tempDiv.querySelectorAll('th:first-child, td:first-child').forEach(el => el.remove());
            // This is not correct. There is no valid CSS selector 'th:third-child' or 'td:third-child'.
            // To remove the third column, use :nth-child(3):

            tempDiv.querySelectorAll('th:nth-child(1), td:nth-child(1)').forEach(el => el.remove());

            // Construct the full HTML for the print window
            let printContent = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Fuel Sales Report</title>
            <link rel="stylesheet" href="path/to/your/main.css"> <style>
                /* Include the print-specific CSS here or link a dedicated print.css */
                @media print {
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    h1 { text-align: center; margin-bottom: 20px; }
                    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                    th { background-color: #f2f2f2; }
                    tfoot { font-weight: bold; background-color: #e0e0e0; }
                    .header { margin-bottom: 20px; }
                    .header h4, .header p { margin: 0; }
                    .header p { font-size: 14px; }
                    .text-center { text-align: center; }
                    .font-weight-bold { font-weight: bold; }
                }
                        </style>
                    </head>
                    <body>
                        <h1>Fuel Sales Report</h1>
                        <div class="header text-center">
                            <h4>Fuel Management System</h4>
                            <p>86 Main St.</p>
                            <p>Gacayte, MainVT2045</p>
                            <p>+252907796534</p>
                        </div>
                        <h4>Customer: ${document.querySelector('#customer_name').textContent}</h4>

                          <h4>Date Range: ${displayFromDate} - ${displayToDate}</h4>
                        ${tempDiv.innerHTML}
                    </body>
                    </html>
                `;

            // Open a new window and write the content
            let printWindow = window.open('', '_blank');
            printWindow.document.write(printContent);
            printWindow.document.close(); // Close the document to ensure content is rendered

            // Trigger print dialog after content is loaded
            printWindow.onload = function() {
                printWindow.print();
            };
        });

        // 1. Confirm Alert -> 2. Loading -> 3. No Redirect -> 4. Auto Run generateReceipt() -> 5. Auto Show Modal

        // 1. Confirm Alert

        // function confirmCreateReceipt(invoice_no) {
        // Swal.fire({
        // title: 'Are you sure?',
        // text: "Do you want to create a new receipt?",
        // icon: 'question',
        // showCancelButton: true,
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
        // confirmButtonText: 'Yes, Create it!'
        // }).then((result) => {
        // if (result.isConfirmed) {
        // // 2. Loading
        // // 3. No Redirect
        // Swal.fire({
        // title: 'Creating...',
        // text: 'Please wait...',
        // timer: 1000,
        // didOpen: () => {
        // Swal.showLoading()
        // }
        // }).then(() => {
        // // Directly run generateReceipt()
        // generateReceipt(invoice_no);
        // })
        // }
        // })
        // }

        // delete fuel order
        $(document).ready(function() {
            $('.deleteFuelOrder').click(function(e) {
                e.preventDefault();

                var id = $(this).closest('tr').find('.id').text();

                // console.log(fuelType);

                $('#id').val(id);
                $('.alertDelete').modal('show');


            });
        });

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




</body>

</html>