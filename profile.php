<?php
include("view/partials/head.php");
include("includes/dbManager.php");
checkLogin();
if (isLogin() == false) {
    header("location:login.php");
}
?>

<?php if (isset($_GET['error']) && $_GET['error'] == 'invalid'): ?>
    <script>
        alert('Invalid Image Extension');
    </script>
<?php endif; ?>

<?php if (isset($_GET['error']) && $_GET['error'] == 'size'): ?>
    <script>
        alert('Image Size Is Too Large');
    </script>
<?php endif; ?>

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
                    <!-- Page Heading -->
                    <!-- <div
                        class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
                       
                    </div> -->



                    <!-- Content Row -->
                    <!-- DataTales Example -->
                    <div class="card shadow myProfile mb-4">




                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">My Profile</h6>
                            <div class="actions">
                                <div class="dropdown  bg-white ">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu shadow-sm shadow-lg mr-4" aria-labelledby="dropdownMenu2">
                                        <div class="d-block list-group actions">
                                            <a href="#" class="list-group-item mb-1 list-group-item-action text-dark text-black Atab_btn" aria-current="true"> <span class="ProfileLinksIcons"><i class="fa-solid fa-gear"></i></span> Generel</a>
                                            <a href="#" class="list-group-item mb-1 list-group-item-action text-dark text-black Atab_btn" aria-current="true"> <span class="ProfileLinksIcons"><i class="fa-solid fa-pen-to-square"></i></span> Edit Profile</a>
                                            <a href="#" class="list-group-item mb-1 list-group-item-action text-dark text-black Atab_btn" aria-current="true"> <span class="ProfileLinksIcons"><i class="fa-solid fa-key"></i></span> Password</a>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                        if (isLogin() == true) {
                            $EmployeeID = $_SESSION['EmployeeID'];

                            $conn = getConnection();
                            $result = $conn->query("SELECT * FROM Employees where EmployeeID='$EmployeeID'");
                            $rows = $result->fetch_all(MYSQLI_ASSOC);

                            $Employees = $rows;
                            foreach ($Employees as $row) {
                        ?>

                                <!-- <h2>
                                    <?php
                                    echo $row['UserName'];
                                    ?>
                                </h2> -->

                        <?php  }
                        }

                        ?>
                        <div class="card-body">
                            <div class="row banner mb-5">
                                <div class="col  ProfileBanner border border-1 rounded rounded-1 p-0">
                                    <div class="ProfileInfo bg-white pl-3 pr-3 pt-3 shadow  rounded rounded-2">
                                        <div class="username d-flex align-content-center">
                                            <h5 class="  text-dark m-0 font-weight-bold">
                                                <?php
                                                echo strtoupper($row['UserName']);
                                                ?> </h5>
                                            <span class="Verify d-flex align-items-center"><i class='bx bxs-badge-check bx-tada text-success '></i></span>
                                        </div>

                                        <p> <?php
                                            echo $row['Email'];
                                            ?></p>
                                    </div>
                                    <img src="public/images/tt-01.jpg" alt="banner">
                                    <div class="col-2 profileImage  border border-1 p-0 rounded rounded-1">
                                        <div class="active bg-success text-white rounded rounded-2 p-1 bx-flashing">Active</div>

                                        <?php if (!empty($row['image'])): ?>
                                            <img src="public/images/users/<?php echo htmlspecialchars(trim($row['image'])); ?>" alt="userImage">
                                        <?php else: ?>
                                            <img src="public/images/users/default-profile.jpg" alt="">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="ProfileInfoMod ">
                                <div class="username d-flex align-content-center">
                                    <h5 class="  text-dark m-0 font-weight-bold"> <?php
                                                                                    echo strtoupper($row['UserName']);
                                                                                    ?> </h5>
                                    <span class="Verify d-flex align-items-center"><i class='bx bxs-badge-check bx-tada text-success '></i></span>
                                </div>

                                <p><?php
                                    echo $row['Email'];
                                    ?></p>
                            </div>
                            <div class="row   ">
                                <div class="col-3 d-none d-sm-block bg-light p-2 rounded-left rounded-2 border border-1  flex-column">
                                    <div class="ProfileInfo">
                                        <div class="username d-flex align-content-center">
                                            <h5 class="  text-dark m-0 font-weight-bold">
                                                <?php
                                                echo strtoupper($row['UserName']);
                                                ?> </h5>
                                            <span class="Verify d-flex align-items-center"><i class='bx bxs-badge-check bx-tada text-success '></i> </span>
                                        </div>
                                        <p><?php
                                            echo $row['Email'];
                                            ?></p>
                                    </div>
                                    <div class="Profilelinks ">
                                        <div class="d-block list-group ">
                                            <a href="#general" class="list-group-item mb-1 list-group-item-action text-dark text-black tab_btn" aria-current="true"> <span class="ProfileLinksIcons"><i class="fa-solid fa-gear"></i></span> Generel</a>
                                            <a href="#edit" class="list-group-item mb-1 list-group-item-action text-dark text-black tab_btn" aria-current="true"> <span class="ProfileLinksIcons"><i class="fa-solid fa-pen-to-square"></i></span> Edit Profile</a>
                                            <a href="#password" class="list-group-item mb-1 list-group-item-action text-dark text-black tab_btn" aria-current="true"> <span class="ProfileLinksIcons"><i class="fa-solid fa-key"></i></span> Password</a>
                                        </div>
                                    </div>


                                </div>
                                <!-- user conent -->

                                <div class="col content acontent active p-2 border border-1 rounded-right rounded-2">

                                    <form action="includes/dbManager.php" method="post">
                                        <input type="hidden" name="employeeID" value="<?php echo $row['EmployeeID']; ?>">

                                        <div class="info-header bg-primary p-3 rounded rounded-2 text-white">
                                            <h5 class="font-weight-bold"><?php echo $row['UserName']; ?> / General</h5>
                                            <span> Update your username and manage your account</span>
                                        </div>
                                        <?php

                                        if (isset($_SESSION['status'])) {

                                        ?>
                                            <div class="alert alert-success mt-2 d-flex justify-content-between align-items-center" role="alert">
                                                <strong> <?php echo $_SESSION['status']; ?></strong>
                                            </div>
                                        <?php

                                            unset($_SESSION['status']);
                                        }
                                        ?>
                                        <div class="user-data pl-3 pr-3  mt-2">

                                            <label for="" class="text-dark">Username</label>
                                            <input type="text" name="userName" value="<?php
                                                                                        echo $row['UserName'];
                                                                                        ?>" class="form-control" placeholder="">
                                        </div>
                                        <div class="user-data pl-3 pr-3 mt-2">
                                            <label for="" class=" text-dark">Email</label>
                                            <input type="text" name="email" value="<?php
                                                                                    echo $row['Email'];
                                                                                    ?>" class="form-control" placeholder="">
                                        </div>

                                        <div class="user-data mt-2 modal-footer">
                                            <button type="submit" name="updateProfile" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- edit Profile -->
                                <div class="col content acontent editProfile p-2 border border-1 rounded-right rounded-2">


                                    <div class="info-header bg-primary p-3 rounded rounded-2 text-white">
                                        <h5 class="font-weight-bold"><?php echo $row['UserName']; ?> / Edit Profile</h5>
                                        <span> Set up your and enhance your profile</span>
                                    </div>

                                    <div class=" col user-data d-flex pl-3 pr-3 pt-3 pb-3 mt-2 rounded rounded-2 border border-1 border-danger d-flex  align-items-center ">
                                        <form action="includes/dbManager.php" method="post" enctype="multipart/form-data" class="d-block d-lg-flex w-100">
                                            <input type="hidden" name="employeeID" value="<?php echo $row['EmployeeID']; ?>">

                                            <div class="editImage mr-4">
                                                <?php if (!empty($row['image'])): ?>

                                                    <img src="public/images/users/<?php echo htmlspecialchars(trim($row['image'])); ?>" alt="" class="rounded-circle">
                                                    <!-- <img src="public/images/users/65ca8ba0b5186.jpg" alt="" class="rounded-circle" > -->

                                                <?php else: ?>
                                                    <img src="public/images/users/default-profile.jpg" alt="" class="rounded-circle">
                                                <?php endif; ?>
                                            </div>
                                            </span>
                                            <input type="hidden" name="old_image"
                                                VALUE="<?php echo $row['image']; ?>">
                                            <div class="col d-block mt-3">

                                                <div class="image_file_uplod">
                                                    <!-- <div class="custom-file  mr-4">
                                                        <label for="">upade </label>
                                                        <input type="file" name="new_image" class="custom-file-input" id="inputGroupFile01">
                                                        <label class="custom-file-label text-danger" for="inputGroupFile01">Update your current image - Choose file</label>

                                                    </div> -->
                                                    <!-- name="new_image" -->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" name="new_image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="btns mt-3">
                                                    <button type="submit" name="update_user_image" class="btn btn-primary"> Upload </button>
                                                    <button type="delete_user_image" class="btn btn-danger  ml-2"> Delete </button>
                                                </div>

                                            </div>

                                        </form>

                                    </div>

                                    <form action="includes/dbManager.php" method="post">
                                        <input type="hidden" name="employeeID" value="<?php echo $row['EmployeeID']; ?>">
                                        <div class="user-data pl-3 pr-3  mt-2">
                                            <label for="" class="text-dark">Name</label>
                                            <input type="text" name="name" value="<?php
                                                                                    echo $row['fisrtName'];
                                                                                    ?>" class="form-control" placeholder="">
                                        </div>
                                        <div class="user-data pl-3 pr-3 mt-2">
                                            <label for="" class="text-dark">Contact</label>
                                            <input type="text" name="contact" value="<?php
                                                                                        echo $row['ContactNumber'];
                                                                                        ?>" class="form-control" placeholder="">
                                        </div>
                                        <div class="user-data pl-3 pr-3 mt-2">
                                            <label for="" class="text-dark">Station</label>
                                            <select name="station" class="custom-select form-select-sm" aria-label=".form-select-sm example">
                                                <?php
                                                $stations = getStations();
                                                // foreach ($stations as $Station) {
                                                ?>

                                                <?php
                                                if (isLogin() == true) {
                                                    $EmployeeID = $_SESSION['EmployeeID'];

                                                    $conn = getConnection();
                                                    $result = $conn->query("SELECT s.StationID, s.Name, e.Role FROM `employees` e INNER JOIN `stations` s on e.StationID = s.StationID WHERE EmployeeID ='$EmployeeID' ");
                                                    $rows = $result->fetch_all(MYSQLI_ASSOC);

                                                    $Employees = $rows;
                                                    foreach ($Employees as $row) {
                                                ?>
                                                        <option value="<?php echo $row['StationID']; ?>" > <?php echo $row['Name']; ?> </option>
                                                <?php  }
                                                } ?>


                                                <option value="">- choose the below options -</option>
                                                <?php
                                                $stations = getStations();
                                                foreach ($stations as $station) {

                                                ?>
                                                    <option value="<?php echo $station['StationID']; ?>"><?php echo $station['Name']; ?></option>
                                                <?php } ?>

                                                <!-- <option value="">Main Station</option>
                                            <option value="">Second Station</option>
                                            <option value="">Third Station</option>
                                            <option value="">Fourth Station</option>
                                            <option value="">Fifth Station</option> -->


                                            </select>
                                        </div>
                                        <div class="user-data pl-3 pr-3 mt-2">
                                            <label for="" class="text-dark">Role</label>
                                            <select name="role" class="custom-select form-select-sm" aria-label=".form-select-sm example">
                                                <?php
                                                if (isLogin() == true) {
                                                    $EmployeeID = $_SESSION['EmployeeID'];

                                                    $conn = getConnection();
                                                    $result = $conn->query("SELECT s.StationID, e.UserName, s.Name, e.Role FROM `employees` e INNER JOIN `stations` s on e.StationID = s.StationID WHERE EmployeeID ='$EmployeeID' ");
                                                    $rows = $result->fetch_all(MYSQLI_ASSOC);

                                                    $Employees = $rows;
                                                    foreach ($Employees as $row) {
                                                ?>
                                                        <option value="<?php echo $row['Role']; ?>"><?php echo $row['Role']; ?></option>
                                                <?php  }
                                                } ?>

                                                <option value="Pump Operator">-choose the below options-</option>
                                                <option value="Pump Operator">Pump Operator</option>
                                                <option value="Accountant/Cashier">Accountant/Cashier</option>
                                                <option value="Station Manager">Station Manager</option>
                                                <option value="Mechanic/Technician">Mechanic/Technician</option>
                                                <option value="Security Guard">Security Guard </option>
                                            </select>
                                        </div>

                                        <div class="user-data  mt-2 modal-footer">
                                            <button type="submit" name="updateEdit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- USER Password -->

                                <div class="col content acontent p-2 border border-1 rounded-right rounded-2">
                                    <form action="includes/dbManager.php" method="post">
                                        
                                    <!-- $EmployeeID = $_SESSION['EmployeeID']; -->
                                    <input type="hidden" name="employeeID" value="<?php echo $_SESSION['EmployeeID']; ?>" >

                                        <div class="info-header bg-primary p-3 rounded rounded-2 text-white">
                                            <h5 class="font-weight-bold"><?php echo $row['UserName']; ?>/ Password</h5>
                                            <span> Manage your password</span>
                                        </div>
                                        <div class="user-data pl-3 pr-3  mt-2">
                                            <label for="" class="text-dark">Old Password</label>
                                            <input type="text" name="oldPass" class="form-control" placeholder="">
                                        </div>
                                        <div class="user-data pl-3 pr-3 mt-2">
                                            <label for="" class="text-dark">New Password</label>
                                            <input type="text" name="newPass" class="form-control" placeholder="">
                                        </div>
                                        <div class="user-data  mt-2 modal-footer">
                                            <button type="submit" name="update_password" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>



                        </div>
                        <div class="card-bod">

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

    <!-- box icons -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = e.target.files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    </script>

    <!-- <script>
        function confirmCreateReceipt() {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to create a new receipt?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6', // blue
                cancelButtonColor: '#d33', // red
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
                        window.location.href = 'create_receipt.php';
                    })
                }
            })
        }
    </script> -->


</body>

</html>