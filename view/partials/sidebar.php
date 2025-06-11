<?php
// onlyAdminPage();
// $userRole = CheckUserRole();
// // Check if user is Admin
// if ($userRole !== 'Admin') {
//     // If not admin, redirect to dashboard or access denied page
//     header("Location:../index.php");
//     exit();
// }

?>
  
  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
          <div class="sidebar-brand-icon ">
              <!-- <i class="fas fa-laugh-wink"></i> -->
              <i class='bx bxs-gas-pump'></i>
              <!-- <div class="image">
                
                  <img src="public/images/profile.jpg" class="img-fluid rounded rounded-2" alt="">
              </div> -->

          </div>
          <div class="sidebar-brand-text mx-3">SOM OIL<sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
          <a class="nav-link" href="index.php">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
          Pages
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
              aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-fw fa-cog"></i>
              <span>Management</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Tables</h6>
                  <?php $userRole = CheckUserRole(); ?>

                  <!-- Only for Admin -->
                  <?php if ($userRole == 'Admin') : ?>
                      <a class="collapse-item" href="Stations.php">Stations</a>
                      <a class="collapse-item" href="fuel.php">Fuel</a>
                      <a class="collapse-item" href="pumps.php">Pumps</a>
                      <a class="collapse-item" href="sales.php">Sales</a>
                      <a class="collapse-item" href="Employees.php">Employees</a>
                      <a class="collapse-item" href="customers.php">Customers</a>
                      <a class="collapse-item" href="Suppliers.php">Suppliers</a>
                      <a class="collapse-item" href="index.php">Payroll</a>
                      <!-- <a class="collapse-item" href="Creditors.php">Creditors</a> -->
                      <?php endif; ?>
                 

                  <!-- Visible for all users -->
                  <?php if ($userRole !== 'Admin') : ?>
                  <a class="collapse-item" href="fuel.php">Fuel</a>
                  <a class="collapse-item" href="sales.php">Sales</a>
                  <a class="collapse-item" href="Suppliers.php">Suppliers</a>
                  <?php endif; ?>
              </div>
          </div>
      </li>

    
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
          Setting
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
              aria-expanded="true" aria-controls="collapsePages">
              <i class="fas fa-fw fa-folder"></i>
              <span>Others</span>
          </a>
          <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Details</h6>
                  <a class="collapse-item" href="profile.php">Profile</a>
                  <a class="collapse-item" href="settings.php">Settings</a>
                  <a class="collapse-item" data-toggle="modal" data-target="#logoutModal" href="#">Logout</a>
                  <div class="collapse-divider"></div>

              </div>
          </div>
      </li>

      <!-- Nav Item - Charts -->
      <!-- <li class="nav-item">
    <a class="nav-link" href="charts.html">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Charts</span></a>
</li> -->


      <!-- Nav Item - Tables -->
      <!-- <li class="nav-item">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>Settings</span></a>
</li> -->

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

      <!-- Sidebar Message -->
      <!-- <div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
    <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
    <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
</div> -->

  </ul>
  <!-- End of Sidebar -->