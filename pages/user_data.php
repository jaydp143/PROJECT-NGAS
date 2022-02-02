<?php 
  require('./database.php');
  $no=$_SESSION['user_id'];
  $view_admin = mysqli_query($connection,"SELECT * FROM tbl_users WHERE user_id=$no");
  $rowadm = mysqli_fetch_array($view_admin);
?>