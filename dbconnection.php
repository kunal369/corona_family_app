<?php
  $host        = "host = 127.0.0.1";
   $port        = "port = 52242";
   $dbname      = "dbname = COVID19";
   $credentials = "user = postgres password=root";

   $conn = pg_connect( " $dbname $credentials"  );
   if(!$conn) {
      echo "Error : Unable to open database\n";
   }/* else {
      echo "Opened database successfully\n";
   }*/
?>