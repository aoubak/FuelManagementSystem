<?php
// header("Refresh:0");
include("view/partials/head.php");
include("includes/dbManager.php");

checkLogin();
if (isLogin() == false) {
    header("location:login.php");
}
if (!isset($_GET['transaction_no'])) {
    // If 'transaction_no' not found in URL
    header("Location:sales.php");
    exit();
}


// if (isset($_SESSION['refresh_payment'])) {
//     unset($_SESSION['refresh_payment']);
//     echo "<script>location.reload();</script>";
// }
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
                    <div class="modal fade bd-example-modal-lg" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <form action="includes/dbManager.php" method="post">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header text-white bg-primary ">
                                        <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Pump Record & Sales Calculatoin</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row mb-3 d-flex justify-content-center">
                                            <div class="col d-flex flex-column d-block">
                                                <label for="fuel type" class="font-weight-bold">Select Pump</label>
                                                <select class="custom-select" name="pumpName" id="">
                                                    <?php
                                                    $pumps = getPumps();
                                                    foreach ($pumps as $pump) {
                                                    ?>
                                                        <option value="<?php echo $pump["pumpName"]; ?>"> <?php echo $pump["pumpName"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="fuel type" class="font-weight-bold">Previous Reading</label>
                                                <input type="text" id="pre_read" oninput="calculateLitersAndAmount()" name="preRead" class="form-control">

                                            </div>
                                            <div class="col d-flex flex-column d-block">
                                                <label for="" class="font-weight-bold">Fuel Type</label>

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

                                                <label for="fuel type" class="font-weight-bold">Current Reading</label>
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
                                                <label for="fuel type" class="font-weight- text-danger"> Assign this pump to Atendent (Shaqaalaha)</label>
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

                    <!--  -->


                    <?php


                    if (isset($_GET['transaction_no'])) {
                        $transaction_no = $_GET['transaction_no'];




                        $conn = getConnection();
                        $result = $conn->query("SELECT transaction_no, fuelType FROM sales where transaction_no='$transaction_no'");
                        $rows = $result->fetch_all(MYSQLI_ASSOC);

                        $Employees = $rows;
                        foreach ($Employees as $row) {


                          
                        }
                    }

                    ?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Payment Info</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 bg-primary   d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-white">Payment and Invoice</h6>
                            <!-- <div class="actions">
                                <div class="dropdown  bg-white ">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu shadow-sm shadow-lg mr-4" aria-labelledby="dropdownMenu2">
                                        <a href="sales.php" class="dropdown-item"><i class="fa-solid fa-plus bg-primary text-white p-1 rounded "></i> Add New Sales</a>
                                        <a href="sales_history.php" class="dropdown-item"> <i class="fa-solid fa-clock-rotate-left  bg-primary text-white p-1 rounded"></i> Veiw Sales History</a>

                                    </div>
                                </div>

                            </div> -->
                        </div>


                        <div class="card-body">
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
                            <form action="includes/dbManager.php" method="post">


                                <input type="hidden" name="tran_no" value="<?php echo $row['transaction_no']; ?>" readonly>
                                <?php 
                               
                                    // $trasn_No = $_GET['transaction_no'];
                                    if($row['transaction_no'] = "" ){
                                        header("location:../sales.php");
                                    }
                                
                                ?>
                                <div class="row mb-3 d-flex justify-content-center">
                                    <div class="col d-flex flex-column d-block">
                                        <label for="fuel type" class="font-weight-bold">Payment Method</label>
                                        <select class="custom-select" name="paymentMethod" id="">
                                            <option selected> -choose-</option>
                                            <option value="Cash"> Cash</option>
                                            <option value="Card"> Card</option>
                                            <option value="Mobile"> Mobile</option>
                                        </select>
                                        <label for="fuel type" class="font-weight-bold">Tax Rate %</label>
                                        <input type="text" id="pre_read" name="tax" class="form-control">

                                    </div>
                                    <div class="col d-flex flex-column d-block">
                                        <label for="" class="font-weight-bold">Entery Method</label>

                                        <select class="custom-select" id="fuelType" name="enteryMethod">

                                            <option selected>-Choose-</option>
                                            <option value="Swiped">Swiped</option>
                                            <option value="Inserted">Inserted</option>
                                            <option value="Manual">Manual</option>

                                        </select>

                                        <label for="sales type" class="font-weight-bold">Sales Type</label>
                                        <?php
                                      

                                        $newInvoice = getNewInvoice();
                                        ?>
                                        <select class="custom-select" name="salesType" id="">
                                            <option value="<?php echo $newInvoice; ?>" > Invoice</option>
                                            <option value="Cash"> Cash</option>
                                        </select>
                                        <!-- <input type="text" value="<?php echo $newInvoice; ?>" name="invoiceNo" readonly class="form-control text-danger"> -->
                                    </div>



                                </div>

                                <div class="row">
                                    <div class="col-12 modal-footer">
                                        <button type="submit" name="addPaymentInfo" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>








                            </form>
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



        <?php
        include("view/partials/footer.php");
        ?>



</body>

</html>