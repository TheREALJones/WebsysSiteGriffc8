<?php 

// Call with parameter in browser
// http://websys/Lecture17-PHP&SQL/pdo-queryfromget/functions.php?lname=plotka

   require '../config.php';

   try {
      $conn = new PDO('mysql:host=localhost;dbname=websys_shop', $config['DB_USERNAME'], $config['DB_PASSWORD']);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      if (isset($_GET['lname'])) {
         if ($_GET['lname'] != '') {
            $pstmt = $conn->prepare('SELECT * from customers WHERE lname = :ln');
            $pstmt->bindParam('ln', $_GET['lname'], PDO::PARAM_STR);
         } else {
            echo "lname not given, outputting entire file";
            $pstmt = $conn->prepare('SELECT * from customers');
         }
         $pstmt->execute();
         $row = $pstmt->fetchALL();
         echo '<pre>';
         print_r($row);
         echo '</pre>';

         foreach($row as $r) {
            printf("%s %s",$r['fname'],$r['lname']);
         }

      }
   } catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
   }

 ?>