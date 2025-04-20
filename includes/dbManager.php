<?php
session_start();

// get connection
function getConnection(
    $host = "localhost",
    $user = "root",
    $password = "",
    $databasename = "fms"
) {
    $conn = new mysqli($host, $user, $password, $databasename);
    if ($conn->connect_error) {
        echo "Error connecting to Database. $conn->connect_error with error: $conn->connect_error ";
        return false;
    }
    return $conn;
}

// login aouthentication ---------------------------
function checkLogin()
{
    if (isset($_SESSION['EmployeeID']) == False) {
        header("location:login.php");
        exit();
    }
}


function isLogin()
{
    return isset($_SESSION['EmployeeID']);
}



// login aouthentication end ----------------------

// add station
if (isset($_POST['addStation'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $contactNumber = $_POST['contactNumber'];


    $conn = getConnection();
    $result = $conn->query("INSERT INTO stations (name,location,contactNumber) VALUES('$name','$location','$contactNumber')");
    if ($result) {
        $_SESSION['status'] = "Data inserted successfully";
        header("location:../stations.php");
    }
    $conn->close();
    $result->close();
}

// fetch Stations
function getStations()
{
    $conn = getConnection();
    $result = $conn->query("SELECT * FROM Stations");
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    if ($rows) {
    }
    $conn->close();
    $result->close();
    return $rows;
}

if (isset($_POST['upStationStatus'])) {
    $stationID = $_POST['stationID'];
    $status = $_POST['status'];

    $conn = getConnection();
    $result = $conn->query("UPDATE stations SET status = '$status' WHERE StationID = $stationID");

    if ($result) {
        $_SESSION['status'] = "Status updated successfully";
        header("location:../stations.php");
    }
    $conn->close();
    $result->close();
}
// update status Sesion view fucntion with JQuery
if (isset($_POST['updateStationStatus'])) {
    $stationID = $_POST['StationID'];

    $conn = getConnection();
    $result = $conn->query("SELECT StationID, Status FROM Stations WHERE StationID = $stationID");
    $rows = $result->fetch_all(MYSQLI_ASSOC);

?>

    <?php
    foreach ($rows as $row) {
    ?>
        <input type="hidden" name="stationID" class="form-control" name="stationStatus" id="" value=" <?php echo $row['StationID']; ?> ">

        <?php
        if ($row['Status'] == 0) {
            echo '
            <div class="row d-flex justify-content-center ">
            <div class="col d-flex flex-column d-block ViewStationStatus">
            
            <label for="fuel type" class="font-weight-bold">Current Status: </label>
                    <button class="btn btn-danger "> In Active </button>
                </div>

                 <div class="col d-flex flex-column d-block ViewStationStatus">
                     <label for="fuel type" class="font-weight-bold">Update Status</label>
                        <select name="status" class="custom-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>Choose...</option>
                            <option value="1">Active</option>
                            <option value="0">In Active</option>
                        </select>
                </div>
                </div> ';
        }
        if ($row['Status'] == 1) {
            echo '
            <div class="row d-flex justify-content-center ">
            <div class="col d-flex flex-column d-block ViewStationStatus">
            <label for="fuel type" class="font-weight-bold">Current Status: </label>
                    <button class="btn btn-success ">Active </button>
                </div>

                 <div class="col d-flex flex-column d-block ViewStationStatus">
                     <label for="fuel type" class="font-weight-bold">Update Status</label>
                        <select name="status" class="custom-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>Choose...</option>
                            <option value="1">Active</option>
                            <option value="0">In Active</option>
                        </select>
                </div>
                </div> ';
        }


        ?>

    <?php  }
    ?>

    <?php

}

// delete Station

if (isset($_POST['deleteStation'])) {
    $stationID = $_POST['StationID'];

    $conn = getConnection();
    $result = $conn->query("DELETE FROM Stations WHERE StationID = $stationID");
    if ($result) {
        $_SESSION['delete'] = "Station deleted successfully";
        header("location:../stations.php");
    }
    $conn->close();
    $result->close();
}

// update station process  
if (isset($_POST['updateStation'])) {
    $stationID = $_POST['StationID'];

    $conn = getConnection();
    $result = $conn->query("SELECT * FROM Stations where StationID = $stationID");
    $rows = $result->fetch_all(MYSQLI_ASSOC);


    foreach ($rows as $row) {
    ?>


        <form action="includes/dbManager.php" method="post">
            <input type="hidden" value="<?php echo $row['StationID']; ?>" name="StationID" id="StationID" class="form-control">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold ">Update Station</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <div class="row d-flex justify-content-center">
                    <div class="col d-flex flex-column d-block">
                        <label for="fuel type" class="font-weight-bold">Station name</label>
                        <input type="text" name="name" value="<?php echo $row['Name']; ?>" class="form-control">
                        <label for="fuel type" class="font-weight-bold">Location</label>
                        <input type="text" name="location" value="<?php echo $row['Location']; ?>" class="form-control">
                    </div>
                    <div class="col d-flex flex-column d-block">

                        <label for="" class="font-weight-bold">Contact numer</label>
                        <input type="text" name="contactNumber" value="<?php echo $row['ContactNumber']; ?>" class="form-control" aria-label=".cost">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="updateStationBtn" class="btn btn-primary">Update</button>
            </div>
        </form>





    <?php }
    ?>

<?php
    // if ($result) {
    //     header("location:../stations.php");
    // }
    // $conn->close();
    // $result->close();
}

if (isset($_POST['updateStationBtn'])) {
    $stationID = $_POST['StationID'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $contactNumber = $_POST['contactNumber'];

    $conn = getConnection();
    $result = $conn->query("UPDATE `stations` SET `Name` = '$name', `Location` = '$location' , `ContactNumber` = '$contactNumber' WHERE `stations`.`StationID` = $stationID");

    if ($result) {
        $_SESSION['status'] = "Station updated successfully";
        header("location:../stations.php");
    } else {

        echo "Station not upadted";
    }
    $conn->close();
    $result->close();
}





// add Employee
if (isset($_POST['addEmployee'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password =  $_POST['password'];
    $stationID = $_POST['staion'];
    $role = $_POST['role'];
    $sex = $_POST['sex'];
    $contactNumber = $_POST['contactNumber'];

    $conn = getConnection();
    $checkMail = $conn->query("SELECT Email FROM Employees WHERE Email = '$email'");
    if ($checkMail->num_rows > 0) {
        $_SESSION['checkMail'] = 'Sorry... Email is already registred! Please try again!';
        header("location:../Employees.php");
    } else {
        $result = $conn->query("INSERT INTO employees (Name,Email,UserName,ContactNumber,Password,StationID,Role,sex) VALUES('$name','$email','$username',$contactNumber,$password,'$stationID','$role','$sex')");
        if ($result) {
            $_SESSION['status'] = "Employee inserted successfully";
            header("location:../Employees.php");
        }
        $conn->close();
        $result->close();
    }
}

// add new fuel 

if (isset($_POST['addNewFuel'])) {
    $fuelType = $_POST['fuelType'];
    $unitPrice = $_POST['unitPrice'];
    $availableLiters = $_POST['availableLiters'];

    $conn = getConnection();
    $checkfuel = $conn->query("SELECT FuelType FROM fuels WHERE FuelType = '$fuelType'");
    if ($checkfuel->num_rows > 0) {
        $_SESSION['checkfuel'] = 'Sorry... Fuel is already registred! Please try again!';
        header("location:../fuel.php");
    } else {
        $result = $conn->query("INSERT INTO `fuels` (`FuelType`, `UnitPrice`, `AvailableLiters`) VALUES ('$fuelType', '$unitPrice', '$availableLiters')");
        if ($result) {
            $_SESSION['status'] = "Fuel inserted successfully";
            header("location:../fuel.php");
        }
    }
    $conn->close();
    $result->close();
}

// update fuel prices

if (isset($_POST['updateFuelPrice'])) {
    $diesel = $_POST['diesel'];
    $petrol = $_POST['petrol'];
    $gas = $_POST['gas'];
    $kerosene = $_POST['kerosene'];

    $conn = getConnection();
    $result = $conn->query("UPDATE fuels
    SET UnitPrice = CASE 
        WHEN FuelType = 'Diesel' THEN $diesel
        WHEN FuelType = 'Petrol' THEN $petrol
        WHEN FuelType = 'Gas' THEN $gas
        WHEN FuelType = 'Kerosene' THEN $kerosene
    END
    WHERE FuelType IN ('Diesel', 'Petrol', 'Gas', 'Kerosene');");
    if ($result) {
        $_SESSION['status'] = "Fuel Price updated successfully";
        header("location:../index.php");
    }
    $conn->close();
    $result->close();
}

// insert into the sales and update litters


// Update fuels with jquery

if (isset($_POST['updateFuelPro'])) {
    $FuelID = $_POST['FuelID'];

    $conn = getConnection();
    $result = $conn->query("SELECT * FROM Fuels WHERE FuelID = $FuelID");
    $rows = $result->fetch_all(MYSQLI_ASSOC);

?>

    <?php
    foreach ($rows as $row) {
    ?>
        <input type="HIDDEN" name="FuelID" class="form-control" name="FuelStatus" id="" value=" <?php echo $row['FuelID']; ?> ">

        <div class="row d-flex justify-content-center">
            <div class="col d-flex flex-column d-block">
                <label for="fuel type" class="font-weight-bold">Select Fuel Type</label>
                <select name="fuelType" class="custom-select form-select-sm" aria-label=".form-select-sm example">
                    <option value="<?php echo $row['FuelType']; ?>"><?php echo $row['FuelType']; ?></option>

                </select>


            </div>
            <div class="col d-flex flex-column d-block">
                <label for="fuel type" class="font-weight-bold">Unit Price</label>
                <input type="text" value="<?php echo $row['UnitPrice']; ?>" name="unitPrice" class="form-control">
            </div>
        </div>

        <div class="row d-flex ">
            <div class="col d-flex flex-column">
                <label for="" class="font-weight-bold">Available Liters</label>
                <input type="text" value="<?php echo $row['AvailableLiters']; ?>" name="availableLiters" class="form-control" aria-label=".cost">
            </div>

        </div>


    <?php  }
    ?>

<?php

}

// update fuel

if (isset($_POST['updateFuel'])) {
    $FuelID = $_POST['FuelID'];
    $fuelType = $_POST['fuelType'];
    $unitPrice = $_POST['unitPrice'];
    $availableLiters = $_POST['availableLiters'];

    $conn = getConnection();
    $result = $conn->query("UPDATE fuels SET FuelType = '$fuelType', UnitPrice = '$unitPrice', AvailableLiters = '$availableLiters'  WHERE FuelID = $FuelID");

    if ($result) {
        $_SESSION['status'] = "Status updated successfully";
        header("location:../fuel.php");
    }
    $conn->close();
    $result->close();
}


// update status fuels with jqeury

if (isset($_POST['updateFuelStatus'])) {
    $FuelID = $_POST['FuelID'];

    $conn = getConnection();
    $result = $conn->query("SELECT FuelID, Status FROM Fuels WHERE FuelID = $FuelID");
    $rows = $result->fetch_all(MYSQLI_ASSOC);

?>
    <!-- <label for="fuel type" class="font-weight-bold">Station Status: </label> -->

    <?php
    foreach ($rows as $row) {
    ?>
        <input type="hidden" name="FuelID" class="form-control" name="FuelStatus" id="" value=" <?php echo $row['FuelID']; ?> ">

        <?php
        if ($row['Status'] == 0) {
            echo '
            <div class="row d-flex justify-content-center ">
            <div class="col d-flex flex-column d-block ViewStationStatus">
            
            <label for="fuel type" class="font-weight-bold">Current Status: </label>
                    <button class="btn btn-danger "> In Active </button>
                </div>

                 <div class="col d-flex flex-column d-block ViewStationStatus">
                     <label for="fuel type" class="font-weight-bold">Update Status</label>
                        <select name="status" class="custom-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>Choose...</option>
                            <option value="1">Active</option>
                            <option value="0">In Active</option>
                        </select>
                </div>
                </div> ';
        }
        if ($row['Status'] == 1) {
            echo '
            <div class="row d-flex justify-content-center ">
            <div class="col d-flex flex-column d-block ViewStationStatus">
            <label for="fuel type" class="font-weight-bold">Current Status: </label>
                    <button class="btn btn-success ">Active </button>
                </div>

                 <div class="col d-flex flex-column d-block ViewStationStatus">
                     <label for="fuel type" class="font-weight-bold">Update Status</label>
                        <select name="status" class="custom-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>Choose...</option>
                            <option value="1">Active</option>
                            <option value="0">In Active</option>
                        </select>
                </div>
                </div> ';
        }


        ?>

    <?php  }
    ?>

    <?php

}

// last step update status fuels with jqeury
if (isset($_POST['upFuelStatus'])) {
    $FuelID = $_POST['FuelID'];
    $status = $_POST['status'];

    $conn = getConnection();
    $result = $conn->query("UPDATE fuels SET status = '$status' WHERE FuelID = $FuelID");

    if ($result) {
        $_SESSION['status'] = "Status updated successfully";
        header("location:../fuel.php");
    }
    $conn->close();
    $result->close();
}

// delete fuel
if (isset($_POST['deleteFuel'])) {
    $FuelID = $_POST['FuelID'];

    $conn = getConnection();
    $result = $conn->query("DELETE FROM Fuels WHERE FuelID = $FuelID");
    if ($result) {
        $_SESSION['delete'] = "Fuel deleted successfully";
        header("location:../Fuel.php");
    }
    $conn->close();
    $result->close();
}

// select all fuels
function getFuels()
{
    $conn = getConnection();
    $result = $conn->query("SELECT * FROM fuels");
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    if ($result->num_rows > 0) {
    }
    if ($rows) {
    } else {
        echo "No data available in table!";
    }
    $conn->close();
    $result->close();
    return $rows;
}

function getPetrol()
{
    $conn = getConnection();
    $result = $conn->query("SELECT FuelID, FuelType, SUM(AvailableLiters) AS 'TotalLiterSupplied', ( UnitPrice * SUM(AvailableLiters) ) AS 'Cost', Supplier,`Date` FROM `fuels` WHERE FuelType = 'Petrol' GROUP BY FuelID,FuelType, UnitPrice, Supplier,`Date`");
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    if ($result) {
    }
    $conn->close();
    $result->close();
    return $rows;
}

function getDeisel()
{
    $conn = getConnection();
    $result = $conn->query("SELECT FuelID, FuelType, SUM(AvailableLiters) AS 'TotalLiterSupplied', ( UnitPrice * SUM(AvailableLiters) ) AS 'Cost', Supplier,`Date` FROM `fuels` WHERE FuelType = 'Deisel' GROUP BY FuelID,FuelType, UnitPrice, Supplier,`Date`");
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    if ($result) {
    }
    $conn->close();
    $result->close();
    return $rows;
}



// select all employeess

function getEmployees()
{
    $conn = getConnection();
    $result = $conn->query("SELECT * FROM Employees");
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    if ($rows) {
    }
    $conn->close();
    $result->close();
    return $rows;
}


// add pumps

if (isset($_POST['addPump'])) {
    $pumpName = $_POST['pumpName'];
    $pumpDesc = $_POST['pumpDesc'];
    $stationID =  $_POST['stationID'];
    $fuelID = $_POST['fuelID'];


    $conn = getConnection();

    $result = $conn->query("INSERT INTO pumps (`pumpName`,`pumpDesc`,`fuelID`,`stationID`) VALUES('$pumpName','$pumpDesc','$stationID','$fuelID')");
    if ($result) {
        $_SESSION['status'] = "Pump inserted successfully";
        header("location:../Pumps.php");
    }
    $conn->close();
    $result->close();
}



function getPumps()
{
    $conn = getConnection();
    $result = $conn->query("SELECT * FROM pumps");
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    if ($rows) {
    }
    $conn->close();
    $result->close();
    return $rows;
}

// fetch Fuel price


if (isset($_POST['fuelType'])) {
    $conn =  getConnection();
    $fuelType = $_POST['fuelType'];
    $query = "SELECT UnitPrice FROM fuels WHERE FuelType = '$fuelType'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        echo $row['UnitPrice'];
    } else {
        echo "0";
    }
}

function getNewInvoice()
{
    $conn = getConnection();
    $result = $conn->query("SELECT invoice_no FROM sales ORDER BY id DESC LIMIT 1,1");
    $lastInvoice = $result->fetch_all(MYSQLI_ASSOC);

    if (!empty($lastInvoice) && !empty($lastInvoice[0]['invoice_no'])) {
        $lastNumber = $lastInvoice[0]['invoice_no'];  // example: INV-000145
        $number = (int) str_replace('INV-', '', $lastNumber); // Remove INV- and convert to int
        $newInvoice = 'INV-' . str_pad($number + 1, 6, '0', STR_PAD_LEFT);
    } else {
        $newInvoice = 'INV-000001';  // first invoice if no record found
    }

    return $newInvoice;
}


// isert sales table
if (isset($_POST['deleteFuel'])) {
    $FuelID = $_POST['FuelID'];

    $conn = getConnection();
    $result = $conn->query("DELETE FROM Fuels WHERE FuelID = $FuelID");
    if ($result) {
        $_SESSION['delete'] = "Fuel deleted successfully";
        header("location:../Fuel.php");
    }
    $conn->close();
    $result->close();
}


// Auto generate unique transaction code
function generateTransCode()
{
    $prefix = "GMS-";  // Transaction Prefix
    $code = mt_rand(100000, 999999);  // Random 6 digits
    $trans_code = $prefix . $code;
    $conn = getConnection();

    $sql = "SELECT COUNT(*) AS total FROM sales WHERE transaction_no = '$trans_code'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row['total'] > 0) {
        // If code exists → regenerate again
        return generateTransCode();
    }
    return $trans_code;
}





if (isset($_POST['addSales'])) {
    $conn = getConnection();

    $transaction_no = $trans_code = generateTransCode();

    $employeeID = $_POST['employeeID'];
    $stationID = $_POST['stationID'];
    $fuelType = $_POST['fuelType'];
    $pumpNo = $_POST['pumpName'];
    $unitPrice = $_POST['unitPrice'];
    $preRead = $_POST['preRead'];
    $curRead = $_POST['curRead'];
    $soldLtr = $_POST['LtrSold'];
    $amount = $_POST['amount'];

    // Check Available Fuel liters.
    $checkFuel = mysqli_query($conn, "SELECT AvailableLiters FROM fuels WHERE FuelType='$fuelType'");
    $row = mysqli_fetch_assoc($checkFuel);

    if ($row['AvailableLiters'] >= $soldLtr) {

        // if checking fuel success & then make sales record. 

        $result = $conn->query("INSERT INTO sales (`atendentID`,`transaction_no`,`fuelType`,`pumpNo`,`unitPrice`,`preRead`,`curRead`,`ltrSold`,`amount`,`stationID`) VALUE($employeeID,'$transaction_no','$fuelType','$pumpNo','$unitPrice','$preRead','$curRead','$soldLtr','$amount','$stationID' )");
        mysqli_query($conn, "UPDATE fuels SET AvailableLiters=AvailableLiters-'$soldLtr' WHERE FuelType='$fuelType'");

        if ($result) {
            $_SESSION['refresh_payment'] = true;
            $_SESSION['warning'] = "Sales record created successfully! Please complete the sales entry.";
            header("location:../payment.php?transaction_no=$transaction_no");
        }
        $conn->close();
        $result->close();
    } else {
        $_SESSION['warning'] = "Not Enough Fuel Stock! Please request a new order of fuel -> $fuelType.";
        header("location:../sales.php");
        exit();
    }
}



function getSales()
{
    $conn = getConnection();
    $result = $conn->query("SELECT * FROM `sales` ORDER by id DESC LIMIT 1");
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    if ($rows) {
    }
    $conn->close();
    $result->close();
    return $rows;
}


if (isset($_POST['addPaymentInfo'])) {
    $conn = getConnection();

    $tran_no = $_POST['tran_no'];
    $paymentMethod = $_POST['paymentMethod'];
    $tax = $_POST['tax'];
    $enteryMethod = $_POST['enteryMethod'];
    $invoiceNo = $_POST['invoiceNo'];
    $result = $conn->query("UPDATE sales SET `payment_method` = '$paymentMethod',`entry_method`='$enteryMethod',`tax`='$tax',`invoice_no`='$invoiceNo' WHERE transaction_no='$tran_no'");

    if ($result) {
        $_SESSION['status'] = "Sales compelted successfully!";
        header("location:../sales.php");
        exit();
    } else {
        $_SESSION['status'] = "Sales is not compelted!";
        header("location:../sales.php");
        exit();
    }
    $conn->close();
    $result->close();
}

// To day fuel sales

function getTodayFuelSales($fuelType)
{
    $conn = getConnection();
    $query = "SELECT SUM(amount) AS total_amount FROM sales WHERE fuelType = '$fuelType' AND DATE(created_at) = CURDATE()";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total_amount'] ?? 0;  // return 0 if no sales
}


// genearte invoice

if (isset($_GET['invoice_no'])) {
    $invoice_no = $_GET['invoice_no'];

    echo "
    <script>
        window.onload = function() {
            generateReceipt('$invoice_no');
            window.location.href = '../sales_history.php';
        }
    </script>
    ";
}





if (isset($_POST["invoice_no"])) {
    $invoice_no = $_POST["invoice_no"];
    // $newInvoice_no = preg_replace('/\D/', '', $invoice_no);

    $conn = getConnection();
    $result = $conn->query("SELECT * FROM sales WHERE invoice_no = '$invoice_no'");
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($rows as $row) {

    ?>
        <div class="row">
            <div class="col ">
                <div class="col mb-5 d-flex justify-content-between">
                    <div class="">
                        <p class="m-0 font-weight-bold">Fuel Management System</p>
                        <p class="m-0">86 Main St.</p>
                        <p class="m-0">Gacayte, MainVT2045</p>
                        <p class="m-0">+252907796534</p>
                    </div>
                    <div class=" img-fluid ">
                        <img class=" float-right rounded border-5" style="width: 100px;" src="puplic/images/profile.jpg" alt="">

                    </div>
                </div>

                <div style="border-top: 2px dashed rgba(128, 128, 128, 0.5); margin: 5px 0;"></div>
                <div class="col ">
                    <div class="time d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-center m-0 text-dark font-weight-">
                                <?php
                                echo  $date = date('d-m-Y', strtotime($row['created_at']));  // Output: 2025-04-10

                                ?></p>
                        </div>

                        <div>
                            <p class="text-center m-0 text-dark font-weight-"><?php echo $time = date('H:i:s', strtotime($row['created_at'])); ?></p>
                        </div>
                    </div>

                </div>
                <div style="border-top: 2px dashed rgba(128, 128, 128, 0.5); margin: 5px 0;"></div>
                <div class="col ">
                    <div class="time d-flex align-items-cente align-baseline  justify-content-between">
                        <div>
                            <p class=" m-0 text-dark font-weight-">Memeber</p>
                            <p class=" m-0 text-dark font-weight-">Trans</p>
                            <p class=" m-0 text-dark font-weight-">Pump</p>
                        </div>

                        <div>
                            <p class="text-right m-0 text-dark font-weight-"><?php echo $row['atendentID']; ?></p>
                            <p class="text-right m-0 text-dark font-weight-"><?php echo $row['transaction_no']; ?></p>
                            <p class="text-right m-0 text-dark font-weight-"><?php echo $row['pumpNo']; ?></p>
                        </div>
                    </div>

                </div>
                <div style="border-top: 2px dashed rgba(128, 128, 128, 0.5); margin: 5px 0;"></div>

                <div class="col ">
                    <div class="time d-flex align-items-cente align-baseline  justify-content-between">
                        <div>
                            <p class=" m-0 text-dark font-weight-">Fuel</p>
                            <p class=" m-0 text-dark font-weight-">Liter/KG/Gallon</p>
                            <p class=" m-0 text-dark font-weight-">Price/L</p>
                            <p class=" m-0 text-dark font-weight-">Tax</p>
                            <p class=" m-0 text-dark font-weight-">Total</p>
                        </div>

                        <div>
                            <p class="text-right m-0 text-dark font-weight-"><?php echo $row['fuelType']; ?></p>
                            <p class="text-right m-0 text-dark font-weight-"><?php echo $row['ltrSold']; ?></p>
                            <p class="text-right m-0 text-dark font-weight-">$<?php echo $row['unitPrice']; ?></p>
                            <p class="text-right m-0 text-dark font-weight-">$<?php echo $row['tax']; ?></p>
                            <p class="text-right m-0 text-dark font-weight-">$<?php echo $row['amount']; ?></p>
                        </div>
                    </div>

                </div>

                <div style="border-top: 2px dashed rgba(128, 128, 128, 0.5); margin: 5px 0;"></div>

                <div class="col ">
                    <div class="time d-flex align-items-cente align-baseline  justify-content-between">
                        <div>
                            <!-- <p class=" m-0 text-dark font-weight-">Visa</p> -->
                            <p class=" m-0 text-dark font-weight-">Entery Method/L</p>
                            <p class=" m-0 text-dark font-weight-">Station</p>
                            <p class=" m-0 text-dark font-weight-">Invoice</p>
                        </div>

                        <div>
                            <!-- <p class="text-right m-0 text-dark font-weight-">Credit</p> -->
                            <p class="text-right m-0 text-dark font-weight-"><?php echo $row['entry_method']; ?></p>
                            <p class="text-right m-0 text-dark font-weight-"><?php echo $row['stationID']; ?></p>
                            <p class="text-right m-0 text-dark font-weight-"><?php echo $row['invoice_no']; ?></p>
                        </div>
                    </div>

                </div>
                <div class="col mt-5">
                    <div class="time d-flex align-items-cente align-baseline  justify-content-between">
                        <div>
                            <p class=" m-0 text-dark ">Thank you</p>
                            <p class=" m-0 text-dark ">Have a nice day</p>

                        </div>

                        <div class=" img-fluid ">
                            <img class=" float-right rounded border-5" style="width: 100px;" src="puplic/images/profile.jpg" alt="">
                            <!-- <i class='bx bxs-gas-pump float-right '></i> -->
                        </div>
                    </div>

                </div>

                <div class="col d-flex flex-column align-items-center">
                    <h4>Barcode</h4>
                </div>

            </div>

        </div>


    <?php
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['updateProfile'])) {
        $employeeID = $_POST['employeeID'];
        $userName = $_POST['userName'];
        $email = $_POST['email'];
        // SQL Update General Info

        $conn = getConnection();
        $result = $conn->query("UPDATE Employees SET `Email` = '$email',`UserName`='$userName' WHERE EmployeeID='$employeeID'");

        if ($result) {
            $_SESSION['status'] = "General detailes updated successfully!";
            header("location:../profile.php");
            exit();
        }
    }

    if (isset($_POST['updateEdit'])) {
        $employeeID = $_POST['employeeID'];

        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $station = $_POST['station'];
        $role = $_POST['role'];
        // SQL Update Edit Profile Info

        $conn = getConnection();
        $result = $conn->query("UPDATE Employees SET `fisrtName`= '$name', `ContactNumber`='$contact', `StationID` = '$station', `Role`= '$role' WHERE EmployeeID = '$employeeID' ");
        if ($result) {
            $_SESSION['status'] = "Profile detailes updated successfully!";
            header("location:../profile.php");
            exit();
        }
    }

    if (isset($_POST['updatePassword'])) {
        $old_pass = $_POST['old_pass'];
        $new_pass = $_POST['new_pass'];
        $confirm_pass = $_POST['confirm_pass'];
        // SQL Update Password
    }
}


if (isset($_POST['updatePumpStatus'])) {
    $pumpID = $_POST['pumpID'];

    $conn = getConnection();
    $result = $conn->query("SELECT pumpID, status FROM pumps WHERE pumpID = '$pumpID'");
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    ?>

    <?php
    foreach ($rows as $row) {
    ?>
        <input type="hidden" name="pumpID" class="form-control" name="stationStatus" id="" value=" <?php echo $row['pumpID']; ?> ">

        <?php
        if ($row['status'] == 0) {
            echo '
            <div class="row d-flex justify-content-center ">
            <div class="col d-flex flex-column d-block ViewStationStatus">
            
            <label for="fuel type" class="font-weight-bold">Current Status: </label>
                    <button class="btn btn-danger" disabled> In Active </button>
                </div>

                 <div class="col d-flex flex-column d-block ViewStationStatus">
                     <label for="fuel type" class="font-weight-bold">Update Status</label>
                        <select name="status" class="custom-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>Choose...</option>
                            <option value="1">Active</option>
                            <option value="0">In Active</option>
                        </select>
                </div>
                </div> ';
        }
        if ($row['status'] == 1) {
            echo '
            <div class="row d-flex justify-content-center ">
            <div class="col d-flex flex-column d-block ViewStationStatus">
            <label for="fuel type" class="font-weight-bold">Current Status: </label>
                    <button class="btn btn-success " disabled>Active </button>
                </div>

                 <div class="col d-flex flex-column d-block ViewStationStatus">
                     <label for="fuel type" class="font-weight-bold">Update Status</label>
                        <select name="status" class="custom-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>Choose...</option>
                            <option value="1">Active</option>
                            <option value="0">In Active</option>
                        </select>
                </div>
                </div> ';
        }


        ?>

    <?php  }
    ?>

<?php

}

// update pumps with jqeury
if (isset($_POST['updatePumpView'])) {
    $pumpID = $_POST['pumpID'];

    $conn = getConnection();
    $result = $conn->query("SELECT * FROM pumps where pumpid = $pumpID");
    $rows = $result->fetch_all(MYSQLI_ASSOC);


    foreach ($rows as $row) {
    ?>
        <form action="includes/dbManager.php" method="post">
            <input type="hidden" value="<?php echo $row['pumpID']; ?>" name="pumpID" id="pumpID" class="form-control">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold ">Update Pump</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <div class="row d-flex justify-content-center">
                    <div class="col d-flex flex-column d-block">
                        <label for="fuel type" class="font-weight-bold"> Name</label>
                        <input type="text" name="name" value="<?php echo $row['pumpName']; ?>" class="form-control">
                        <label for="fuel type" class="font-weight-bold">pumpDesc</label>
                        <input type="text" name="pumpDesc" value="<?php echo $row['pumpDesc']; ?>" class="form-control">
                    </div>
                    <div class="col d-flex flex-column d-block">
                        <label for="" class="font-weight-bold">Station</label>
                        
                        <input type="text" name="station" value="<?php echo $row['stationID']; ?>" class="form-control" aria-label=".cost">
                        <label for="" class="font-weight-bold">Fuel</label>
                        <input type="text" name="fuel" value="<?php echo $row['fuelID']; ?>" class="form-control" aria-label=".cost">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="updatePumpBtn" class="btn btn-primary">Update</button>
            </div>
        </form>





    <?php }
    ?>

<?php
   
}




// after model show will run this code to update the pump's status.

if (isset($_POST['upPumpsStatus'])) {
    $pumpID = $_POST['pumpID'];
    $status = $_POST['status'];

    $conn = getConnection();
    $result = $conn->query("UPDATE pumps SET status = '$status' WHERE StationID = $pumpID");

    if ($result) {
        $_SESSION['status'] = "Status updated successfully";
        header("location:../pumps.php");
    }
    $conn->close();
    $result->close();
}

if (isset($_POST['updatePumpBtn'])) {
    $pumpID = $_POST['pumpID'];
    $pumpName = $_POST['pumpName'];
    $pumpDesc = $_POST['pumpDesc'];
    $fuelID = $_POST['fuelID'];
    $stationID = $_POST['stationID'];

    $conn = getConnection();
    $result = $conn->query("UPDATE `pumps` SET `pumpName` = '$pumpName', `pumpDesc` = '$pumpDesc' , `fuelID` = '$fuelID',`Staion` WHERE `stations`.`StationID` = $stationID");

    if ($result) {
        $_SESSION['status'] = "Station updated successfully";
        header("location:../stations.php");
    } else {

        echo "Station not upadted";
    }
    $conn->close();
    $result->close();
}

// get all suppliers.
function getSuppliers()
{
    $conn = getConnection();
    $result = $conn->query("SELECT * FROM suppliers");
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    if ($rows) {
    }
    $conn->close();
    $result->close();
    return $rows;
}
// get all suppliers end.


// add suppliers
if (isset($_POST['addSupplier'])) {
    $supplierName = $_POST['supplierName'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];
    $location = $_POST['location'];

    $conn = getConnection();
    $result = $conn->query("INSERT INTO suppliers (`Name`,`ContactNumber`,`Email`,`Location`) VALUES('$supplierName','$contactNumber','$email','$location')");
    if ($result) {
        $_SESSION['status'] = "Supplier inserted successfully";
        header("location:../suppliers.php");
    }
    $conn->close();
    $result->close();   
}


if (isset($_POST['updateSupplierStatus'])) {
    $supplierID = $_POST['supplierID'];

    $conn = getConnection();
    $result = $conn->query("SELECT id, status FROM suppliers WHERE id = '$supplierID'");
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    ?>

    <?php
    foreach ($rows as $row) {
    ?>
        <input type="hidden" name="supplierID" class="form-control" name="stationStatus" id="" value=" <?php echo $row['id']; ?> ">

        <?php
        if ($row['status'] == 0) {
            echo '
            <div class="row d-flex justify-content-center ">
            <div class="col d-flex flex-column d-block ViewStationStatus">
            
            <label for="fuel type" class="font-weight-bold">Current Status: </label>
                    <button class="btn btn-danger" disabled> In Active </button>
                </div>

                 <div class="col d-flex flex-column d-block ViewStationStatus">
                     <label for="fuel type" class="font-weight-bold">Update Status</label>
                        <select name="status" class="custom-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>Choose...</option>
                            <option value="1">Active</option>
                            <option value="0">In Active</option>
                        </select>
                </div>
                </div> ';
        }
        if ($row['status'] == 1) {
            echo '
            <div class="row d-flex justify-content-center ">
            <div class="col d-flex flex-column d-block ViewStationStatus">
            <label for="fuel type" class="font-weight-bold">Current Status: </label>
                    <button class="btn btn-success " disabled>Active </button>
                </div>

                 <div class="col d-flex flex-column d-block ViewStationStatus">
                     <label for="fuel type" class="font-weight-bold">Update Status</label>
                        <select name="status" class="custom-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>Choose...</option>
                            <option value="1">Active</option>
                            <option value="0">In Active</option>
                        </select>
                </div>
                </div> ';
        }


        ?>

    <?php  }
    ?>

<?php

}

if (isset($_POST['upSuppleirStatus'])) {
    $supplierID = $_POST['supplierID'];
    $status = $_POST['status'];

    $conn = getConnection();
    $result = $conn->query("UPDATE suppliers SET status = '$status' WHERE id = $supplierID");

    if ($result) {
        $_SESSION['status'] = "Status updated successfully";
        header("location:../suppliers.php");
    }
    $conn->close();
    $result->close();
}

// update suppliers
if (isset($_POST['updateSupplirBtn'])) {
    $supplierID = $_POST['supplierID'];
    $supplierName = $_POST['name'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];
    $location = $_POST['location'];

    $conn = getConnection();
    $result = $conn->query("UPDATE suppliers SET `Name` = '$supplierName', `ContactNumber` = '$contactNumber', `Email` = '$email', `Location` = '$location' WHERE id = $supplierID");

    if ($result) {
        $_SESSION['status'] = "Supplier updated successfully";
        header("location:../suppliers.php");
    } else {
        $_SESSION['status'] = "Supplier not upadted";
        header("location:../suppliers.php");
    }
    $conn->close();
    $result->close();
}

// delete suppliers
if (isset($_POST['deleteSupplier'])) {
    $supplierID = $_POST['supplierID'];

    $conn = getConnection();
    $result = $conn->query("DELETE FROM suppliers WHERE id = $supplierID");
    if ($result) {
        $_SESSION['delete'] = "Supplier deleted successfully";
        header("location:../suppliers.php");
    }
    $conn->close();
    $result->close();
}

if (isset($_POST['updateSupplierView'])) {
    $supplierID = $_POST['supplierID'];

    $conn = getConnection();
    $result = $conn->query("SELECT * FROM suppliers where id = $supplierID");
    $rows = $result->fetch_all(MYSQLI_ASSOC);


    foreach ($rows as $row) {
    ?>


        <form action="includes/dbManager.php" method="post">
            <input type="hidden" value="<?php echo $row['id']; ?>" name="supplierID" id="supplierID" class="form-control">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold ">Update Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <div class="row d-flex justify-content-center">
                    <div class="col d-flex flex-column d-block">
                        <label for="fuel type" class="font-weight-bold">Supplier Name</label>
                        <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control">
                        <label for="fuel type" class="font-weight-bold">Location</label>
                        <input type="text" name="location" value="<?php echo $row['location']; ?>" class="form-control">
                    </div>
                    <div class="col d-flex flex-column d-block">
                        <label for="" class="font-weight-bold">Email</label>
                        <input type="text" name="email" value="<?php echo $row['email']; ?>" class="form-control" aria-label=".cost">
                        <label for="" class="font-weight-bold">Contact numer</label>
                        <input type="text" name="contactNumber" value="<?php echo $row['contactNumber']; ?>" class="form-control" aria-label=".cost">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="updateSupplirBtn" class="btn btn-primary">Update</button>
            </div>
        </form>





    <?php }
    ?>

<?php
   
}