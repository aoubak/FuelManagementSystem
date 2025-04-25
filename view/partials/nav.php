  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars"></i>
      </button>

      <!-- Topbar Search -->
      <form
          class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
          <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                  aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                      <i class="fas fa-search fa-sm"></i>
                  </button>

              </div>
          </div>

      </form>

      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">

          <!-- Nav Item - Search Dropdown (Visible Only XS) -->
          <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                  aria-labelledby="searchDropdown">
                  <form class="form-inline mr-auto w-100 navbar-search">
                      <div class="input-group">
                          <input type="text" class="form-control bg-light border-0 small"
                              placeholder="Search for..." aria-label="Search"
                              aria-describedby="basic-addon2">
                          <div class="input-group-append">
                              <button class="btn btn-primary" type="button">
                                  <i class="fas fa-search fa-sm"></i>
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </li>

          <!-- Nav Item - Alerts -->
          <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-bell fa-fw"></i>
                  <!-- Counter - Alerts -->
                  <?php
                    $conn = getConnection();

                    $query = "SELECT COUNT(*) AS total FROM fuels WHERE AvailableLiters <= 500";
                    $result = $conn->query($query);
                    $row = $result->fetch_assoc();

                    $alertCount = $row['total']; // 👈 this holds the count
                    ?>
                  <?php if ($alertCount > 0): ?>
                    <span class="badge badge-danger badge-counter"><?php echo $alertCount; ?>+</span>
                      <!-- <span class="badge badge-danger badge-counter"></span> -->
                  <?php endif; ?>
              
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                  aria-labelledby="alertsDropdown">
                  <h6 class="dropdown-header">
                      Alerts Center
                  </h6>

                  <?php
                    $conn = getConnection(); // Your DB connection function

                    $query = "SELECT FuelType, AvailableLiters FROM fuels WHERE AvailableLiters <= 500";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        // Fetch each row and display the alert

                        while ($row = $result->fetch_assoc()) {

                            echo '
                            
                  <a class="dropdown-item d-flex align-items-center" href="alerts.php">
                      <div class="mr-3">
                          <div class="icon-circle bg-warning">
                          <i class="fas fa-exclamation-triangle text-white"></i>
                              
                          </div>
                      </div>
                      <div>
                          <div class="small text-gray-500">
                          
                            ' . date("F d, Y") . '
                          
                            </div>
                          <span class="font-weight-bol"><strong class="text-danger">Low Fuel!</strong > ' . $row['FuelType'] . ' has only <strong class="text-danger">' . $row['AvailableLiters'] . 'L</strong> remaining.</span>
                          
                      </div>
                  </a>
                    ';
                        }
                    }
                    ?>

                  <!-- <a class="dropdown-item d-flex align-items-center" href="#">
                      <div class="mr-3">
                          <div class="icon-circle bg-success">
                              <i class="fas fa-donate text-white"></i>
                          </div>
                      </div>
                      <div>
                          <div class="small text-gray-500">December 7, 2019</div>
                          $290.29 has been deposited into your account!
                      </div>
                  </a> -->
                  <!-- <a class="dropdown-item d-flex align-items-center" href="#">
                      <div class="mr-3">
                          <div class="icon-circle bg-warning">
                              <i class="fas fa-exclamation-triangle text-white"></i>
                          </div>
                      </div>
                      <div>
                          <div class="small text-gray-500">December 2, 2019</div>
                          Spending Alert: We've noticed unusually high spending for your account.
                      </div>
                  </a> -->
                  <a class="dropdown-item text-center small text-gray-500" href="alerts.php">Show All Alerts</a>
              </div>
          </li>



          <div class="topbar-divider d-none d-sm-block"></div>
          <?php
            if (isLogin() == true) {
                $EmployeeID = $_SESSION['EmployeeID'];

                $conn = getConnection();
                $result = $conn->query("SELECT * FROM Employees where EmployeeID='$EmployeeID'");
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                $Employees = $rows;
                foreach ($Employees as $row) {
            ?>

          <?php  }
            }

            ?>

          <!-- Nav Item - User Information -->
          <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-success small font-weight-bold">
                      <?php
                        // strtoupper( $row['Role'])
                        if ((empty($row['Role']))) {
                            echo "|";
                        } else {
                            echo $row['Role'];
                        };
                        ?></span>
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                      <?php
                        if ((empty($row['UserName']))) {
                            echo "|";
                        } else {
                            echo $row['UserName'];
                        }
                        ?></span>

                  <?php if (!empty($row['image'])): ?>
                      <img src="public/images/users/<?php echo trim($row['image']); ?>" alt="" class="img-profile rounded-circle">
                  <?php else: ?>
                      <img src="public/images/users/default-profile.jpg" alt="" class="img-profile rounded-circle">
                  <?php endif; ?>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                  aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="profile.php">
                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                      Profile
                  </a>
                  <a class="dropdown-item" href="settings.html">
                      <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                      Settings
                  </a>

                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                      Logout
                  </a>
              </div>
          </li>

      </ul>

  </nav>
  <!-- End of Topbar -->