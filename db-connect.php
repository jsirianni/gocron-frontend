<?php

// Function returns a database connection
function dbConnect() {

      $host = 'localhost';
      $dbname = 'gocron';
      $port = '5432';
      $dbuser = 'gocron';
      $dbpass = 'password';

      $conn_string = "host=$host port=$port dbname=$dbname user=$dbuser password=$dbpass";
      // DB Config
      // $dbConfig = getConfig();

      // Connection vars
      // $host = $dbConfig['host'];
      // $user = $dbConfig['user'];
      // $pass = $dbConfig['pass'];
      // $dbname = $dbConfig['dbname'];
      // $port = $dbConfig['port'];

      // Create connection
      try {
        return $dbconn = pg_connect($conn_string);
      }
      catch (Exeption $e) {
        return false;
      }
}
?>
