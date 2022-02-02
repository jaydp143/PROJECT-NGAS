<?php 
    $pagename="appropriation_office";
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
<body class="hold-transition sidebar-mini layout-navbar-fixed">

<!-- Site wrapper -->
<div class="wrapper" >
  <!-- Navbar -->
  <?php
      require_once('./header1.php')
    ?>

  
  <?php
      
      $approp="active";
      require_once('./sidebar.php');
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
               <?php     
                    $query="SELECT * FROM tbl_function WHERE function_id='".$_GET['id']."'";
                    $sql=mysqli_query($connection,$query);
                    $value=mysqli_fetch_assoc($sql)
                ?>
            <a data-toggle="modal" data-target="#addModal" class="btn btn-primary float-right"><span class="fas fa-plus"></span>  CREATE NEW APPROPRIATION</a>
            <h1><?php echo $value['description'] ?></h1>
            <p><?php echo "Today is   ".date_format(date_create($dateNow),"F d, Y");?></p>
           
            <hr>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php
            $sql = mysqli_query($connection, "SELECT * FROM tbl_acc_category");
            while ($rowCategory = mysqli_fetch_array($sql)) {
        ?>
        <!-- PERSONAL SERVICES -->
        <div class="card ">
            <div class="card-header text-primary ">
                <h3 class="card-title font-weight-bold"><?php echo $rowCategory['category'];?></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">

                 <!-- TABLE PERSONAL SERVICES -->  
                 <form method="POST">
                  <table id="" class="table table-striped table-sm " style="text-align:center; width:100%">
                        <thead class="text-light" style="background-color:#1167b1; ">
                          <tr>
                            <th style="text-align:center; width:20%">CODE</th>
                            <th style="text-align:center; width:40%">DESCRIPTION</th>
                            <th style="text-align:center; width:20%">APPROPRIATION</th>
                            <th style="text-align:center; width:20%">STATUS</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = mysqli_query($connection,"SELECT app.appropriation_id, app.amount_appropriation, acc.acc_category, acc.account_description, app.account_code FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON acc.account_code=app.account_code WHERE app.budget_year='2021' AND app.function_code='".$value['function_code']."' AND acc.acc_category='".$rowCategory['category']."';");
                              while($row = mysqli_fetch_array($query)){       
                          ?>
                          <tr id="row<?php echo $row['appropriation_id']; ?>">       
                            <td align="center"><?php echo $row['account_code']; ?></td>
                            <td align="left"><?php echo $row['account_description']; ?></td>
                             <td align="center"><a class="btn btn-success btn-sm"><?php echo number_format($row['amount_appropriation'],2); ?></a></td>
                            <td align="center" >
                                <div class="btn-group">
                                    <a href="#editModal<?php echo $row['appropriation_id']; ?>" class="btn btn-primary btn-sm" data-toggle="modal"><i class="fa fa-edit" aria-hidden="true"></i> UPDATE</a> 
                                    <a href="#deleteModal<?php echo $row['appropriation_id']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><i class="fas fa-trash" aria-hidden="true"></i> DELETE</a> 
                                     
                                    <!--edit account Modal -->
                                <div class="modal fade" id="editModal<?php echo $row['appropriation_id']; ?>"  role="dialog" aria-labelledby="UpdateAppropriation" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                                <h5 class="modal-title text-light" id="UpdateAppropriation"><i class="fas fa-file-alt"></i> UPDATE APPROPRIATION</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                    <div class="modal-body">
                                    <form method="POST" name="update_appropriation" id="update_appropriation">

                                    <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $row['appropriation_id']; ?>" required>

                                    <div class="form-group">
                                        <label>Account Code: </label>
                                        <input type="text" name="account_code" id="id_account_code" class="form-control" readonly value="<?php echo $row['account_code']; ?>"/>
                                    </div>

                                    <div class="form-group">
                                        <label>Description: </label>
                                        <input type="text" name="description" id="description" class="form-control" readonly value="<?php echo $row['account_description']; ?>"/>
                                    </div>

                                    <div class="form-group">
                                        <label>Appropriation: </label>
                                        <input type="text" name="amount" id="amount" class="form-control" value="<?php echo $row['amount_appropriation']; ?>" onkeypress="return isNumber(event)"/>
                                    </div>

                                    </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="update" id="update" >UPDATE</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                </div>
                                <!--edit account Modal -->

                                <!--delete appropriation modal -->
                                <div class="modal fade" id="deleteModal<?php echo $row['appropriation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="DeleteAppropriation" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                                <h5 class="modal-title text-light" id="DeleteAppropriation"><i class="fas fa-file-alt"></i> DELETE APPROPRIATION</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                    <div class="modal-body">
                                    <form method="POST" name="delete_appropriation" id="delete_appropriation">

                                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $row['appropriation_id']; ?>" required>

                                        <p class="h4">ARE YOU SURE YOU WANT TO DELETE THIS?</p>

                                    </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                        <button type="button" class="btn btn-danger" name="delete" id="delete"  >DELETE</button>
                                        </div>
                                    </form>
                                    </div>

                                </div>
                                </div>
                                <!--delete appropriation modal -->
                                
                                </div>
                            </td>
                          </tr>
                               

                          <?php
                              }
                          ?>
                        </tbody>      
                    </table>
                    </form>
                  <!-- END TABLE PERSONAL SERVICES -->  
            </div> 
        </div>   
        <!-- END PERSONAL SERVICES -->  
        <?php
            }
        ?>  
 
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
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addAppropriation" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title m-0 font-weight-bold text-light" id="addAppropriation"><i class="fas fa-file-alt"></i> <?php echo $value['description'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="add_appropriation" id="add_appropriation">
                    <div class="form-group row">
                        <label  class="col-sm-4 col-form-label" align="right"><b>CODE:</b></label>
                        <div class="col-md-8">
                            <input type="text" list="function_list" id="display_function" name="function" value="<?php echo $value['function_code'] ?>" class="form-control display_function" autocomplete="off" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" align="right"><b>BUDGET YEAR:</b></label>
                        <div class="col-md-8">
                            <select id="budget_year" name="budget_year" class="form-control">
                                <option></option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                            </select>
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


        $(document).ready(function() {

            $('.form-group').on('input', '.prc', function() {
                var totalSum = 0;
                $('.prc').each(function() {
                    var inputVal = $(this).val();
                    if ($.isNumeric(inputVal)) {
                        totalSum += parseFloat(inputVal);
                    }
                });
                $('#total').val(totalSum);
            });
        });

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
                    url: "add_appropriation.php",
                    method: "POST",
                    data: $('#add_appropriation').serialize(),
                    success: function(data) {
                        alert(data);
                        window.location.href = 'appropriation_office.php?id=<?php echo $value["function_id"]; ?>'
                        $('#add_appropriation')[0].reset();
                    }
                })
            });
        });

        $(document).ready(function() {
            $('#update').click(function() {
                $.ajax({
                    url: "update_appropriation.php",
                    method: "POST",
                    data: $('#update_appropriation').serialize(),
                    success: function(data) {
                        alert(data);
                        window.location.href = 'appropriation_office.php?id=<?php echo $value["function_id"]; ?>'
                        $('#update_appropriation')[0].reset();
                    }
                })
            });
        });

        $(document).ready(function() {
            $('#delete').click(function() {
                $.ajax({
                    url: "delete_appropriation.php",
                    method: "POST",
                    data: $('#delete_appropriation').serialize(),
                    success: function(data) {
                        alert(data);
                        window.location.href = 'appropriation_office.php?id=<?php echo $value["function_id"]; ?>'
                        $('#delete_appropriation')[0].reset();
                    }
                })
            });
        });

       
    </script>

