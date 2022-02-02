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



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UPDATE CERTIFICATION ON APPROPRIATIONS, FUND AND OBLIGATION OF ALLOTMENT (CAFOA)</title>
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
    $cafoa="active";
    require_once('./sidebar.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <h1>UPDATE CERTIFICATION ON APPROPRIATIONS, FUND AND OBLIGATION OF ALLOTMENT (CAFOA)</h1>
            <p><?php echo "Today is   ".date_format(date_create($curDate),"F d, Y");?></p>
            <hr>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="col-md-12 ">
            <?php
                            
                            $query="SELECT * FROM tbl_obligation WHERE obligation_id='".$_GET['id']."'";
                            $sql=mysqli_query($connection,$query);
                            $row=mysqli_fetch_assoc($sql)
                        ?>
                                <div class='card'>
                                    <div class='card-header d-flex  justify-content-between align-items-center' style="background-color:#023047;">
                                        <h6 class='m-0 font-weight-bold text-light'><i class="fas fa-list"></i> UPDATE CAFOA</h6>
                                     </div>
                                <div class='card-body shadow'>
                                    <form name="add_expense" id="add_expense">  
                                        <div class="form-group row"> 
                                            <label for="payee" class="col-md-2 col-form-label" align="right"><b>REFERENCE NO.:</b></label>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" name="reference_number" id="reference_number" value="<?php echo $row["reference_number"]?>" required> 
                                            </div>  
                                            <label for="payee" class="col-md-3 col-form-label" align="right" ></label>
                                            <div class="col-md-3">
                                                <input type="hidden" name="id" id="id" value="<?php echo $row["obligation_id"];?>"  class="form-control" />
                                            </div>  
                                        </div>
                                    
                                        <div class="form-group row"> 
                                            <label for="payee" class="col-md-2 col-form-label" align="right"><b>OBLIGATION NO.:</b></label>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" name="obr_number" id="obr_number" value="<?php echo $row["obr_number"]; ?>" autocomplete="off" required> 
                                            </div>  
                                            <label for="payee" class="col-md-3 col-form-label" align="right" ><b>OBLIGATION DATE:</b></label>
                                            <div class="col-md-3">
                                            <input type="date" class="form-control" name="trans_date" id="trans_date" value="<?php echo $row["trans_date"]; ?>" required> 
                                            </div>  
                                        </div>
                                        <div class="form-group row"> 
                                            <label for="payee" class="col-md-2 col-form-label" align="right" ><b>PR#/RIS#:</b></label>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" name="pr_number" id="pr_number" value="<?php echo $row["pr_number"]; ?>" autocomplete="off" required> 
                                            </div> 
                                            <label class="col-md-3 col-form-label" align="right" ><b>PR#/RIS# DATE:</b></label>
                                            <div class="col-md-3">
                                            <input type="date" class="form-control" name="pr_date" id="pr_date" value="<?php echo $row["pr_date"]; ?>"> 
                                            </div>
                                        </div>

                                        <div class="form-group row"> 
                                            <label for="address" class="col-sm-2 col-form-label" align="right"><b>REQUEST:</b></label>
                                            <div class="col-md-10">  
                                            <textarea class="form-control text-left" name="request" id="request" rows="3" required><?php echo $row["request"]; ?></textarea>
                                            </div>  
                                        </div> 
                                        <div class="form-group row"> 
                                            <label for="address" class="col-sm-2 col-form-label" align="right"><b>PAYEE:</b></label>
                                            <div class="col-md-10">
                                            <input type="text" class="form-control" name="payee" id="payee" value="<?php echo $row["payee"]; ?>"  required> 
                                            </div>  
                                        </div> 
                                        <div class="form-group row"> 
                                            <label for="payee" class="col-sm-2 col-form-label" align="right"><b>FUNCTION:</b></label>
                                            <div class="col-md-4">
                                            <input type="text" list="function_list" id="display_function" name="function" value="<?php echo  $row["function"]; ?>"  class="form-control display_function" autocomplete="off"/><datalist class="function_list" id="function_list"></datalist>
                                            </div>  
                                            <label for="payee" class="col-sm-2 col-form-label" align="right" ><b>ALLOTMENT CLASS:</b></label>
                                            <div class="col-md-4">
                                            <input type="text" list="allotment_class_list" value="<?php echo  $row["allotment_class"]; ?>" id="display_allotment_class" name="allotment_class"  class="form-control display_allotment_class" autocomplete="off" /><datalist class="allotment_class_list" id="allotment_class_list"></datalist>
                                            </div>  
                                        </div>       
                                        <table class="table table-striped  table-sm" id="dynamic_field" width="100%">
                                            <thead>
                                            <tr class="text-center text-light" style="background-color:#219ebc; ">
                                                
                                                <th >EXPENSE CODE</th>
                                                <th >AMOUNT</th>
                                                <th ></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                    $numrow=1;
                                                    $query="SELECT * FROM tbl_expenses WHERE obligation_id='".$_GET['id']."'";
                                                    $sql=mysqli_query($connection,$query);
                                                    while($row=mysqli_fetch_array($sql)){
                                                    echo'
                                                    <tr class="text-center" id="row'.$numrow.'"> 
                                                    <td ><input type="text" list="expense_code_list" id="display_expense_code" name="expense_code[]"  class="form-control display_expense_code" value="'.$row['expense_code'].'" /><datalist class="expense_code_list" id="expense_code_list"></datalist></td>
                                                    <td ><input type="text" class="form-control" name="amount[]" value="'.$row['amount'].'" onkeypress="return isNumber(event)"></td>
                                                    <td align="center"><button type="button" name="remove" id="'.$numrow++.'" class="btn btn-danger btn_remove btn-sm"><i class="fas fa-trash-alt"></i></button></td>
                                                    </tr>'; 
                                                    }
                                                        
                                            ?>
                                        
                                                    
                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="5" class="text-right">
                                                    <a href="#" class="btn btn-danger" id="add_row"><i class="fas fa-plus"> </i> ADD NEW ROW</a>
                                                    <input type="hidden" name='total_amount' id="total_amount"  placeholder="00.00"  class="form-control" />
                                                    </th>
                                                    
                                                </tr>
                                            </tfoot>
                                        
                                    
                                            
                                        </table>    
                                        
                                     

                                </div>
                                <div class="card-footer">
                                        <div class="form-group row float-right"> 
                                            <input type="button" name="submit" id="submit" class="btn btn-success mx-2" value="UPDATE" /> 
                                            <a href="./cafoa.php" class="btn btn-secondary mx-2" id="cancel"> CANCEL</a>
                                        </div>
                                        
                                    </form>
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


<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });


    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)&&(charCode!=46)) {
            return false;
        }
        return true;
    }   

    $(document).ready(function() {
        $('div').on('click', '.display_function', function(){            

            $.ajax({    //create an ajax request to display.php
                type: "POST",
                url: "display_function.php",             
                dataType: "html",   //expect html to be returned                
                success: function(response){                    
                    $(".function_list").html(response); 
                    //alert(response);
                }
                });
            });
    });

    $(document).ready(function() {
        $('div').on('click', '.display_allotment_class', function(){            

            $.ajax({    //create an ajax request to display.php
                type: "POST",
                url: "display_allotment_class.php",             
                dataType: "html",   //expect html to be returned                
                success: function(response){                    
                    $(".allotment_class_list").html(response); 
                    //alert(response);
                }
                });
            });
    });

    $(document).ready(function() {
        $('tr').on('click', '.display_expense_code', function(){            

            $.ajax({    //create an ajax request to display.php
                type: "POST",
                url: "display_expense_code.php",             
                dataType: "html",   //expect html to be returned                
                success: function(response){                    
                    $(".expense_code_list").html(response); 
                    //alert(response);
                }
                });
            });
    });


    $(document).ready(function() {
    var i = <?php echo $numrow; ?>;
    $('.form-group').on('input','.prc',function(){ 
        var totalSum=0;
        $('.prc').each(function(){
            var inputVal=$(this).val();
            if($.isNumeric(inputVal)){
                totalSum+=parseFloat(inputVal);
            }
        });
        $('#total').val(totalSum);
    });
    $("#add_row").click(function() {
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'"><td align="center"><input type="text" list="expense_code_list" id="display_expense_code" name="expense_code[]"  class="form-control display_expense_code" /><datalist class="expense_code_list" id="expense_code_list"></datalist></td><td align="center"><input type="text" class="form-control" name="amount[]" onkeypress="return isNumber(event)"></td><td align="center"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove btn-sm"><i class="fas fa-trash-alt"></i></button></td></tr>');
    });
    $(document).on('click', '.btn_remove', function(){
        var button_id=$(this).attr("id");
        $('#row'+button_id+'').remove();
    });
    $('#submit').click(function(){
        $.ajax({
            url:"update_cafoa.php",
            method:"POST",
            data:$('#add_expense').serialize(),
            success:function(data){
                alert(data);
                window.location.href = './cafoa.php'
                $('#add_expense')[0].reset();
            }
        })
    });
    
    });
</script> 


