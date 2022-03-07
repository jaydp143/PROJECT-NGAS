<aside class="main-sidebar sidebar-dark-info elevation-4  "style="background-color:#03254c;">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link elevation-4 " style="background-color:#03254c;">
      <img src="../dist/img/pang.png" alt="Pangasinan Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-dark">  FMIS</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="./dashboard.php" class="nav-link <?php echo $db; ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                      &emsp;DASHBOARD
                  </p>
                </a>
            </li>

          <!-- <li class="nav-item">
            <a href="./appropriation.php" class="nav-link <?php //echo $approp; ?>">
            <i class="far fa-calendar-alt"></i>
              <p>APPROPRIATIONS</p>
            </a>
          </li> -->

          <li class="nav-item <?php echo $appropriation_nav_item; ?>">
            <a href="#" class="nav-link <?php echo $appropriation_nav_link; ?>">
              <i class="fas fa-chart-line"></i>
              <p>
                &emsp;APPROPRIATION
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./appropriation_office.php" class="nav-link <?php echo $appropriation_office; ?>">
                &emsp;<i class="fas fa-chart-line"></i>
                  <p>&emsp; Offices</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./appropriation_hospital.php" class="nav-link <?php echo $appropriation_hospital; ?>">
                &emsp;<i class="fas fa-chart-line"></i>
                  <p>&emsp; Hospitals</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./appropriation_non_office.php" class="nav-link <?php echo $appropriation_non_office; ?>">
                 &emsp;<i class="fas fa-chart-line"></i>
                  <p>&emsp;Non-Offices</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- <li class="nav-item">
            <a href="allotment.php" class="nav-link <?php //echo $allot; ?>">
            <i class="far fa-calendar-alt"></i>
              <p>ALLOTMENTS</p>
            </a>
          </li> -->

          <li class="nav-item <?php echo $allotment_nav_item; ?>">
            <a href="#" class="nav-link <?php echo $allotment_nav_link; ?>">
              <i class="fas fa-chart-bar"></i>
              <p>
                &emsp;ALLOTMENT
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./allotment_office.php" class="nav-link <?php echo $allotment_office; ?>">
                &emsp;<i class="fas fa-chart-bar"></i>
                  <p>&emsp;Offices</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./allotment_hospital.php" class="nav-link <?php echo $allotment_hospital; ?>">
                &emsp;<i class="fas fa-chart-bar"></i>
                  <p> &emsp;Hospitals</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./allotment_non_office.php" class="nav-link <?php echo $allotment_non_office; ?>">
                &emsp;<i class="fas fa-chart-bar"></i>
                  <p>&emsp; Non-Offices</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="cafoa.php" class="nav-link <?php echo $cafoa; ?>">
            <i class="far fa-calendar-alt"></i>
              <p>&emsp;CAFOA</p>
            </a>
          </li>
          
          <li class="nav-item <?php echo $saao_nav_item; ?>">
            <a href="#" class="nav-link <?php echo $saao_nav_link; ?>">
              <i class="fas fa-chart-area"></i>
              <p>
                &emsp;SAAO
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./saao_office.php" class="nav-link <?php echo $saao_office; ?>">
                 &emsp;<i class="fas fa-chart-area"></i>
                  <p> &emsp;Offices</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./saao_hospital.php" class="nav-link <?php echo $saao_hospital; ?>">
                 &emsp;<i class="fas fa-chart-area"></i>
                  <p> &emsp;Hospitals</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./saao_non_office.php" class="nav-link <?php echo $saao_non_office; ?>">
                 &emsp;<i class="fas fa-chart-area"></i>
                  <p> &emsp;Non-Offices</p>
                </a>
              </li>
            </ul>
          </li>
         

          <li class="nav-item <?php echo $raao_nav_item; ?>">
            <a href="#" class="nav-link <?php echo $raao_nav_link; ?>">
              <i class="fas fa-chart-area"></i>
              <p>
                &emsp;RAAO
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./raao_ps.php" class="nav-link <?php echo $raao_ps; ?>">
                 &emsp;<i class="fas fa-chart-area"></i>
                  <p> &emsp;PS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./raao_mooe.php" class="nav-link <?php echo $raao_mooe; ?>">
                 &emsp;<i class="fas fa-chart-area"></i>
                  <p> &emsp;MOOE</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./raao_co.php" class="nav-link <?php echo $raao_co; ?>">
                 &emsp;<i class="fas fa-chart-area"></i>
                  <p> &emsp;CO</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item <?php echo $maintenance_nav_item; ?>">
            <a href="#" class="nav-link <?php echo $maintenance_nav_link; ?>">
              <i class="fas fa-cog"></i>
              <p>
                &emsp;MAINTENANCE
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./function.php" class="nav-link <?php echo $function; ?>">
                 &emsp;<i class="fas fa-cog"></i>
                  <p>&emsp;Functions</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./accounts.php" class="nav-link <?php echo $account_code; ?>">
                 &emsp;<i class="fas fa-cog"></i>
                  <p>&emsp;Account Codes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./allotment_classification.php" class="nav-link <?php echo $allot_class; ?>">
                 &emsp;<i class="fas fa-cog"></i>
                  <p>&emsp;<small>Allotment Classifications</small></p>
                </a>
              </li>
            </ul>
          </li>

          
          
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>