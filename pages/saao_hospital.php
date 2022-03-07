<?php 
    $pagename="saao";
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
  <title>STATUS OF APPROPRIATIONS, ALLOTMENT AND OBLIGATION</title>
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
      
      $saao_nav_item="menu-open";
      $saao_nav_link="active";
      $saao_hospital="active";
      require_once('./sidebar.php');
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <h1>STATUS OF APPROPRIATIONS, ALLOTMENT AND OBLIGATION-HOSPITALS</h1>
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
        <div class="row">
            <form method="POST">
                <div class="pull-right">
                    <div class="form-row">
                        <!--display year combobox -->
                        <div class="form-group">
                            <div class="col-auto">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-light" style="background-color:#004d00;"><b>HOSPITALS:</b></div>
                                    </div>
                                    
                                        <input type="text" list="function_list" id="display_function" name="rp_function" class="form-control display_function" autocomplete="off" />
                                        <datalist class="function_list" id="function_list">
                                            <?php 
                                                $select_query1 = mysqli_query($connection,"SELECT * from tbl_function WHERE type='HOSPITAL' ORDER BY function_code ASC");
                                                echo"<option value='ALL'></option>";
                                                while($row = mysqli_fetch_array($select_query1)){ 
                                                echo "<option value='".$row['function_code']."'>".$row['description']."</option> ";
                                                }
                                            ?>
                                        </datalist>
                                </div>
                            </div>
                        </div><!-- end display year combobox -->
                        

                        <!--display generate button -->
                        <div class="form-group">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-danger btn-block" id="btn_filter" name="btn_filter"><i class="fas fa-filter"></i><b> FILTER</b></button>
                            </div>
                        </div><!-- end display generate button -->


                    </div>
                </div>
            </form>
        </div>
        <!-- /.end div for FORM -->


        <?php
        if (isset($_POST['btn_filter'])) {
        ?>

        <div class="row">
            <div class="col-12">
                <div class='card'>
                    <div class="card-header text-primary " >
                        <h3 class="card-title font-weight-bold"><i class="fas fa-list"></i></h3>
                        <div class="card-tools">
                            <form method='POST' action='../report/report_saao_hospital.php' target="_blank">
                                <input type='hidden' name='function' value='<?php echo $value['description'] ?>' />
                                <input type='hidden' name='function_code' value='<?php echo $_POST['rp_function'] ?>' />  
                                <input type='hidden' name='budget_year' value='<?php echo $curYear; ?>' />    
                                <button type='submit' class='btn btn-info btn-block text-light' id='btn_generate' name='btn_generate'><i class='fas fa-print'></i><b> GENERATE SAAO REPORT</b></button>
                            </form>
                        </div>
                    </div>
                    <div class='card-body shadow'>
                        <div class="table-responsive">
                            <table id="dataTables-example2" class="table table-striped table-bordered table-sm " style=" width:100%">
                                <thead class="text-light" style="background-color:#03254c; ">
                                <tr>
                                    <th  style='text-align:center; width: 30%'>Function/Program/Project/Activity</th>
                                    <th  style='text-align:center; width: 15%'>APPROPRIATIONS </th>
                                    <th  style='text-align:center; width: 10%'>ALLOTMENT</th>
                                    <th  style='text-align:center; width: 15%'>OBLIGATIONS</th>
                                    <th  style='text-align:center; width: 15%'>BALANCE ALLOTMENT</th>
                                    <th  style='text-align:center; width: 15%'>BALANCE APPROPRIATION</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $bal_appropriation_ps=0;
                                        $bal_allotment_ps=0;
                                        $bal_appropriation_mooe=0;
                                        $bal_appropriation_co=0;
                                        $bal_allotment_co=0;
                                        if($_POST['rp_function']=="ALL"){
                                            $query="SELECT f.description, f.type,
                                            (SELECT COALESCE(SUM(app.amount_appropriation), 0)  FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code = acc.account_code WHERE app.function_code=f.function_code AND app.budget_year='".$curYear."' AND acc.acc_category='PERSONAL SERVICES')AS appropriation_ps, 
                                            (SELECT COALESCE(SUM(app.amount_appropriation), 0)  FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code = acc.account_code WHERE app.function_code=f.function_code AND app.budget_year='".$curYear."' AND acc.acc_category='MAINTENANCE AND OTHER OPERATING EXPENSES')AS appropriation_mooe,
                                            (SELECT COALESCE(SUM(app.amount_appropriation), 0)  FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code = acc.account_code WHERE app.function_code=f.function_code AND app.budget_year='".$curYear."' AND acc.acc_category='CAPITAL OUTLAY')AS appropriation_co, 
                                            (SELECT COALESCE(SUM(al.total_allotment), 0)  FROM tbl_allotment as al INNER JOIN tbl_accounts as acc ON al.account_code = acc.account_code WHERE al.function_code=f.function_code AND al.budget_year='".$curYear."' AND acc.acc_category='PERSONAL SERVICES')AS allotment_ps,
                                            (SELECT COALESCE(SUM(al.total_allotment), 0)  FROM tbl_allotment as al INNER JOIN tbl_accounts as acc ON al.account_code = acc.account_code WHERE al.function_code=f.function_code AND al.budget_year='".$curYear."' AND acc.acc_category='MAINTENANCE AND OTHER OPERATING EXPENSES')AS allotment_mooe,
                                            (SELECT COALESCE(SUM(al.total_allotment), 0)  FROM tbl_allotment as al INNER JOIN tbl_accounts as acc ON al.account_code = acc.account_code WHERE al.function_code=f.function_code AND al.budget_year='".$curYear."' AND acc.acc_category='CAPITAL OUTLAY')AS allotment_co,
                                            (SELECT COALESCE(SUM(ex.amount), 0)  FROM tbl_expenses as ex WHERE ex.function=f.function_code AND YEAR(ex.trans_date)='".$curYear."' AND ex.allotment_class='PS')AS obligation_ps,
                                            (SELECT COALESCE(SUM(ex.amount), 0)  FROM tbl_expenses as ex WHERE ex.function=f.function_code AND YEAR(ex.trans_date)='".$curYear."' AND ex.allotment_class='MOOE')AS obligation_mooe,
                                            (SELECT COALESCE(SUM(ex.amount), 0)  FROM tbl_expenses as ex WHERE ex.function=f.function_code AND YEAR(ex.trans_date)='".$curYear."' AND ex.allotment_class='CO')AS obligation_co
                                            FROM tbl_function as f WHERE f.type='HOSPITAL' ORDER BY f.function_code ASC"; 
                                        }
                                        else{
                                            $query="SELECT f.description, f.type,
                                            (SELECT COALESCE(SUM(app.amount_appropriation), 0)  FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code = acc.account_code WHERE app.function_code=f.function_code AND app.budget_year='".$curYear."' AND acc.acc_category='PERSONAL SERVICES')AS appropriation_ps, 
                                            (SELECT COALESCE(SUM(app.amount_appropriation), 0)  FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code = acc.account_code WHERE app.function_code=f.function_code AND app.budget_year='".$curYear."' AND acc.acc_category='MAINTENANCE AND OTHER OPERATING EXPENSES')AS appropriation_mooe,
                                            (SELECT COALESCE(SUM(al.total_allotment), 0)  FROM tbl_allotment as al INNER JOIN tbl_accounts as acc ON al.account_code = acc.account_code WHERE al.function_code=f.function_code AND al.budget_year='".$curYear."' AND acc.acc_category='PERSONAL SERVICES')AS allotment_ps,
                                            (SELECT COALESCE(SUM(al.total_allotment), 0)  FROM tbl_allotment as al INNER JOIN tbl_accounts as acc ON al.account_code = acc.account_code WHERE al.function_code=f.function_code AND al.budget_year='".$curYear."' AND acc.acc_category='MAINTENANCE AND OTHER OPERATING EXPENSES')AS allotment_mooe,
                                            (SELECT COALESCE(SUM(ex.amount), 0)  FROM tbl_expenses as ex WHERE ex.function=f.function_code AND YEAR(ex.trans_date)='".$curYear."' AND ex.allotment_class='PS')AS obligation_ps,
                                            (SELECT COALESCE(SUM(ex.amount), 0)  FROM tbl_expenses as ex WHERE ex.function=f.function_code AND YEAR(ex.trans_date)='".$curYear."' AND ex.allotment_class='MOOE')AS obligation_mooe
                                            FROM tbl_function as f WHERE f.function_code='".$_POST['rp_function']."'"; 
                                        }
                                        $gt_appropriation=0;
                                        $gt_allotment=0;
                                        $gt_obligation=0;
                                        $gt_bal_appropriation=0;
                                        $gt_bal_allotment=0;
                                         
                                        $sql=mysqli_query($connection,$query);
                                        while($row=mysqli_fetch_array($sql)){
                                            $bal_appropriation_ps=$row['appropriation_ps']-$row['allotment_ps'];
                                            $bal_allotment_ps=$row['allotment_ps']-$row['obligation_ps'];
                                            $bal_appropriation_mooe=$row['appropriation_mooe']-$row['allotment_mooe'];
                                            $bal_allotment_mooe=$row['allotment_mooe']-$row['obligation_mooe'];
                                            

                                            $t_appropriation=$row['appropriation_ps']+$row['appropriation_mooe'];
                                            $t_allotment=$row['allotment_ps']+$row['allotment_mooe'];
                                            $t_obligation=$row['obligation_ps']+$row['obligation_mooe'];
                                            $t_bal_appropriation=$bal_appropriation_ps+$bal_appropriation_mooe;
                                            $t_bal_allotment=$bal_allotment_ps+$bal_allotment_mooe;

                                            $gt_appropriation+=$row['appropriation_ps']+$row['appropriation_mooe'];
                                            $gt_allotment+=$row['allotment_ps']+$row['allotment_mooe'];
                                            $gt_obligation+=$row['obligation_ps']+$row['obligation_mooe'];
                                            $gt_bal_appropriation+=$bal_appropriation_ps+$bal_appropriation_mooe;
                                            $gt_bal_allotment+=$bal_allotment_ps+$bal_allotment_mooe;
                                    ?>

                                
                                    <tr > 
                                        <td colspan="6">&emsp;<b><?php echo $row['description'];; ?></b></td>
                                    </tr>
                                    <tr align="center"> 
                                        <td align="center" >Personal Services</td>
                                        <td ><?php echo number_format($row['appropriation_ps'],2); ?></td>
                                        <td ><?php echo number_format($row['allotment_ps'],2); ?></td>
                                        <td ><?php echo number_format($row['obligation_ps'],2); ?></td>
                                        <td ><?php echo number_format($bal_allotment_ps,2); ?></td>
                                        <td ><?php echo number_format($bal_appropriation_ps,2); ?></td>
                                        
                                    </tr> 
                                    
                                    <tr align="center"> 
                                        <td >Maint. & Other Operating Expenses</td>
                                        <td><?php echo number_format($row['appropriation_mooe'],2); ?></td>
                                        <td ><?php echo number_format($row['allotment_mooe'],2); ?></td>
                                        <td ><?php echo number_format($row['obligation_mooe'],2); ?></td>
                                        <td><?php echo number_format($bal_allotment_mooe,2); ?></td>
                                        <td ><?php echo number_format($bal_appropriation_mooe,2); ?></td>
                                        
                                    </tr>
                                    
                                    


                                    <tr align="center"> 
                                        <td>TOTAL</td>
                                        <td><?php echo number_format($t_appropriation,2); ?></td>
                                        <td ><?php echo number_format($t_allotment,2); ?></td>
                                        <td ><?php echo number_format($t_obligation,2); ?></td>
                                        <td><?php echo number_format($t_bal_allotment,2); ?></td>
                                        <td ><?php echo number_format($t_bal_appropriation,2); ?></td>
                                        
                                    </tr>
                                    
                                    
                                    <?php
                                        }
                                     ?>   
                                   
                        
                                </tbody> 
                                <?php
                                if($_POST['rp_function']=="ALL"){
                                            ?>
                                    <tfoot class="text-light" style="background-color:#03254c; ">
                                    <tr align="center"> 
                                        <td>GRAND TOTAL</td>
                                        <td><?php echo number_format($gt_appropriation,2); ?></td>
                                        <td ><?php echo number_format($gt_allotment,2); ?></td>
                                        <td ><?php echo number_format($gt_obligation,2); ?></td>
                                        <td><?php echo number_format($gt_bal_allotment,2); ?></td>
                                        <td ><?php echo number_format($gt_bal_appropriation,2); ?></td>
                                        
                                    </tr>
                                </tfoot>
                                    <?php
                                         }
                                    ?>     
                            </table>
                        </div> 
                    </div>   
                </div>
            </div>
        </div>
    <?php
    }else{
    ?>
    <div class="row">
            <div class="col-12">
                <div class='card'>
                    <div class='card-header d-flex  justify-content-between align-items-center' >
                        <h6 class='m-0 font-weight-bold'><i class="fas fa-list"></i></h6>
                    </div>
                    <div class='card-body shadow'>
                        <div class="table-responsive">
                            <table id="dataTables-example" class="table table-striped table-bordered table-sm " style=" width:100%">
                                <thead class="text-light" style="background-color:#03254c; ">
                                <tr>
                                    <th  style='text-align:center; width: 30%'>Function/Program/Project/Activity</th>
                                    <th  style='text-align:center; width: 15%'>APPROPRIATIONS </th>
                                    <th  style='text-align:center; width: 10%'>ALLOTMENT</th>
                                    <th  style='text-align:center; width: 15%'>OBLIGATIONS</th>
                                    <th  style='text-align:center; width: 15%'>BALANCE ALLOTMENT</th>
                                    <th  style='text-align:center; width: 15%'>BALANCE APPROPRIATION</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>      
                            </table>
                        </div> 
                    </div> 
                </div>  
            </div>
        </div>
      </div>



    <?php
    }
    ?>
      
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


