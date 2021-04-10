<?php
   $variables = [
      'servername' => 'mysql',
      'username' => 'root',
      'password' => 'pass',
      'dbname' => 'mainDB',
      'DB_PORT' => '3306',
  ];
  foreach ($variables as $key => $value) {
      putenv("$key=$value");
  }


?>
