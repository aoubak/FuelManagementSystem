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
    <!-- <label for="fuel type" class="font-weight-bold">Station Status: </label> -->

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
    // if ($result) {
    //     header("location:../stations.php");
    // }
    // $conn->close();
    // $result->close();
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

if(isset($_POST['addNewFuel'])){
    $fuelType = $_POST['fuelType'];
    $unitPrice = $_POST['unitPrice'];
    $availableLiters = $_POST['availableLiters'];

    $conn = getConnection();
    $checkfuel = $conn->query("SELECT FuelType FROM fuels WHERE FuelType = '$fuelType'");
    if ($checkfuel->num_rows > 0) {
        $_SESSION['checkfuel'] = 'Sorry... Fuel is already registred! Please try again!';
        header("location:../fuel.php");
    }
   
    else {
        $result = $conn->query("INSERT INTO `fuels` (`FuelType`, `UnitPrice`, `AvailableLiters`) VALUES ('$fuelType', '$unitPrice', '$availableLiters')");
        if($result){
        $_SESSION['status'] = "Fuel inserted successfully";
        header("location:../fuel.php");
    }
}
    $conn->close();
    $result->close();
    
}

// update fuel prices

if(isset($_POST['updateFuelPrice'])){
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
    if($rows){

    }
    else {
        echo "No data available in table!";
    }
    $conn->close();
    $result->close();
    return $rows;
}

Function getPetrol(){
    $conn = getConnection();
    $result = $conn->query("SELECT FuelID, FuelType, SUM(AvailableLiters) AS 'TotalLiterSupplied', ( UnitPrice * SUM(AvailableLiters) ) AS 'Cost', Supplier,`Date` FROM `fuels` WHERE FuelType = 'Petrol' GROUP BY FuelID,FuelType, UnitPrice, Supplier,`Date`");
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    if($result ){

    }
    $conn->close();
    $result->close();
    return $rows;
}

Function getDeisel(){
    $conn = getConnection();
    $result = $conn->query("SELECT FuelID, FuelType, SUM(AvailableLiters) AS 'TotalLiterSupplied', ( UnitPrice * SUM(AvailableLiters) ) AS 'Cost', Supplier,`Date` FROM `fuels` WHERE FuelType = 'Deisel' GROUP BY FuelID,FuelType, UnitPrice, Supplier,`Date`");
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    if($result ){

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
