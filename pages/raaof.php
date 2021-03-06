<?php 
    $pagename="raaof";
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
  <title>REGISTRY OF APPROPRIATIONS AND ALLOTMENTS</title>
<?php
    require_once('links.php')
  ?>
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed">

<!-- Site wrapper -->
<div class="wrapper" >
  <!-- Navbar -->
  <?php
      require_once('./header1.php')
    ?>

  
  <?php
      $raaof="active";
      require_once('./sidebar.php');
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <h1>REGISTRY OF APPROPRIATIONS, ALLOTMENTS AND OBLIGATIONS</h1>
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
                                        <div class="input-group-text text-light" style="background-color:#004d00;"><b>Function:</b></div>
                                    </div>
                                    
                                        <input type="text" list="function_list" id="display_function" name="rp_function" class="form-control display_function" autocomplete="off" /><datalist class="function_list" id="function_list"></datalist>
                                </div>
                            </div>
                        </div><!-- end display year combobox -->
                        <!--display month combobox -->
                        <div class="form-group">
                            <div class="col-auto">
                                <div class="input-group">
                                    <div class="input-group-prepend ">
                                        <div class="input-group-text text-light" style="background-color:#004d00;"><b>Month:</b></div>
                                    </div>
                                     <input type="text" list="month_list" id="display_month" name="rp_month" class="form-control display_month" autocomplete="off" /><datalist class="month_list" id="month_list"></datalist>
                                </div>
                            </div>
                        </div><!-- end display year combobox -->
                        

                        <!--display year combobox -->
                        <div class="form-group">
                            <div class="col-auto">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-light" style="background-color:#004d00;"><b>Year:</b></div>
                                    </div>
                                   <input type="text" list="year_list" id="display_year" name="rp_year" class="form-control display_year" autocomplete="off" />
                                   <datalist class="year_list" id="year_list"></datalist>
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

        
        <!-- /.display cafoa table-->
        <?php
        if (isset($_POST['btn_filter'])) {

        ?>
        <div class='card'>
            <div class="card-header text-primary " style="background-color:#004d00;">
                 <h3 class="card-title font-weight-bold text-light"></h3>
                <div class="card-tools">
                    <form method='POST' action='../report/report_raao.php' target="_blank">
                        <input type='hidden' name='function' value='<?php echo $_POST['rp_function'] ?>' />
                        <input type='hidden' name='month' value='<?php echo $_POST['rp_month'] ?>' />  
                        <input type='hidden' name='budget_year' value='<?php echo $_POST['rp_year']; ?>' />    
                        <button type='submit' class='btn btn-info btn-block btn-sm text-light' id='btn_generate' name='btn_generate'><i class='fas fa-print'></i><b> GENERATE REPORT</b></button>
                    </form>
                </div>
            </div>
            <div class='card-body shadow'>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="dataTables-example" class="table table-striped table-bordered table-sm ">
                                <thead class="text-light" style="background-color:#03254c; ">
                                    <tr>
                                        <th  style='text-align:center; width:150px'>DATE</th>
                                        <th  style='text-align:center; width:150px'>REFERENCE/<br>CAFOA No. </th>
                                        <th  style='text-align:center; width:600px'>PARTICULARS</th>
                                        <th  style='text-align:center; width:200px'>TOTAL AMOUNT <br> OF ALLOTMENT/<br>OBLIGATION</th>
                                        <?php
                                           // $query = mysqli_query($connection,"SELECT account_code,(SELECT account_description FROM tbl_accounts as acc WHERE acc.account_code=app.account_code) as account_description FROM tbl_appropriation as app WHERE app.function_code='".$_POST['rp_function']."' ORDER BY app.account_code  ASC ;");
                                            //while($row = mysqli_fetch_array($query)){       
                                        ?>.

                                        <!-- <th style="text-align:center; width:150px"><?php //echo $row['account_code']." ".$row['account_description']; ?></th> -->
                                        
                                        <?php
                                           // }
                                        ?>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $query = mysqli_query($connection,"SELECT * FROM tbl_obligation WHERE function='".$_POST['rp_function']."' AND MONTH(trans_date)='".$_POST['rp_month']."' AND YEAR(trans_date)='".$_POST['rp_year']."' AND allotment_class='PS'");
                                        while($row = mysqli_fetch_array($query)){      
                                    ?>
                                    <tr>       
                                        <td align="center" ><?php echo $row['trans_date']; ?></td>
                                        <td align="center" ><?php echo $row['obr_number']; ?></td>
                                        <td align="left" ><?php echo $row['payee']."-".$row['request']; ?></td>
                                        <td align="center"><?php echo number_format($row['total'],2); ?></td>
                                        <!-- <td align="center"><span class='badge text-light 'style="background-color:#27AE60;" ><?php //echo number_format($row['total'],2); ?></span></td> -->
                                        <?php
                                        //$query1 = mysqli_query($connection,"SELECT acc.account_code, exp.amount, exp.obligation_id FROM tbl_appropriation as acc LEFT JOIN tbl_expenses as exp ON exp.expense_code=acc.account_code AND exp.function='".$_POST['rp_function']."'AND exp.obligation_id='".$row['obligation_id']."' ORDER BY acc.account_code ASC;");
                                        //while($row1 = mysqli_fetch_array($query1)){       
                                        ?>

                                        <!-- <td style="text-align:center;"><?php //echo $row1['amount']; ?></td> -->

                                        <?php  
                                       // }
                                        ?>
                                
                                    </tr>
                                    <?php
                                        }
                                    ?>
                        
                                </tbody>      
                            </table>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        
        <?php
        }else{
        ?>
        
        <div class='card'>
            <div class="card-header text-primary " style="background-color:#004d00;">
                 <h3 class="card-title font-weight-bold text-light">LIST OF CAFOA</h3>
                <div class="card-tools">
                    
                </div>
            </div>
            <div class='card-body shadow'>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="dataTables-example" class="table table-striped table-bordered table-sm ">
                                <thead class="text-light" style="background-color:#03254c; ">
                                    <tr>
                                        <th  style='text-align:center; width:150px'>DATE</th>
                                        <th  style='text-align:center; width:150px'>REFERENCE/<br>CAFOA No. </th>
                                        <th  style='text-align:center; width:600px'>PARTICULARS</th>
                                        <th  style='text-align:center; width:200px'>TOTAL AMOUNT <br> OF ALLOTMENT/<br>OBLIGATION</th>
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

<script>
     $(document).ready(function() {
            $('div').on('click', '.display_function', function() {

                $.ajax({ //create an ajax request to display.php
                    type: "POST",
                    url: "display_function.php",
                    dataType: "html", //expect html to be returned                
                    success: function(response) {
                        $(".function_list").html(response);
                        //alert(response);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('div').on('click', '.display_month', function() {

                $.ajax({ //create an ajax request to display.php
                    type: "POST",
                    url: "display_month.php",
                    dataType: "html", //expect html to be returned                
                    success: function(response) {
                        $(".month_list").html(response);
                        //alert(response);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('div').on('click', '.display_year', function() {

                $.ajax({ //create an ajax request to display.php
                    type: "POST",
                    url: "display_year.php",
                    dataType: "html", //expect html to be returned                
                    success: function(response) {
                        $(".year_list").html(response);
                        //alert(response);
                    }
                });
            });
        });
</script>