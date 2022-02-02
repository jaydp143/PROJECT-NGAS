<?php 
    require('./database.php');
    $select_query1 = mysqli_query($connection,"SELECT * from tbl_accounts");
    while($row = mysqli_fetch_array($select_query1)){ 
    echo "<option value='".$row['account_code']."'>".$row['account_description']."</option> ";
    }
?>