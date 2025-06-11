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

                <!-- alert Update -->
                <!-- Button trigger modal -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Modal new sales-->
                    <div class="modal fade bd-example-modal-lg" id="salesEntryModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <form action="includes/dbManager.php" method="post">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header text-white bg-primary ">
                                        <h5 class="modal-title font-weight-bold" id="salesEntryModal">Pump Record & Sales Calculatoin</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row mb-3 d-flex justify-content-center">
                                            <div class="col d-flex flex-column d-block">
                                                <label for="fuel type" class="font-weight-bold">Select Pump</label>
                                                <select class="custom-select" id="pumpName" name="pumpName" onchange="fetchPumpFuel()" required>
                                                    <option selected>-- Choose --</option>
                                                    <?php
                                                    $pumps = getPumps();
                                                    foreach ($pumps as $pump) {
                                                    ?>
                                                        <option value="<?php echo $pump["pumpID"]; ?>"> <?php echo $pump["pumpName"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="fuel type" class="font-weight-bold">Previous Reading</label>
                                                <input type="text" id="pre_read" oninput="calculateLitersAndAmount()" name="preRead" class="form-control">

                                            </div>
                                            <div class="col d-flex flex-column d-block">
                                                <label for="" class="font-weight-bold">Fuel Type</label>
                                                <!-- <input type="text" name="" id="fuelType1"> -->
                                                <select class="custom-select" id="fuelType" name="fuelType" onchange="fetchPrice()">

                                                    <option selected>-Choose-</option>
                                                    <?php

                                                    $conn = getConnection();
                                                    $query = "SELECT * FROM fuels";
                                                    $result = mysqli_query($conn, $query);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<option value='" . $row['FuelType'] . "'>" . $row['FuelType'] . "</option>";
                                                    }
                                                    ?>
                                                </select>

                                                <label for="fuel type" class="font-weight-bold">Current Reading <span class="text-danger font-weight-light">after sale</span> </label>
                                                <input type="text" id="current_read" oninput="calculateLitersAndAmount()" name="curRead" class="form-control">
                                            </div>

                                            <div class="col d-flex flex-column d-block">
                                                <label for="fuel type" class="font-weight-bold">Today's Price</label>

                                                <input type="text" id="unitPrice" oninput="calculateAmount()" readonly name="unitPrice" class="form-control">

                                                <label for="" class="font-weight-bold">Sold Liters</label>
                                                <input type="text" id="liters_sold" name="LtrSold" readonly class="form-control">

                                            </div>

                                        </div>
                                        <div class="row d-flex ">
                                            <div class="col d-flex flex-column d-block">

                                                <label for="fuel type" class="font-weight-bold">Amount</label>
                                                <input type="text" id="amount" name="amount" readonly class="form-control">


                                            </div>

                                            <div class="col d-flex flex-column">
                                                <label for="fuel type" class=" text-danger"> Assign this pump to Atendent (Shaqaalaha)</label>
                                                <select class="custom-select" name="employeeID" id="">
                                                    <?php
                                                    if (isLogin() == true) {
                                                        $EmployeeID = $_SESSION['EmployeeID'];

                                                        $conn = getConnection();
                                                        $result = $conn->query("SELECT * FROM Employees where EmployeeID='$EmployeeID'");
                                                        $rows = $result->fetch_all(MYSQLI_ASSOC);

                                                        $Employees = $rows;
                                                        foreach ($Employees as $row) {


                                                            echo $row['UserName'];
                                                        }
                                                    }

                                                    ?>
                                                    <option selected>-Choose-</option>
                                                    <option value="<?php echo $row['EmployeeID']; ?>"><?php echo $row['UserName']; ?></option>
                                                </select>

                                                

                                            </div>
                                            
                                        </div>
                                        <div class="row d-flex">
                                            <div class="col d-flex flex-column d-block">

                                                <label for="fuel type" class="font-weight-bold">Select Station</label>
                                                <select class="custom-select" name="stationID" id="">
                                                    <option value="">- choose -</option>
                                                    <?php
                                                    $stations = getStations();
                                                    foreach ($stations as $station) {

                                                    ?>
                                                        <option value="<?php echo $station['StationID']; ?>"><?php echo $station['Name']; ?></option>
                                                    <?php } ?>
                                                </select>

                                                

                                            </div>

                                            <div class="col">
                                                 <label for="customerSelect" class="font-weight-bold">Customers</label>
                                                <div class="input-group">
                                                    <select id="customerSelect" name="customer_id" class="custom-select">
                                                        <option value="">-- Select Customer --</option>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-primary" id="addNewCustomerBtn">
                                                            <i class="fas fa-user-plus"></i> New
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>






                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="addSales" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Add Customer Modal -->
                    <div class="modal fade" id="newCustomerModal" tabindex="-1" role="dialog" aria-labelledby="newCustomerModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="newCustomerModalLabel">Add New Customer</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="newCustomerForm">
                                        <div class="form-group">
                                            <label for="newCustomerName">Customer Name:</label>
                                            <input type="text" class="form-control" id="newCustomerName" name="customerName" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="newCustomerEmail">Email (Optional):</label>
                                            <input type="email" class="form-control" id="newCustomerEmail" name="customerEmail">
                                        </div>
                                        <div class="form-group">
                                            <label for="newCustomerPhone">Phone (Optional):</label>
                                            <input type="text" class="form-control" id="newCustomerPhone" name="customerPhone">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary" id="saveNewCustomerBtn">Save Customer</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--  -->


                    <?php


                    if (isset($_GET['transaction_no'])) {
                        $transaction_no = $_GET['transaction_no'];




                        $conn = getConnection();
                        $result = $conn->query("SELECT transaction_no, fuelType FROM sales where transaction_no='$transaction_no'");
                        $rows = $result->fetch_all(MYSQLI_ASSOC);

                        $Employees = $rows;
                        foreach ($Employees as $row) {


                            echo $row['fuelType'];
                            echo $row['transaction_no'];
                        }
                    }

                    ?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">SALES</h1>
                        <a href="sales_history.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Pump Reading & Sale Calulation</h6>
                            <div class="actions">
                                <div class="dropdown  bg-white ">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu shadow-sm shadow-lg mr-4" aria-labelledby="dropdownMenu2">
                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#salesEntryModal"><i class="fa-solid fa-plus bg-primary text-white p-1 rounded "></i> Add New Sales</a>
                                        <a href="sales_history.php" class="dropdown-item"> <i class="fa-solid fa-clock-rotate-left  bg-primary text-white p-1 rounded"></i> Veiw Sales History</a>
                                        <a href="customer_statement.php" class="dropdown-item"> <i class="fa-solid fa-clock-rotate-left  bg-primary text-white p-1 rounded"></i> Customer Statement</a>

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
                            if (isset($_SESSION['warning'])) {

                            ?>
                                <div class="alert alert-warning d-flex justify-content-between align-items-center" role="alert">
                                    <strong> <?php echo $_SESSION['warning']; ?></strong>
                                </div>
                            <?php

                                unset($_SESSION['warning']);
                            }
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>TRN_NO</th>
                                            <th>Fuel </th>
                                            <th>PumpNo</th>
                                            <th>unitPrice</th>
                                            <th>PreReading (BS)</th>
                                            <th>CurReading (AS)</th>
                                            <th>LtrSold</th>
                                            <th>Amount</th>



                                        </tr>
                                    </thead>
                                    <tfoot class="bg-gray-800 text-white">
                                        <tr>
                                            <th>TRN_NO</th>
                                            <th>Fuel </th>
                                            <th>PumpNo</th>
                                            <th>unitPrice</th>
                                            <th>PreReading (BS)</th>
                                            <th>CurReading (AS)</th>
                                            <th>LtrSold</th>
                                            <th>Amount</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php

                                        $sales = getSales();
                                        foreach ($sales as $sale) {


                                        ?>
                                            <tr>
                                                <td><?php echo $sale['transaction_no']; ?></td>
                                                <td><?php echo $sale['fuelType']; ?></td>
                                                <td><?php echo $sale['pumpNo']; ?></td>
                                                <td><?php echo $sale['unitPrice']; ?></td>
                                                <td><?php echo $sale['preRead']; ?> ltr</td>
                                                <td><?php echo $sale['curRead']; ?> ltr</td>
                                                <td><?php echo $sale['ltrSold']; ?> ltr</td>
                                                <td><span class="text-primary font-weight-bold p-1 rounded"><?php echo $sale['amount']; ?></span></td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">




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
            // fething pumps fueltype
            // function fetchPumpFuel() {
            //     var pumpName = document.getElementById("pumpName").value;


            //     if (pumpName !== "") {
            //         $.ajax({
            //             url: "includes/dbManager.php",
            //             type: "POST",
            //             data: {
            //                 pumpName: pumpName
            //             },
            //             success: function(response) {
            //                 document.getElementById("fuelType").value = response;

            //                 // Call fetchPrice() to get the price for the selected fuel type

            //                 fetchPrice();
            //             }
            //         });
            //     } else {
            //         document.getElementById("fuelType").value = "";
            //     }
            // }

            function fetchPumpFuel() {
                var pumpName = document.getElementById("pumpName").value;

                if (pumpName !== "") {
                    $.ajax({
                        url: "includes/dbManager.php",
                        type: "POST",
                        data: {
                            pumpName: pumpName
                        },
                        success: function(response) {
                            var fuelTypeSelect = document.getElementById("fuelType");

                            for (var i = 0; i < fuelTypeSelect.options.length; i++) {
                                if (fuelTypeSelect.options[i].value === response) {
                                    fuelTypeSelect.selectedIndex = i;
                                    break;
                                }
                            }

                            fetchPrice();
                        }
                    });
                } else {
                    document.getElementById("fuelType").selectedIndex = 0; // Reset to "choose"
                }
            }


            // after gatting pumps fueltype will fetch fuels Price
            function fetchPrice() {
                var fuelType = document.getElementById("fuelType").value;


                if (fuelType !== "") {
                    $.ajax({
                        url: "includes/dbManager.php",
                        type: "POST",
                        data: {
                            fuelType: fuelType
                        },
                        success: function(response) {
                            document.getElementById("unitPrice").value = response;
                        }
                    });
                } else {
                    document.getElementById("unitPrice").value = "";
                }
            }




            // calculating  liter sold
            function calculateLitersAndAmount() {
                var preRead = parseFloat(document.getElementById('pre_read').value) || 0;
                var currentRead = parseFloat(document.getElementById('current_read').value) || 0;

                var litersSold = currentRead - preRead;

                if (litersSold >= 0) {
                    document.getElementById('liters_sold').value = litersSold;
                } else {
                    document.getElementById('liters_sold').value = 0;
                }

                calculateAmount(); // auto update amount when reading changes
            }

            // after getting liter sold will calculate amount by unitPrice
            function calculateAmount() {
                var litersSold = parseFloat(document.getElementById('liters_sold').value) || 0;
                var fuelPrice = parseFloat(document.getElementById('unitPrice').value) || 0;

                var amount = litersSold * fuelPrice;

                document.getElementById('amount').value = amount.toFixed(2);
            }
        </script>



        <script>
            $(document).ready(function() {

                //  Reopen sales modal and load customers if flag is set
                if (localStorage.getItem('showSalesModal') === 'true') {
                    localStorage.removeItem('showSalesModal'); // Clear the flag

                    // Manually load customers first
                    loadCustomers('customerSelect');

                    // Then show the modal
                    $('#salesEntryModal').modal('show');
                }

                // Make sure this is inside your $(document).ready(function() { ... }); block
                console.log("Document ready - JavaScript loaded.");

                function loadCustomers(selectElementId, selectedCustomerId = null) {
                    const $select = $(`#${selectElementId}`);
                    $select.empty().append('<option value="">-- Select Customer --</option>'); // Clear previous options

                    $.ajax({
                        url: 'includes/api.php?action=getCustomers', // Call the API to get all customers
                        method: 'GET',
                        dataType: 'json', // Expect JSON back
                        success: function(customers) {
                            if (customers && customers.length > 0) {
                                customers.forEach(customer => {
                                    $select.append(`<option value="${customer.id}">${customer.name}</option>`);
                                });
                                // If a customer ID was passed (e.g., a newly added one), select it
                                if (selectedCustomerId) {
                                    $select.val(selectedCustomerId);
                                }
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching customers:", status, error);
                            alert("Failed to load customers. Please check your network and try again.");
                        }
                    });
                }


                $('#salesEntryModal').on('show.bs.modal', function(e) {
                    // This runs when the main sales modal is about to be shown
                    loadCustomers('customerSelect'); // Load customers into the dropdown
                });


                $('#addNewCustomerBtn').on('click', function() {
                    // 1. Hide the sales entry modal first
                    $('#salesEntryModal').modal('hide');

                    // 2. Clear any old data from the new customer form
                    $('#newCustomerForm')[0].reset();

                    // 3. Show the new customer modal
                    $('#newCustomerModal').modal('show');
                });

                // Make sure this is inside your $(document).ready(function() { ... }); block

                $('#saveNewCustomerBtn').on('click', function() {
                    const customerName = $('#newCustomerName').val().trim();
                    const customerEmail = $('#newCustomerEmail').val().trim();
                    const customerPhone = $('#newCustomerPhone').val().trim();

                    if (customerName === '') {
                        alert('Customer Name is required!');
                        return;
                    }

                    // AJAX call to save the new customer using your api.php
                    $.ajax({
                        url: 'includes/api.php', // Your API endpoint
                        method: 'POST',
                        data: {
                            action: 'addNewCustomer', // Tell PHP what action to perform
                            customerName: customerName,
                            customerEmail: customerEmail,
                            customerPhone: customerPhone
                        },
                        dataType: 'json', // Expect JSON response from PHP
                        success: function(response) {
                            if (response.success) {

                                alert(response.message);

                                // Set a flag before reload
                                localStorage.setItem('showSalesModal', 'true');
                                location.reload(); // Now reload

                                // 1. Close the new customer modal
                                $('#newCustomerModal').modal('hide');

                                // 2. Re-load customers in the sales dropdown, and pre-select the one just added
                                loadCustomers('customerSelect', response.customerId);

                                // 3. Show the sales entry modal again
                                $('#salesEntryModal').modal('show');
                            } else {
                                alert('Error adding customer: ' + response.message);
                                // If there's an error, still show the sales modal so they can continue or retry
                                $('#salesEntryModal').modal('show');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error adding customer:", status, error);
                            alert('A network error occurred while adding the customer. Please try again.');
                            // Always show the sales modal on any error
                            $('#newCustomerModal').modal('hide');
                            $('#salesEntryModal').modal('show');
                        }
                    });
                });


            });
        </script>

        <?php
        include("view/partials/footer.php");
        ?>



</body>

</html>