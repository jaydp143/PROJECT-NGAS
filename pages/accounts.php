<?php 
    $pagename="accounts";
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
    $account_code =$_POST['account_code'];
    $description =$_POST['description'];
    $acc_category =$_POST['acc_category'];

    $same_data = mysqli_query($connection,"SELECT * FROM tbl_accounts WHERE account_code = '$account_code'");

    if (mysqli_num_rows($same_data)!=0) {

    echo "
    <script type='text/javascript'>
    alert('Account Code Already Exist! NOT SAVED!');
    window.location.href = 'accounts.php';
    </script>";   
    }
    else if(mysqli_num_rows($same_data)==0){

      mysqli_query($connection,"INSERT INTO tbl_accounts (account_code, account_description, acc_category) VALUES ('$account_code', '$description', '$acc_category')");

      echo "
      <script type='text/javascript'>
    alert('You have Successfully Added');
    window.location.href = 'accounts.php';
    </script>

   ";
  }
}

?>

<!-- changing of accounts-->
<?php
  if (isset($_POST['btn_change'])) {
    
    $id =$_POST['id'];   
    $account_code =mysqli_real_escape_string($connection,$_POST['account_code']);
    $description =mysqli_real_escape_string($connection,$_POST['description']);
    $acc_category =mysqli_real_escape_string($connection,$_POST['acc_category']);

    mysqli_query($connection,"UPDATE tbl_accounts SET account_code='$account_code', account_description='$description', acc_category='$acc_category' WHERE account_id='$id' ");


     echo "
                <script type='text/javascript'>
                alert('You have updated a Account Code');
                open('accounts.php','_self');
                </script>
            ";

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
      mysqli_query($connection,"DELETE from tbl_accounts WHERE account_id='$no'");
      echo "
            <script type='text/javascript'>
            alert('You Have Deleted a Account !');
            open('accounts.php','_self');
            </script>
          ";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ACCOUNT CODES</title>
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
      $maintenance_nav_item="menu-open";
      $maintenance_nav_link="active";
      $account_code="active";
      require_once('./sidebar.php');
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
             <a data-toggle="modal" data-target="#addModal"  class="btn btn-primary float-right"><span class="fas fa-plus"></span>  CREATE NEW ACCOUNT CODES</a>
            <h1>ACCOUNT CODES</h1>
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
                    <table id="dataTables-example" class="table table-striped table-sm " style="text-align:center; width:100%">
                        <thead class="text-light" style="background-color:#1167b1; ">
                          <tr>
                            <th style="text-align:center; width:20%">CODE</th>
                            <th style="text-align:center; width:40%">DESCRIPTION</th>
                            <th style="text-align:center; width:20%">CATEGORY</th>
                            <th style="text-align:center; width:20%">ACTIONS</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = mysqli_query($connection,"SELECT * from tbl_accounts order by account_id desc ");
                              while($row = mysqli_fetch_array($query)){       
                          ?>
                          <tr>     
                            <td style="text-align:center;"><?php echo $row['account_code']; ?></td>
                            <td style="text-align:left;"><?php echo $row['account_description']; ?></td>
                            <td style="text-align:left;"><?php echo $row['acc_category']; ?></td>
                            <td style="text-align:center;">
                              <form method="POST">
                                <div class="btn-group">
                                        <a href="#editModal<?php echo $row['account_id']; ?>" class="btn btn-sm btn-primary" data-toggle="modal"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                        <input type="hidden" name="id" value="<?php echo $row['account_id']; ?>"/>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="confirm_del();return false;" name="deleteBtn" id="deleteBtn" title="Delete User" id="Delete_id" ><i class="fas fa-trash"></i></button> 
                                </div>
                              </form> 
                            </td>
                          </tr>
                          <!--edit account Modal -->
                                                <!--edit account Modal -->
                                                <div class="modal fade" id="editModal<?php echo $row['account_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-info">
                                                                <h5 class="modal-title text-light" id="exampleModalLabel"><i class="fas fa-file-alt"></i> UPDATE EXPENSE CODE</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                    <div class="modal-body">
                                                    <form method="POST">

                                                    <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $row['account_id']; ?>" required>

                                                    <div class="form-group">
                                                        <label>Account Code: </label>
                                                        <input type="text" name="account_code" id="id_account_code" class="form-control" value="<?php echo $row['account_code']; ?>"/>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Description: </label>
                                                        <input type="text" name="description" id="id_description" class="form-control" value="<?php echo $row['account_description']; ?>"/>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Account Category: </label>
                                                        <select class="form-control" name="acc_category" required >
                                                            <option><?php echo $row['acc_category']; ?></option>
                                                        <?php
                                                            $account_display=mysqli_query($connection,"SELECT DISTINCT category FROM tbl_acc_category "); 
                                                            while ($acc_row=mysqli_fetch_array($account_display)) {
                                                                $category = $acc_row['category'];
                                                            ?>         
                                                            <option><?php echo $acc_row['category']; ?></option>
                                                        <?php } ?> 
                                                        </select>
                                                    </div>

                                                    </div>
                                                        <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success" name="btn_change" >Change</button>
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
                    <h5 class="modal-title text-light" id="exampleModalLabel"><i class="fas fa-file-alt"></i> CREATE EXPENSE CODE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
      <div class="modal-body">
      <form method="POST">

      <div class="form-group">
        <label>Account Code: </label>
        <input type="text" name="account_code" id="account_code" class="form-control" required />
      </div>

      <div class="form-group">
        <label>Description: </label>
        <input type="text" name="description" id="description" class="form-control" required />
      </div>

      <div class="form-group">
        <label>Account Category: </label>
        <select class="form-control" name="acc_category" required >
          <option></option>
          <?php
             $account_display=mysqli_query($connection,"select * from tbl_acc_category"); 
              while ($acc_row=mysqli_fetch_array($account_display)) {
             ?>
             <option><?php echo $acc_row['category']; ?></option>
          <?php } ?> 
        </select>
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
