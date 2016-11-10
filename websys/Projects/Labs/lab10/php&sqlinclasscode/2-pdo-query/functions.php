<?php 


   require '../config.php';

   try {
      $conn = new PDO('mysql:host=localhost;dbname=websys_shop', $config['DB_USERNAME'], $config['DB_PASSWORD']);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// For Part 2 Set up a temporary variable to hold our ID - typically this will come as a parameter
      $id = 2;

//                 $conn->quote is used for escaping which we will tlk about soon

//    Setup queries here
// Part 1
//      $results = $conn->query('SELECT ... ');
// Part 2   
//        $results = $conn->query('SELECT ... ');
      
// Output query results      
      foreach ($results as $row) {
         echo '<pre>';
         print_r($row);
         echo '</pre>';

         printf("Last name = %s", $row['lname']);
      }

   } catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
   }

   // if ($conn) {
   //    echo "Connected!";
   // }
 ?>