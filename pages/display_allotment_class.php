<?php 
    require('./database.php');
    $select_query1 = mysqli_query($connection,"SELECT cat_acronym from tbl_acc_category");
    while($row = mysqli_fetch_array($select_query1)){ 
    echo "<option>".$row['cat_acronym']."</option> ";
    }
?>