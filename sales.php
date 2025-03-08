<?php
include("view/partials/head.php");
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
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header text-white bg-primary ">
                                    <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Pump Record</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col d-flex flex-column d-block">
                                            <label for="fuel type" class="font-weight-bold">Select Pump</label>
                                            <select class="custom-select" name="pumpName" id="">
                                                <option selected>-Choose-</option>
                                                <option value="">COC3</option>
                                            </select>
                                            <label for="fuel type" class="font-weight-bold">Today's Price</label>
                                            <input type="text" name="location" class="form-control">

                                        </div>
                                        <div class="col d-flex flex-column d-block">

                                            <label for="" class="font-weight-bold">Fuel Type</label>
                                            <select class="custom-select" name="pumpName" id="">
                                                <option selected>-Choose-</option>
                                                <option value="">Petrol</option>
                                                <option value="">Diesel</option>
                                            </select>
                                            <label for="fuel type" class="font-weight-bold">Current Reading</label>
                                            <input type="text" name="location" class="form-control">
                                        </div>

                                    </div>
                                    <div class="row d-flex ">
                                        <div class="col d-flex flex-column">
                                            <label for="fuel type" class="font-weight- text-danger"> Assign this pump to Atendent (Shaqaalaha)</label>
                                            <select class="custom-select" name="pumpName" id="">
                                                <option selected>-Choose-</option>
                                                <option value="">COC3</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Understood</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--  -->
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">SALES</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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
                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#staticBackdrop"><i class="fa-solid fa-plus bg-primary text-white p-1 rounded "></i> Add New Sales</a>
                                        <a href="sales_history.php" class="dropdown-item"> <i class="fa-solid fa-clock-rotate-left  bg-primary text-white p-1 rounded"></i> Veiw Sales History</a>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>Attendent</th>
                                            <th>Fuel</th>
                                            <th>Pump No</th>
                                            <th>Price</th>
                                            <th>Current Reading (BS)</th>
                                            <th>Meter Reading (AS)</th>
                                            <th>Sold Ltr</th>
                                            <th>Amount</th>
                                            <th>Edit</th>


                                        </tr>
                                    </thead>
                                    <tfoot class="bg-gray-800 text-white">
                                        <tr>
                                            <th>Attendent</th>
                                            <th>Fuel</th>
                                            <th>Pump No</th>
                                            <th>Fuel Price</th>
                                            <th>Current Reading (BS)</th>
                                            <th>Meter Reading (AS)</th>
                                            <th>Sold Ltr</th>
                                            <th>Amount</th>
                                            <th>Edit</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <tr>
                                            <td>AOUB AK</td>
                                            <td>PETROL</td>
                                            <td>COC3</td>
                                            <td>$1.2</td>
                                            <td>390 ltr</td>
                                            <td>540 ltr</td>
                                            <td>150 ltr</td>
                                            <td><span class="text-primary font-weight-bold p-1 rounded">$ 180.00</span></td>
                                            <td><button class="btn btn-danger">Update</button></td>
                                        </tr>
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
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include("view/partials/footer.php");
        ?>

</body>

</html>