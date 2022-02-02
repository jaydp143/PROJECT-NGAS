<?php 
    $pagename="function";
    require('./session.php'); 
    require('./database.php');
    require('./season.php');
    require('./save_new_pass.php');
    require('./save_new_profile.php');
    require('./user_data.php');
    require('./query.php');
?>

<!-- adding account -->
<?php
  if (isset($_POST['btn_save'])) {

    $code =mysqli_real_escape_string($connection,$_POST['code']);
    $type =mysqli_real_escape_string($connection,$_POST['type']);
    $description =mysqli_real_escape_string($connection,$_POST['description']);
    mysqli_query($connection,"INSERT INTO tbl_function (function_code, type,description) VALUES ('$code', '$type','$description')");
    pathTo($pagename);
  
}

 ?>


<!-- changing of accounts-->
<?php
  if (isset($_POST['btn_change'])) {
    
    $id =$_POST['id'];   
    $code =mysqli_real_escape_string($connection,$_POST['code']);
    $type =mysqli_real_escape_string($connection,$_POST['type']);
    $description =mysqli_real_escape_string($connection,$_POST['description']);
    

    mysqli_query($connection,"UPDATE tbl_function SET function_code='$code', type='$type',description='$description' WHERE function_id='$id' ");

    //mysqli_query($connection,"UPDATE tbl_budget SET account_code='$account_code', account_description='$description', acc_category='$acc_category' WHERE account_id='$id' ");

    pathTo($pagename);

  }
 ?>



<!-- delete function -->
   <script>
    function confirm_del()
    {
      if(confirm("Are you sure you want to delete?")==1){
        document.getElementById('deleteBtn').submit();
      }
    }
</script>

<?php
if (isset($_POST['deleteBtn'])) 
{
    $no = $_POST['id'];
     mysqli_query($connection,"DELETE from tbl_function WHERE function_id='$no'");
     echo "
                <script type='text/javascript'>
                alert('SUCCESSFULLY DELETED! !');
                open('function.php','_self');
                </script>
            ";
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FUNCTIONS/PROGRAMS/PROJECTS</title>
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
      $maintenance_nav_item="menu-open";
      $maintenance_nav_link="active";
      $function="active";
      require_once('./sidebar.php');
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
             <a data-toggle="modal" data-target="#addModal" class="btn btn-primary float-right"><span class="fas fa-plus"></span>  CREATE NEW FUNCTIONS/PROGRAMS/PROJECTS</a>
            <h1>FUNCTIONS/PROGRAMS/PROJECTS</h1>
            <p><?php echo "Today is   ".date_format(date_create($curDate),"F d, Y");?></p>
           
            <hr>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="dataTables-example" class="table table-striped table-bordered table-sm " style="text-align:center; width:100%">
                        <thead class="text-light" style="background-color:#1167b1; ">
                          <tr>
                            <th style="text-align:center; width:20%">CODE</th>
                            <th style="text-align:center; width:40%">DESCRIPTION</th>
                            <th style="text-align:center; width:20%"> TYPE</th>
                            <th style="text-align:center; width:20%">ACTIONS</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = mysqli_query($connection,"SELECT * FROM tbl_function ORDER BY function_id ASC");
                              while($row = mysqli_fetch_array($query)){       
                          ?>
                          <tr>       
                            <td style="text-align:center;"><?php echo $row['function_code']; ?></td>
                            <td style="text-align:left;"><?php echo $row['description']; ?></td>
                            <td style="text-align:center;"><?php echo $row['type']; ?></td>
                            <td style="text-align:center;">
                            <form method="POST">
                              <div class="btn-group">
                                  
                                    <a href="#editModal<?php echo $row['function_id']; ?>" class="btn btn-primary btn-sm" data-toggle="modal"><i class="fa fa-edit" aria-hidden="true"></i></a> 
                                  
                                      <input type="hidden" name="id" value="<?php echo $row['function_id']; ?>"/>
                                      <button type="submit" class="btn btn-danger btn-sm" onclick="confirm_del();return false;" name="deleteBtn" id="deleteBtn" title="Delete User" id="Delete_id" ><i class="fas fa-trash"></i></button>
                                    
                              </div>
                            </form> 
                            </td>
                          </tr>
                          <!--edit account Modal -->
                                                <div class="modal fade" id="editModal<?php echo $row['function_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-info">
                                                                <h5 class="modal-title text-light" id="exampleModalLabel"><i class="fas fa-file-alt"></i> UPDATE FUNCTION</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                    <div class="modal-body">
                                                    <form method="POST">
                                                        <input type="hidden"  name="id" id="id" value="<?php echo $row['function_id']; ?>">
                                                        <div class="form-group row"> 
                                                            
                                                                <label for="code" class="col-md-2 col-form-label" align="right"><b>CODE:</b></label>
                                                                <div class="col-md-4">
                                                                <input type="text" class="form-control" name="code" id="code" value="<?php echo $row['function_code']; ?>" required> 
                                                                </div>  
                                                                <label for="type" class="col-md-2 col-form-label" align="right" ><b>TYPE:</b></label>
                                                                <div class="col-md-4">
                                                                <select class="form-control" name="type" id="type" required >
                                                                    <option><?php echo $row['type']; ?></option>
                                                                    <option>OFFICE</option>
                                                                    <option>HOSPITAL</option>
                                                                    <option>NON-OFFICE</option>
                                                                </select>
                                                                </div>  
                                                                
                                                            </div>                                                  
                                                    <div class="form-group row">
                                                        <label for="description" class="col-md-2  col-form-label" align="right"><b>DESCRIPTION</b></label>
                                                        <div class="col-md-10">
                                                        <textarea name="description" id="description" class="form-control" rows="3"  required /><?php echo $row['description']; ?></textarea>
                                                        </div>    
                                                    </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success btn-sm" name="btn_change" >Change</button>
                                                    </div>
                                                    </form>
                                                    </div>
                                                </div>
                                                </div>

                          <?php
                              }
                          ?>
                        </tbody>      
                    </table>
                </div>    
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


<!--account Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title text-light" id="exampleModalLabel"><i class="fas fa-file-alt"></i> CREATE FUNCTION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST">
              <div class="form-group row"> 
                <label for="code" class="col-md-2 col-form-label" align="right"><b>CODE:</b></label>
                <div class="col-md-4">
                <input type="text" class="form-control" name="code" id="code" required> 
                </div>  
                <label for="type" class="col-md-2 col-form-label" align="right" ><b>TYPE:</b></label>
                <div class="col-md-4">
                <select class="form-control" name="type" id="type" required >
                    <option></option>
                    <option>OFFICE</option>
                    <option>HOSPITAL</option>
                    <option>NON-OFFICE</option>
                </select>
                </div>  
                
            </div>                                                  
    <div class="form-group row">
        <label for="description" class="col-md-2 col-form-label" align="right"><b>DESCRIPTION:</b></label>
        <div class="col-md-10">
            <textarea name="description" id="description" class="form-control" rows="3" required /></textarea>
        </div>
    </div>                                                   
      </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="btn_save" >Save</button>
          <button type="reset" class="btn btn-danger">Clear</button>
        </div>
      </form>
    </div>
  </div>
</div>


