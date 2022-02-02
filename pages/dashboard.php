<?php 
    $pagename="dashboard";
    require('./session.php'); 
    require('./database.php');
    require('./season.php');
    require('./save_new_pass.php');
    require('./save_new_profile.php');
    require('./user_data.php');
    require('./query.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PROJECT-NGAS</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed">

<!-- Site wrapper -->
<div class="wrapper" >
  <!-- Navbar -->
  <?php
      require_once('./header1.php')
    ?>

  
  <?php
      $db="active";
      require_once('./sidebar.php');
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>DASHBOARD</h1>
            <p><?php echo "As of ".date_format(date_create($curDate),"F d, Y");?></p>
            <hr>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.ROW -->
        <div class="row">

          <!-- /.INFO BOX CAFOA DAILY  -->
          <div class="col-md-4">
            <div class="info-box mb-2 bg-success">
              <span class="info-box-icon"><i class="far fa-calendar"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">DAILY CAFOA </span>
                <?php 
                  $queryDailyCafoa="SELECT COUNT(obligation_id) AS daily_cafoa FROM tbl_obligation WHERE trans_date='".$curDate."'";
                  $sqlDailyCafoa=mysqli_query($connection,$queryDailyCafoa);
                  $row=mysqli_fetch_assoc($sqlDailyCafoa);
                  $dailyCafoa=$row['daily_cafoa'];
                ?>
                <span class="info-box-number"><?php echo number_format($dailyCafoa,0);  ?></span>
              </div>
            </div>
          </div>
          <!-- /.INFO BOX CAFOA DAILY -->

          <!-- /.INFO BOX MONTHLY DAILY  -->
          <div class="col-md-4">
            <div class="info-box mb-2 bg-danger">
              <span class="info-box-icon"><i class="far fa-calendar"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">MONTHLY CAFOA </span>
                <?php 
                  $queryDailyCafoa="SELECT COUNT(obligation_id) AS monthly_cafoa FROM tbl_obligation WHERE MONTH(trans_date)='".$curMonth."'";
                  $sqlDailyCafoa=mysqli_query($connection,$queryDailyCafoa);
                  $row=mysqli_fetch_assoc($sqlDailyCafoa);
                  $monthlyCafoa=$row['monthly_cafoa'];
                ?>
                <span class="info-box-number"><?php echo number_format($monthlyCafoa,0); ?></span>
              </div>
            </div>
          </div>
          <!-- /.INFO BOX MONTHLY DAILY -->

          <!-- /.INFO BOX ANNUALLY DAILY  -->
          <div class="col-md-4">
            <div class="info-box mb-2 bg-warning">
              <span class="info-box-icon"><i class="far fa-calendar"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">ANNUAL CAFOA</span>
                <?php 
                  $queryDailyCafoa="SELECT COUNT(obligation_id) AS annual_cafoa FROM tbl_obligation WHERE YEAR(trans_date)='".$curYear."'";
                  $sqlDailyCafoa=mysqli_query($connection,$queryDailyCafoa);
                  $row=mysqli_fetch_assoc($sqlDailyCafoa);
                  $annualCafoa=$row['annual_cafoa'];
                ?>
                <span class="info-box-number"><?php echo number_format($annualCafoa,0)   ?></span>
              </div>
            </div>
          </div>
          <!-- /.INFO BOX ANNUALLY DAILY -->
          
        </div>
        <!-- /.ROW -->

         <!-- /.ROW -->
        <div class="row">

          <!-- /.INFO BOX MONTHLY DAILY  -->
          <div class="col-md-6">
            <div class="info-box mb-2 bg-success">
              <span class="info-box-icon"><i class="fas fa-chart-bar"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">TOTAL APPROPRIATION </span>
                <?php 
                  $querytotal_appropriation="SELECT SUM(amount_appropriation) AS amount FROM tbl_appropriation WHERE budget_year='".$curYear."'";
                  $sqltotal_appropriation=mysqli_query($connection,$querytotal_appropriation);
                  $row=mysqli_fetch_assoc($sqltotal_appropriation);
                  $total_appropriation=$row['amount'];
                ?>
                <span class="info-box-number"><?php echo"Php. ".  number_format($total_appropriation,2)   ?></span>
              </div>
            </div>
          </div>
          <!-- /.INFO BOX MONTHLY DAILY -->

          <!-- /.INFO BOX ANNUALLY DAILY  -->
          <div class="col-md-6">
            <div class="info-box mb-2 bg-info">
              <span class="info-box-icon"><i class="fas fa-chart-line"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">TOTAL ALLOTMENT </span>
                <?php 
                  $queryTotalAllotment="SELECT SUM(first_qtr+second_qtr+third_qtr+fourth_qtr) as amount FROM tbl_allotment  WHERE budget_year='".$curYear."'";
                  $sqlTotalAllotment=mysqli_query($connection,$queryTotalAllotment);
                  $row=mysqli_fetch_assoc($sqlTotalAllotment);
                  $TotalAllotment=$row['amount'];
                ?>
                <span class="info-box-number"><?php echo"Php. ". number_format($TotalAllotment,2)   ?></span>
              </div>
            </div>
          </div>
          <!-- /.INFO BOX ANNUALLY DAILY -->
          
        </div>
        <!-- /.ROW -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
      require_once('footer.php')
    ?>

  
</div>
<!-- ./wrapper -->
<?php 
    //modals for editing
    require_once('change_pass.php'); 
    require_once('edit_profile.php'); 
?>
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
