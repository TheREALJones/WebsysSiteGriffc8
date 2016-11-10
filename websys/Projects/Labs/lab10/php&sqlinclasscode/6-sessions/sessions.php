<?php 


   require '../config.php';

   session_start();

   if (!isset($_SESSION['visited'])) {
      $_SESSION['visited'] = 1;
   } else {
      $_SESSION['visited']++;
   }
   echo "Times Visited: " . $_SESSION['visited'];

 ?>