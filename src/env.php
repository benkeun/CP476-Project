<?php
  $variables = [
      'servername' => 'localhost',
      'username' => 'root',
      'password' => '',
      'dbname' => 'mainDB',
      'DB_PORT' => '3306',
  ];

  foreach ($variables as $key => $value) {
      putenv("$key=$value");
  }
?>