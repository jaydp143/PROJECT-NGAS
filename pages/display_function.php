<?php 
    require('./database.php');
    $select_query1 = mysqli_query($connection,"SELECT * from tbl_function");
    echo"<option value='ALL'></option>";
    while($row = mysqli_fetch_array($select_query1)){ 
    echo "<option value='".$row['function_code']."'>".$row['description']."</option> ";
    }
?>