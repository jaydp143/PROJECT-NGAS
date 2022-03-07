<?php 
    $pagename="allotment_hospitals";
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
  <title>ALLOTMENT</title>
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
      
        $allotment_nav_item="menu-open";
        $allotment_nav_link="active";
        $allotment_hospital="active";
        require_once('./sidebar.php');
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <h1>ALLOTMENTS: HOSPITALS</h1>
            <p><?php echo "Today is   ".date_format(date_create($curDate),"F d, Y");?></p>
           
            <hr>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

       <!-- /.div for FORM -->
        <!-- <div class="row ">
            <form method="POST">
                    <div class="form-row pull-right">                      -->
                        

                        <!--display year combobox -->
                        <!-- <div class="form-group ">
                            <div class="col-auto">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text  text-light" style="background-color:#004d00;"><b>Year:</b></div>
                                    </div>
                                    <select id="rp_year" name="rp_year" class="form-control">
                                        <option></option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                        <!-- end display year combobox -->

                        <!--display generate button -->
                        <!-- <div class="form-group">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-danger btn-block" id="btn_filter" name="btn_filter" ><i class="fas fa-filter"></i><b> FILTER</b></button>
                            </div>
                        </div> -->
                        <!-- end display generate button -->


                    <!-- </div>
            </form>
        </div> -->
        <!-- /.end div for FORM -->

        
        
        <div class="row">
            <div class="col-12">
               
                    <div class="table-responsive">
                        <table id="dataTables-example" class="table table-striped table-bordered table-sm " style="text-align:center; width:100%">
                            <thead class="text-light" style="background-color:#03254c; ">
                            <tr>
                                <th style="text-align:center; width:8%">CODE</th>
                                <th style="text-align:center; width:22%">OFFICE</th>
                                <th style="text-align:center; width:10%">APPROPRIATION</th>
                                <th style="text-align:center; width:10%">FIRST QTR</th>
                                <th style="text-align:center; width:10%">SECOND QTR</th>
                                <th style="text-align:center; width:10%">THIRD QTR</th>
                                <th style="text-align:center; width:10%">FOURTH QTR</th>
                                <th style="text-align:center; width:10%">TOTAL<br>ALLOTMENT</th>
                                <th style="text-align:center; width:10%">STATUS</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $location="allotment_details";
                                $query = mysqli_query($connection,"SELECT fc.function_id,fc.function_code,fc.description, 
                                 (SELECT COALESCE(SUM(al.amount_appropriation), 0) FROM tbl_appropriation as al WHERE al.function_code=fc.function_code AND al.budget_year='".$curYear."'GROUP BY al.function_code) AS appropriation,
                                (SELECT COALESCE(SUM(al.first_qtr), 0) FROM tbl_allotment as al WHERE al.function_code=fc.function_code AND al.budget_year='".$curYear."'GROUP BY al.function_code) AS first,
                                (SELECT COALESCE(SUM(al.second_qtr), 0) FROM tbl_allotment as al WHERE al.function_code=fc.function_code AND al.budget_year='".$curYear."'GROUP BY al.function_code) AS second, 
                                (SELECT COALESCE(SUM(al.third_qtr), 0) FROM tbl_allotment as al WHERE al.function_code=fc.function_code AND al.budget_year='".$curYear."'GROUP BY al.function_code) AS third,
                                (SELECT COALESCE(SUM(al.fourth_qtr), 0) FROM tbl_allotment as al WHERE al.function_code=fc.function_code AND al.budget_year='".$curYear."'GROUP BY al.function_code) AS fourth,
                                (SELECT COALESCE(SUM(al.total_allotment), 0) FROM tbl_allotment as al WHERE al.function_code=fc.function_code AND al.budget_year='".$curYear."'GROUP BY al.function_code) AS total_allotment
                                FROM tbl_function as fc WHERE fc.type='HOSPITAL'");
                                while($row = mysqli_fetch_array($query)){   
                                    if($row["total_allotment"]==null)  {
                                    $allot="0.00";
                                    $approp="0.00";
                                    $first="0.00";
                                    $second="0.00";
                                    $third="0.00";
                                    $fourth="0.00";
                                    $bg="disabled";
                                    }   
                                    else{
                                    $allot=number_format($row["total_allotment"],2);
                                    $approp=number_format($row['appropriation'],2);
                                    $first=number_format($row['first'],2);
                                    $second=number_format($row['second'],2);
                                    $third=number_format($row['third'],2);
                                    $fourth=number_format($row['fourth'],2);
                                    $bg="";
                                    } 
                                    
                            ?>
                            <tr>       
                                <td align="center"><?php echo $row['function_code']; ?></td>
                                <td align="left"><?php echo $row['description']; ?></td>
                                <td align="center"><?php echo $approp; ?></td>
                                <td align="center"><?php echo $first; ?></td>
                                <td align="center"><?php echo $second; ?></td>
                                <td align="center"><?php echo $third; ?></td>
                                <td align="center"><?php echo $fourth; ?></td>
                                <td align="center"><?php echo $allot; ?></td>
                                <td align="center"><a href="<?php echo 'allotment_details.php?id='.$row["function_id"].'&&yr='.$curYear.'&&type=HOSPITAL'; ?>" class="btn btn-danger btn-sm <?php //echo $bg; ?>"><i class="fas fa-info"></i> VIEW DETAILS</a></td>
                            </tr>
                            

                            <?php
                                }
                            ?>
                            </tbody>      
                        </table>
                    </div>   
                
            </div>

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
