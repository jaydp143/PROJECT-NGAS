<?php
  $host = 'localhost';
  $user = 'root';
  $password = '';
  $database = 'fmis_db';

  $connection = mysqli_connect($host, $user, $password, $database);

  if (mysqli_connect_error()) {
    echo 'error';
  }
?>