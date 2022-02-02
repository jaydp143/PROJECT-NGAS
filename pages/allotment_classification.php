<?php 
    $pagename="allotment_classification";
    require('./session.php'); 
    require('./database.php');
    require('./season.php');
    require('./save_new_pass.php');
    require('./save_new_profile.php');
    require('./user_data.php');
    require('./query.php');
?>


<!-- adding account category -->
<?php
  if (isset($_POST['btn_save'])) {

    $category =mysqli_real_escape_string($connection,strtoupper($_POST['category']));

    $same_data = mysqli_query($connection,"SELECT * FROM tbl_acc_category WHERE category = '$category' ");

    if (mysqli_num_rows($same_data)>0) {

    echo "
    <script type='text/javascript'>
    alert('Account Category Already Exist!');
    window.location.href = 'acc_category.php';
    </script>";   

    }
    else{

  mysqli_query($connection,"INSERT INTO tbl_acc_category (category) VALUES ('$category')");

  echo "
   <script type='text/javascript'>
    alert('You have Successfully Added');
    window.location.href = 'acc_category.php';
    </script>

   ";
  }
}

 ?>


<!-- updating account category -->
<?php 
  if (isset($_POST['btn_change'])) {
    
    $id =mysqli_real_escape_string($connection,$_POST['id']);
    $category =mysqli_real_escape_string($connection,strtoupper($_POST['category']));

    mysqli_query($connection,"UPDATE tbl_acc_category SET category='$category' WHERE id='$id' ");

    echo "
      <script type='text/javascript'>
      alert('You have Successfully Updated');
      window.location.href = 'acc_category.php';
      </script>

   ";

  }


?>

<!-- delete function -->
<script>
    function confirm_del()
    {
      if(confirm("Are you sure you want to delete? " )==1){
        document.getElementById('deleteBtn').submit();
      }
    }
</script>

<?php
if (isset($_POST['deleteBtn'])) 
{
    $no = $_POST['id'];
     mysqli_query($connection,"DELETE from tbl_acc_category WHERE id='$no'");
     echo "
                <script type='text/javascript'>
                alert('You Have Deleted a Category !');
                open('acc_category.php','_self');
                </script>
            ";
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ALLOTMENT CLASSIFICATION</title>
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
      $allot_class="active";
      require_once('./sidebar.php');
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
             <a href="?page=history/manage_record" class="btn btn-primary float-right"><span class="fas fa-plus"></span>  CREATE NEW ALLOTMENT CLASSIFICATIONS</a>
            <h1>ALLOTMENT CLASSIFICATIONS</h1>
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
                            <th><center>ID</center></th>
                            <th><center>DESCRIPTION</center></th>
                            <th><center>TYPE</center></th>
                            <th><center>ACTIONS</center></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = mysqli_query($connection,"SELECT * from tbl_acc_category");
                              while($row = mysqli_fetch_array($query)){       
                          ?>
                          <tr>     
                            <td align="center"><?php echo $row['acc_category_id']; ?></td>  
                            <td align="center"><?php echo $row['category']; ?></td>
                            <td align="center"><?php echo $row['cat_acronym']; ?></td>
                            <td align="center">
                              <div class="btn-group">
                                  <form method="POST">
                                    <a href="#editModal<?php echo $row['acc_category_id']; ?>" class="btn btn-primary btn-sm" data-toggle="modal"><i class="fa fa-edit" aria-hidden="true"></i></a> 
                                  
                                      <input type="hidden" name="id" value="<?php echo $row['acc_category_id'] ?>"/>
                                      <button type="submit" class="btn btn-danger btn-sm" onclick="confirm_del();return false;" name="deleteBtn" id="deleteBtn" title="Delete User" id="Delete_id" ><i class="fas fa-trash"></i></button>
                                  </form>   
                              </div>
                            </td>
                          </tr>
                          <!--edit account Modal -->
                                <!--edit account Modal -->
                                                    <div class="modal fade" id="editModal<?php echo $row['acc_category_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-info">
                                                                <h5 class="modal-title text-light" id="exampleModalLabel"><i class="fas fa-file-alt"></i> UPDATE ALLOTMENT CLASSIFICATION</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        <div class="modal-body">
                                                        <form method="POST">

                                                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $row['acc_category_id']; ?>" required>

                                                        <div class="form-group">
                                                            <label>ALLOTMENT CLASSIFICATION: </label>
                                                            <input type="text" name="category" id="category" class="form-control" value="<?php echo $row['category']; ?>"/>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>ACRONYM: </label>
                                                            <input type="text" name="category" id="category" class="form-control" value="<?php echo $row['cat_acronym']; ?>"/>
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
                <h5 class="modal-title text-light" id="exampleModalLabel"><i class="fas fa-file-alt"></i> UPDATE ALLOTMENT CLASSIFICATION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
      <div class="modal-body">
      <form method="POST">

      <div class="form-group">
        <label>ALLOTMENT CLASSIFICATION: </label>
        <input type="text" name="category" id="category" class="form-control" />
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

