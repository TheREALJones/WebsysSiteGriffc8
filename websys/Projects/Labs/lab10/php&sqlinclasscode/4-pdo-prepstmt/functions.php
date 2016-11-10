<?php 


   require '../config.php';

   try {
      $conn = new PDO('mysql:host=localhost;dbname=websys_shop', $config['DB_USERNAME'], $config['DB_PASSWORD']);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


      $id=2;

// Prepare statement here
      $pstmt = $conn->prepare('SELECT * from customers WHERE id = :id');

// Execute it

// Option 1
      // $pstmt->execute(array(
      //    'id'=> $id
      // ));

// Option 2
      $pstmt->bindParam(':id', $id, PDO::PARAM_INT);
      $pstmt->execute();

// fetch returns results as an array

      while($row = $pstmt->fetch()) {
         echo '<pre>';
         print_r($row);
         echo '</pre>';
      }


// try a different query ... 
      echo "Query 2 <br/>";
      echo "FETCH_OBJ<br/>";

   // Prepare statement
      $pstmt2 = $conn->prepare('SELECT * from customers');
      $pstmt2->execute();

// fetch(PDO::FETCH_OBJ) returns results as objects

      // while($row = $pstmt2->fetch(PDO::FETCH_OBJ)) {
      //    echo '<pre>';
      //    print_r($row);
      //    echo '</pre>';
      // }

// or - using fetchAll;

      $row = $pstmt2->fetchAll(PDO::FETCH_OBJ);
      echo '<pre>';
      print_r($row);
      echo '</pre>';


// AND - reusing the statement with a new value for the :id parameter 
      $id=3;
      $pstmt->execute(array(
         'id'=>$id
      ));
      $row = $pstmt->fetchAll(PDO::FETCH_OBJ);
      echo('Query 1, id=3<br/>');
      echo '<pre>';
      echo $row[0]->fname;
      echo '</pre>';



   } catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
   }


   // if ($conn) {
   //    echo "Connected!";
   // }
 ?>