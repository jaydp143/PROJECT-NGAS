    <?php  
require('./database.php');
require('./session.php');

    $id=$_POST["id"];
    $amount=$_POST['amount'];
    mysqli_query($connection, "UPDATE tbl_appropriation SET amount_appropriation='$amount' WHERE appropriation_id='$id'"); 
    echo "APPROPRIATION SUCCESSFULLY UPDATED";
  
 ?> 