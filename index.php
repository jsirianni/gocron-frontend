<?php

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

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>gocron cron job admin tool</title>

    <!-- vue js cdn -->
    <script src="https://unpkg.com/vue"></script>

    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- icon pack cdn -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- custom styles -->
    <link rel="stylesheet" href="css/styles.min.css">
    <link rel="stylesheet" href="css/selectors.min.css">

  </head>
  <body>


    <div class="container">
      <div class="row">
        <div class="col text-center">
          <h1><span class="cron-green">go</span>cron</h1>
          <h3>a simple cron job admin tool<span class="cron-green">.</span></h3>
        </div>
      </div>
    </div>



      <div class="container padding-top-20 margin-top-20 job-container">
        <div class="row">
          <div class="col-4 column-header text-center">
            <span class="align-middle cron-green">Job Name | Account</span>
          </div>
          <div class="col-4 d-none d-sm-block "></div>
          <div class="col-2 column-header text-center">
            <span class="align-middle cron-green">Action</span>
          </div>
          <div class="col-2 column-header text-center">
            <span class="align-middle cron-green">Status</span>
          </div>
        </div>
        <hr>


        <?php
          $result = pg_query($link, "SELECT * FROM gocron ORDER BY $account");
          echo "<div id='cronjobs'>";
          while ($row = pg_fetch_assoc($result)) {
            $pk1 = "'" . $row[$cronname] . "'";
            $pk2 = "'" . $row[$account] . "'";
            $output = '
              <div class="row">
                <div class="col-4 column-data text-center my-auto">
                  '. $row[$cronname]  . '   |   ' .  $row[$account] . '
                </div>

                <div class="col-4 d-none d-sm-block ">

                </div>

                <div class="col-2 column-data text-center my-auto">
                  <button class="btn btn-outline-danger delete" type="button" @click="stageDelete('.$pk1.' , ' .$pk2.')">delete <span class="ion-trash-b"></span></button>
                </div>

                <div class="col-2 my-auto text-center">'; // end of first output section

                // if alerted column is true, display one icon, if not, display another one
                $row[$alerted] === ('f') ? $output.='<span class="column-data-icon text-center ion-checkmark-circled"></span>' : $output.='<span class="column-data-icon text-center ion-alert-circled"></span>';

            $output.= '
                </div>
              </div>
            <hr>'; // end of last output section

            echo $output;
            }
            echo '
            <transition name="fade">
              <div class="confirmation-area" v-if="showDeleteMsgBox">
                <div class="container my-auto">
                  <div class="row">
                    <div class="col-6 text-center my-auto">
                      Are you sure you want to delete: "<strong>{{ jobname }}</strong>"?
                    </div>

                    <div class="col-6 text-center my-auto">
                      <button class="btn btn-danger" @click="confirmDelete">Confirm</button>
                      <button class="btn btn-primary" @click="dismissDelete">Dismiss</button>
                    </div>
                  </div>
                </div>
              </div>
              </transition>
            </div>'; // end vue #cronjobs scope
        ?>


    </div>
  </body>

  <!-- custom vue file -->
  <script src="vue/vue-js.js" charset="utf-8"></script>

  <!-- axios cdn for making ajax calls -->
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</html>

<!-- NOTE: connect to DB -->
<!-- NOTE: query all cron jobs -->
<!-- NOTE: trash icon to delete job selected -->
<!-- NOTE: use vue js -->
