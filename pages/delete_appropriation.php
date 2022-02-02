    <?php  
require('./database.php');
require('./session.php');

    $id=$_POST["id"];
    mysqli_query($connection,"DELETE from tbl_appropriation WHERE appropriation_id='$id'");
    echo "APPROPRIATION SUCCESSFULLY DELETED";
  
 ?> 