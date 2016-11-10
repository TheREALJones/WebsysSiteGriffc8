<?php 


   require '../config.php';

   try {
      $conn = new PDO('mysql:host=localhost;dbname=websys_shop', $config['DB_USERNAME'], $config['DB_PASSWORD']);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// we could create a new table like this:
  // $tbl_sql = 'CREATE TABLE orders (id int not null, custid int, prodid int, PRIMARY KEY (id))';
  // $dbconn->exec($tbl_sql);
  // echo "Table created. ";


// setup INSERT statement here
      $newrcd = "INSERT INTO ... ";
      $conn->exec($newrcd);
      printf("Name inserted");
   } catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
   }
 ?>