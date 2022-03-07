<?php 
    $pagename="appropriation_hospital";
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
  <title>APPROPRIATION</title>
<?php
    require_once('links.php')
  ?>
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">

<!-- Site wrapper -->
<div class="wrapper" >
  <!-- Navbar -->
  <?php
      require_once('./header1.php')
    ?>

  
  <?php
      
      $appropriation_nav_item="menu-open";
      $appropriation_nav_link="active";
      $appropriation_hospital="active";
      require_once('./sidebar.php');
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <h1>APPROPRIATIONS: HOSPITALS</h1>
            <p><?php echo "Today is   ".date_format(date_create($curDate),"F d, Y");?></p>
           
            <hr>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

       


        <!-- /.display table -->
        <div class="row">
            <div class="col-12">
              
                
                  <div class="table-responsive">
                      <table id="dataTables-example" class="table table-striped table-bordered table-sm " style="text-align:center; width:100%">
                          <thead class="text-light" style="background-color:#03254c; ">
                            <tr>
                              <th style="text-align:center; width:10%">CODE</th>
                              <th style="text-align:center; width:30%">OFFICE</th>
                              <!-- <th style="text-align:center; width:10%">PS</th>
                              <th style="text-align:center; width:10%">MOOE</th>
                              <th style="text-align:center; width:10%">CO</th> -->
                              <th style="text-align:center; width:20%">APPROPRIATION</th>
                              <th style="text-align:center; width:10%">ACTION</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $appro="";
                            $bg="";
                            $query = mysqli_query($connection,"SELECT fc.function_id,fc.function_code,fc.description, 
                            (SELECT COALESCE(SUM(app.amount_appropriation), 0) as aa FROM tbl_appropriation as app WHERE app.function_code=fc.function_code AND app.budget_year='".$curYear."'GROUP BY app.function_code) AS appropriation, 
                            (SELECT COALESCE(SUM(app.amount_appropriation), 0) as aa FROM tbl_appropriation as app INNER JOIN tbl_accounts as ac ON ac. account_code=app.account_code  WHERE app.function_code=fc.function_code AND  app.budget_year='".$curYear."' AND ac.acc_category='PERSONAL SERVICES' GROUP BY app.function_code)as PS, 
                            (SELECT COALESCE(SUM(app.amount_appropriation), 0) as aa FROM tbl_appropriation as app INNER JOIN tbl_accounts as ac ON ac. account_code=app.account_code  WHERE app.function_code=fc.function_code AND  app.budget_year='".$curYear."' AND ac.acc_category='MAINTENANCE AND OTHER OPERATING EXPENSES' GROUP BY app.function_code)as MOOE, 
                            (SELECT COALESCE(SUM(app.amount_appropriation), 0) as aa FROM tbl_appropriation as app INNER JOIN tbl_accounts as ac ON ac. account_code=app.account_code  WHERE app.function_code=fc.function_code AND  app.budget_year='".$curYear."' AND ac.acc_category='CAPITAL OUTLAY' GROUP BY app.function_code)as CO 
                            FROM tbl_function as fc WHERE fc.type='HOSPITAL'");
                                while($row = mysqli_fetch_array($query)){  
                                  if($row["appropriation"]==null)  {
                                    $appro="NO APPROPRIATION YET";
                                    $bg="disabled";
                                  }   
                                  else{
                                    $appro=number_format($row["appropriation"],2);
                                    $bg="";
                                  }
                            ?>
                            <tr>       
                              <td align="center" ><?php echo $row['function_code']; ?></td>
                              <td align="left" ><?php echo $row['description']; ?></td>
                            <!-- <td align="center" ><?php //echo number_format($row["PS"],2); ?></td>
                            <td align="center"><?php //echo number_format($row["MOOE"],2); ?></td>
                            <td align="center"><?php //echo number_format($row["CO"],2); ?></td> -->
                              <td align="center"><?php echo $appro; ?></td>
                              <td align="center"><a href="<?php echo 'appropriation_details.php?id='.$row["function_id"].'&&yr='.$curYear.'&&type=HOSPITAL'; ?>" class="btn btn-sm btn-danger"><i class="fas fa-info"></i> VIEW DETAILS</a></td>
                              <!-- <td align="center">
                                <div class="progress-group">
                                  <div class="progress progress-lg">
                                    <div class="progress-bar bg-primary" style="width: 100%">100%</div>
                                  </div>
                                </div>
                              </td> -->
                            </tr>
                            

                            <?php
                                }
                            ?>
                          </tbody>      
                      </table>
                  </div>   
                
            
        </div>
        <!-- /. end display table -->

        
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
    require_once('links_script.php');
?>
</body>
</html>
