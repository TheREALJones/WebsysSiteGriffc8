<?php 


   require '../config.php';

   try {
//      open connection here
   } catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
   }

   if ($conn) {
      echo "Connected!";
   }
 ?>