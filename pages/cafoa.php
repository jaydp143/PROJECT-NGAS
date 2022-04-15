<?php 
    $pagename="cafoa";
    require('./session.php'); 
    require('./database.php');
    require('./season.php');
    require('./save_new_pass.php');
    require('./save_new_profile.php');
    require('./user_data.php');
    require('./query.php');
?>

<?php
if (isset($_POST['deleteBtn'])) {
    $no = $_POST['id'];
    mysqli_query($connection, "DELETE from tbl_obligation WHERE obligation_id='$no'");
    mysqli_query($connection, "DELETE from tbl_expenses WHERE obligation_id='$no'");
    echo "<script>window.location.href = './cafoa.php'</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CERTIFICATION ON APPROPRIATIONS, FUND AND OBLIGATION OF ALLOTMENT (CAFOA)</title>
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
    $cafoa_nav_item="menu-open";
    $cafoa_nav_link="active";
    $daily_cafoa="active";
    require_once('./sidebar.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
               <a data-toggle="modal" data-target="#addModal" class="btn btn-primary float-right"><span class="fas fa-plus"></span> <b> CREATE NEW CAFOA ENTRY</b></a>
               
            <h1>CERTIFICATION ON APPROPRIATIONS, FUND AND OBLIGATION OF ALLOTMENT (CAFOA)</h1>
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
                                        <div class="input-group-text text-light" style="background-color:#004d00;"><b>Search by:</b></div>
                                    </div>                                        
                                        <select class="custom-select form-control-border"  id="cmb_search" name="cmb_search">
                                            <option value="trans_date">Date</option>
                                            <option value="obr_number">CAFOA Number</option>
                                            <option value="function">PPC</option>
                                            <option value="payee">Payee</option>
                                            <option value="pr_number">PR#/RIS#</option>
                                            <option value="request">Particulars</option>
                                            <option value="allotment_class">Allotment Class</option>
                                            <option value="reference_number">Reference Number</option>
                                        </select>
                                </div>
                            </div>
                        </div><!-- end display year combobox -->
                        <!--display month combobox -->
                        <div class="form-group">
                            <div class="col-auto">
                                <div class="input-group">
                                    <div class="input-group-prepend ">
                                        <div class="input-group-text text-light" style="background-color:#004d00;"><b>Type Keyword:</b></div>
                                    </div>
                                     <input type="text" list="month_list" id="txt_keyword" name="txt_keyword" class="form-control display_month" autocomplete="off" />
                                </div>
                            </div>
                        </div><!-- end display year combobox -->
                      
                        <!--display generate button -->
                        <div class="form-group">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-danger btn-block" id="btn_filter" name="btn_filter"><i class="fas fa-filter"></i><b> SEARCH</b></button>
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
            <div class="card-header text-primary ">
                 <h3 class="card-title font-weight-bold ">LIST OF CAFOA</h3>
                <div class="card-tools">
                    
                </div>
            </div>
            <div class='card-body shadow'>
                <div class="table-responsive ml-2 mr-2">

                    <table id="dataTables-example" class="table table-striped table-bordered table-sm " style=" width:100%">
                            <thead class="text-light" style="background-color:#03254c; ">
                            <tr>
                                <th style="text-align:center; width: 8%"><br>DATE</th>
                                <th style="text-align:center; width: 7%">CAFOA NO.</th>
                                <th style="text-align:center; width: 7%">PPC</th>
                                <th style="text-align:center; width: 15%">PAYEE</th>
                                <th style="text-align:center; width: 5%">PR#/RIS#</th>
                                <th style="text-align:center; width: 30%">PARTICULARS</th>
                                <th style="text-align:center; width: 10%">ALLOTMENT CLASS</th>
                                <th style="text-align:center; width: 10%">TOTAL</th>
                                <th style="text-align:center; width: 5%">REF NO.</th>
                                <th style="text-align:center; width: 5%">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                           
                            $query = "SELECT * from tbl_obligation  WHERE ".$_POST['cmb_search']." LIKE '%".$_POST['txt_keyword'] . "%'";
                            
                            //$query="SELECT * FROM tbl_obligation as ob WHERE MONTH(ob.trans_date) =  MONTH(CURDATE()) ORDER BY ob.obr_number ASC";
                            $sql = mysqli_query($connection, $query);
                            $rowCount = 1;
                            while ($row = mysqli_fetch_array($sql)) {
                                $date = date_create($row['trans_date']);
                            ?>

                                <tr align="left">

                                    <td><?php echo date_format($date, 'm-d-y'); ?></td>
                                    <td><?php echo $row['obr_number']; ?></td>
                                    <td><?php echo $row['function']; ?></td>
                                    <td><?php echo $row['payee']; ?></td>
                                    <td><?php echo $row['pr_number']; ?></td>
                                    <td><?php echo $row['request']; ?></td>
                                    <td><?php echo $row['allotment_class']; ?></td>
                                    <td><?php echo number_format($row['total'], 2); ?></td>
                                    <td><?php echo $row['reference_number']; ?></td>
                                    <td align="center">
                                        <div class="btn-group">
                                            <form name="edit_expense" id="edit_expense" method="POST">
                                                <input type="hidden" name="id" id="id" value="<?php echo $row["obligation_id"]; ?>" class="form-control" />
                                                <a href="edit_cafoa.php?id=<?php echo $row["obligation_id"]; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                <!-- <a class="btn btn-success btn-block text-light btn-sm " data-toggle="modal" data-target="#editModal<?php //echo $row["obligation_id"]; 
                                                                                                                                                        ?>"><i class="fas fa-plus-square"></i></a>                                                     -->
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="confirm_del();return false;" name="deleteBtn" id="deleteBtn" title="Delete User" id="Delete_id"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
                <div class="my-2">
                    
                </div>
            </div>
        </div>

        <?php } else {
        ?>
        <div class='card'>
                    <div class="card-header text-primary " >
                 <h3 class="card-title font-weight-bold"><i class="fas fa-list"></i>&emsp;LIST OF CAFOA</h3>
                <div class="card-tools">
                   
                </div>
            </div>
                <div class='card-body shadow'>
                    <div class="table-responsive ml-2 mr-2">

                        <table id="dataTables-example" class="table table-striped table-bordered table-sm " style="width:100%">
                                <thead class="text-light" style="background-color:#03254c; ">
                                <tr>
                                    <th style="text-align:center; width: 8%"><br>DATE</th>
                                    <th style="text-align:center; width: 7%">CAFOA NO.</th>
                                    <th style="text-align:center; width: 7%">PPC</th>
                                    <th style="text-align:center; width: 15%">PAYEE</th>
                                    <th style="text-align:center; width: 5%">PR#/RIS#</th>
                                    <th style="text-align:center; width: 30%">PARTICULARS</th>
                                    <th style="text-align:center; width: 10%">ALLOTMENT CLASS</th>
                                    <th style="text-align:center; width: 10%">TOTAL</th>
                                    <th style="text-align:center; width: 5%">REF NO.</th>
                                    <th style="text-align:center; width: 5%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                                            </tbody>
                        </table>
                    </div>
                </div>
        </div>

        <?php } ?>
        <!-- /.end display cafoa table-->

        
        






         
      
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

<!--account Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title m-0 font-weight-bold text-light" id="exampleModalLabel"><i class="fas fa-file-alt"></i> CREATE NEW CAFOA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="add_expense" id="add_expense">
                    <div class="form-group row">
                        <label for="payee" class="col-md-2 col-form-label" align="right"><b>OBLIGATION NO.:</b></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="obr_number" id="obr_number" autocomplete="off" required>
                        </div>
                        <label for="payee" class="col-md-3 col-form-label" align="right"><b>OBLIGATION DATE:</b></label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name="trans_date" id="trans_date" value="<?php $date = date('Y-m-d');
                                                                                                                echo $date;   ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="payee" class="col-md-2 col-form-label" align="right"><b>PR#/RIS#:</b></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="pr_number" id="pr_number" autocomplete="off" required>
                        </div>
                        <label class="col-md-3 col-form-label" align="right"><b>PR#/RIS# DATE:</b></label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name="pr_date" id="pr_date">
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label" align="right"><b>REQUEST:</b></label>
                        <div class="col-md-10">
                            
                            <input list="request_list" id="display_request" name="request" class="form-control display_request">
                            <datalist class="request_list" id="request_list">
                                <?php 
                                    $select_query1 = mysqli_query($connection,"SELECT DISTINCT request from tbl_obligation");
                                    while($row = mysqli_fetch_array($select_query1)){ 
                                    echo "<option>".$row['request']."</option> ";
                                    }
                                ?>
                            </datalist>      
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label" align="right"><b>PAYEE:</b></label>
                        <div class="col-md-10">
                            <input list="payee_list" id="display_payee" name="payee" class="form-control display_payee">
                            <datalist class="payee_list" id="payee_list">
                                <?php 
                                    $select_query1 = mysqli_query($connection,"SELECT DISTINCT payee from tbl_obligation");
                                    while($row = mysqli_fetch_array($select_query1)){ 
                                    echo "<option>".$row['payee']."</option> ";
                                    }
                                ?>
                            </datalist> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="payee" class="col-sm-2 col-form-label" align="right"><b>FUNCTION:</b></label>
                        <div class="col-md-4">
                            <input list="f_list" id="display_f" name="function" class="form-control display_f">
                            <datalist class="f_list" id="f_list">
                                <?php 
                                    $select_query1 = mysqli_query($connection,"SELECT DISTINCT function_code, description from tbl_function");
                                    while($row = mysqli_fetch_array($select_query1)){ 
                                    echo "<option value='".$row['function_code']."'>".$row['description']."</option> ";
                                    }
                                ?>
                            </datalist>
                        </div>
                        <label for="payee" class="col-sm-2 col-form-label" align="right"><b>ALLOTMENT CLASS:</b></label>
                        <div class="col-md-4">
                            <input type="text" list="allotment_class_list" id="display_allotment_class" name="allotment_class" class="form-control display_allotment_class" autocomplete="off" /><datalist class="allotment_class_list" id="allotment_class_list"></datalist>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-sm" id="dynamic_field" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    EXPENSE CODE
                                </th>
                                <th class="text-center">
                                    AMOUNT
                                </th>
                                <th class="text-center">
                                    ACTION
                                </th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td align="center"><input type="text" list="expense_code_list" id="display_expense_code" name="expense_code[]" class="form-control display_expense_code" autocomplete="off" /><datalist class="expense_code_list" id="expense_code_list"></datalist></td>
                                <td align="center"><input type="text" class="form-control" name="amount[]" onkeypress="return isNumber(event)" autocomplete="off"></td>
                                <td align="center"> <a href="#" class="btn btn-primary btn-sm" id="add_row" name="add_row"><i class="fas fa-plus"> </i></a></td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <input type="hidden" name='total_amount' id="total_amount" placeholder="00.00" class="form-control" />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="button" name="submit" id="submit" class="btn btn-success " value="Submit" />
                </form>
            </div>
        </div>
    </div>




    <script>
        function confirm_del() {
            if (confirm("Are you sure you want to delete?") == 1) {
                document.getElementById('deleteBtn').submit();
            }
        }


        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode != 46)) {
                return false;
            }
            return true;
        }

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

        $(document).ready(function() {
            $('div').on('click', '.display_allotment_class', function() {

                $.ajax({ //create an ajax request to display.php
                    type: "POST",
                    url: "display_allotment_class.php",
                    dataType: "html", //expect html to be returned                
                    success: function(response) {
                        $(".allotment_class_list").html(response);
                        //alert(response);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('tr').on('click', '.display_expense_code', function() {

                $.ajax({ //create an ajax request to display.php
                    type: "POST",
                    url: "display_expense_code.php",
                    dataType: "html", //expect html to be returned                
                    success: function(response) {
                        $(".expense_code_list").html(response);
                        //alert(response);
                    }
                });
            });
        });


        // $(document).ready(function() {

        //     $('.form-group').on('input', '.prc', function() {
        //         var totalSum = 0;
        //         $('.prc').each(function() {
        //             var inputVal = $(this).val();
        //             if ($.isNumeric(inputVal)) {
        //                 totalSum += parseFloat(inputVal);
        //             }
        //         });
        //         $('#total').val(totalSum);
        //     });
        // });

        $(document).ready(function() {
            var i = 1;
            $('#add_row').click(function() {
                i++;
                $('#dynamic_field').append('<tr id="row' + i + '"><td align="center"><input type="text" list="expense_code_list" id="display_expense_code" name="expense_code[]"  class="form-control display_expense_code" autocomplete="off" /><datalist class="expense_code_list" id="expense_code_list"></datalist></td><td align="center"><input type="text" autocomplete="off" class="form-control" name="amount[]" onkeypress="return isNumber(event)"></td><td align="center"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove btn-sm"><i class="fas fa-trash-alt"></i></button></td></tr>');
            });
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
        });
        $(document).ready(function() {
            $('#submit').click(function() {
                $.ajax({
                    url: "add_cafoa.php",
                    method: "POST",
                    data: $('#add_expense').serialize(),
                    success: function(data) {
                        alert(data);
                        window.location.href = 'cafoa.php'
                        $('#add_expense')[0].reset();
                    }
                })
            });
        });

        $(document).ready(function() {
            $('#edit').click(function() {
                $.ajax({
                    url: "update_cafoa.php",
                    method: "POST",
                    data: $('#edit_expense').serialize(),
                    success: function(data) {
                        alert(data);
                        window.location.href = '/cafoa.php'
                        $('#edit_expense')[0].reset();
                    }
                })
            });
        });
    </script>
