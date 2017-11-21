<?php

// Function returns a database config
// Config should be placed in /etc/gocron and be owned
// by root with 644 permissions or be owned by the web
// server / php user with 600 permissions
function getConfig() {
      try {
            return parse_ini_file("/etc/gocron/dbconfig.ini");
      }
      catch (Exception $e) {
            return "Could not read config file " . $e;
      }
}

// Function returns a database connection
function dbConnect() {

      // Get db config  and buid a connection string
      $dbConfig = getConfig();
      $host   = $dbConfig['host'];
      $dbuser = $dbConfig['user'];
      $dbpass = $dbConfig['pass'];
      $dbname = $dbConfig['dbname'];
      $port   = $dbConfig['port'];
      $conn_string = "host=$host port=$port dbname=$dbname user=$dbuser password=$dbpass";

      // Create connection
      try {
        return $dbconn = pg_connect($conn_string);
      }
      catch (Exeption $e) {
        return false;
      }
}
?>
