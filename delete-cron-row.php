<?php
  header("Content-Type: application/json", true);
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  include 'db-connect.php';
  include 'db-table-info.php';

  // Get a database connection
  try {
        $link = dbConnect();
  }
  catch (Exception $e) {
        print_r($e);
  }

  // check db connection status
  $stat = pg_connection_status($link);
  if ($stat === PGSQL_CONNECTION_OK) {
    //do nothing, just load page
  } else {
    // TODO: create php file to include here that echoes an error page
    echo 'Error connecting to the database, please contact your admin.';
    die;
  }

  $data = json_decode(file_get_contents('php://input'), true);
  print_r($data['data']);



  if(isset($data['data'])){
      $passedKey1 = $data['data']['keys'][0];
      $passedKey2 = $data['data']['keys'][1];
      echo $passedKey1;
      $deleteQuery = "DELETE FROM $tablename WHERE $cronname = '$passedKey1' AND $account = '$passedKey2'";
      echo $deleteQuery;
      pg_query($link, $deleteQuery);
  }
?>
