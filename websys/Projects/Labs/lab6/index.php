<?php 
  abstract class Operation {
    protected $operand_1;
    protected $operand_2;
    public function __construct($o1, $o2) {
      // Make sure we're working with numbers...
      if (!is_numeric($o1) || !is_numeric($o2)) {
        throw new Exception('Non-numeric operand.');
      }
      
      $this->operand_1 = $o1;
      $this->operand_2 = $o2;
    }
    public abstract function operate($op=0);
    public abstract function getEquation(); 
  }

  class Addition extends Operation {
    public function operate($op=0) {
      return $this->operand_1 + $this->operand_2;
    }
    public function getEquation() {
      return $this->operand_1 . ' + ' . $this->operand_2 . ' = ' . $this->operate();
    }
  }


// Part 1 - Add subclasses for Subtraction, Multiplication and Division here
  class Subtract extends Operation {
    public function operate($op=0) {
      return $this->operand_1 - $this->operand_2;
    }
    public function getEquation() {
      return $this->operand_1 . ' - ' . $this->operand_2 . ' = ' . $this->operate();
    }
  }
  class Multiply extends Operation {
    public function operate($op=0) {
      return $this->operand_1 * $this->operand_2;
    }
    public function getEquation() {
      return $this->operand_1 . ' * ' . $this->operand_2 . ' = ' . $this->operate();
    }
  }
  class Divide extends Operation {
    public function operate($op=0) {

      return $this->operand_1 / $this->operand_2;
    }
    public function getEquation() {
      return $this->operand_1 . ' / ' . $this->operand_2 . ' = ' . $this->operate();
    }
  }
  class Exponent extends Operation {
    public function operate($op=0) {
      return $this->operand_1 ** $this->operand_2;
    }
    public function getEquation() {
      return $this->operand_1 . ' ^ ' . $this->operand_2 . ' = ' . $this->operate();
    }
  }
  class Modulus extends Operation {
    public function operate($op=0) {
      return $this->operand_1 % $this->operand_2;
    }
    public function getEquation() {
      return $this->operand_1 . ' % ' . $this->operand_2 . ' = ' . $this->operate();
    }
  }
// End Part 1
// additional operations
  class Factorial extends Operation {
    public function operate($op=0) {
    $answer=1;
    for ($x = 1; $x <= $op; $x++) {
      $answer*=$x;
    }
    return $answer;
    }
    public function getEquation() {
      return $this->operand_1 . '! = ' . $this->operate($this->operand_1) . "\r\n  " . $this->operand_2 . '! = ' . $this->operate($this->operand_2);
    }
  }
  class Tip extends Operation {
    public function operate($op=0) {
    $summ= $this->operand_1 + $this->operand_2;
    $per= $op / $summ;
    $tip= $summ * 0.2;
    return $tip*$per;
    }
    public function getEquation() {
      return  'Person 1 needs to pay a $' . $this->operate($this->operand_1) .
      " tip\r\n  Person 2 needs to pay a $" . $this->operate($this->operand_2) .
      ' tip';
    }
  }

// Some debugs - un comment them to see what is happening...
// echo '$_POST print_r=>',print_r($_POST);
// echo "<br>",'$_POST vardump=>',var_dump($_POST);
// echo '<br/>$_POST is ', (isset($_POST) ? 'set' : 'NOT set'), "<br/>";
// echo "<br/>---";




// Check to make sure that POST was received 
// upon initial load, the page will be sent back via the initial GET at which time
// the $_POST array will not have values - trying to access it will give undefined message

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $o1 = $_POST['op1'];
    $o2 = $_POST['op2'];
  }
  $err = Array();


// Part 2 - Instantiate an object for each operation based on the values returned on the form
//          For example, check to make sure that $_POST is set and then check its value and 
//          instantiate its object
// 
// The Add is done below.  Go ahead and finish the remiannig functions.  
// Then tell me if there is a way to do this without the ifs

  try {
    if (isset($_POST['add']) && $_POST['add'] == 'Add') {
      $op = new Addition($o1, $o2);
    }
// Put the code for Part 2 here  \/
    if (isset($_POST['sub']) && $_POST['sub'] == 'Subtract') {
      $op = new Subtract($o1, $o2);
    }
    if (isset($_POST['mult']) && $_POST['mult'] == 'Multiply') {
      $op = new Multiply($o1, $o2);
    }
    if (isset($_POST['div']) && $_POST['div'] == 'Divide') {
      $op = new Divide($o1, $o2);
    }
    if (isset($_POST['exp']) && $_POST['exp'] == 'Exponent') {
      $op = new Exponent($o1, $o2);
    }  
    if (isset($_POST['mod']) && $_POST['mod'] == 'Modulus') {
      $op = new Modulus($o1, $o2);
    }  
// End of Part 2   /\
// Additional operators     
    if (isset($_POST['fac']) && $_POST['fac'] == 'Factorial') {
      $op = new Factorial($o1, $o2);
    } 
    if (isset($_POST['tip']) && $_POST['tip'] == 'Tip') {
      $op = new Tip($o1, $o2);
    }       
  }
  catch (Exception $e) {
    $err[] = $e->getMessage();
  }
?>

<!doctype html>
<html>
<head>
<title>Lab 6</title>
</head>
<body>
  <div id="doc">
  <pre id="result">
  <?php 
    if (isset($op)) {
      try {
        echo $op->getEquation();
      }
      catch (Exception $e) { 
        $err[] = $e->getMessage();
      }
    }
      
    foreach($err as $error) {
        echo $error . "\n";
    } 
  ?>
  </pre>
  <h2><strong>PHP Calculator</strong></h2>
  <form method="post" action="index.php">
    <input type="text" name="op1" id="name" value="0" class="subfield" />
    <input type="text" name="op2" id="name" value="0" class="subfield" />
    <p></p>
    <!-- Only one of these will be set with their respective value at a time -->
    <input type="submit" name="add" value="Add" class="subbutton" title="Add the two numbers together"/>
    <input type="submit" name="sub" value="Subtract" class="subbutton" title="Subtract the second number from the first"/>  
    <input type="submit" name="mult" value="Multiply" class="subbutton" title="Multiply the first number by the second"/>  
    <input type="submit" name="div" value="Divide" class="subbutton" title="Divide the first number by the second"/>
    <br/>
    <input type="submit" name="exp" value="Exponent" class="subbutton" title="Multiply the first number by itself the second number of times"/>
    <input type="submit" name="mod" value="Modulus" class="subbutton" title="Find the remainder when the first number is divided by the second"/>
    <input type="submit" name="fac" value="Factorial" class="subbutton" title="Multiply the number by each positive integer before it (can find two factorials by using both fields)"/>
    <input type="submit" name="tip" value="Tip" class="subbutton" title="takes in what people have paid on a bill and computesthe amount they would pay for a tip with a standard 20% tip"/>    
  </form>
  </div>
</body>
<style>
body {
  background-color: #CD5C5C;  
  color:#663399;
}
#doc {
  margin-top: 10%;
  margin-left: auto;
  margin-right: auto;
  padding:2%;
  text-align: center;
  vertical-align: middle;
  background-color: #FFB6C1;
  width: 600px;
  border: 5px, #4B0082, solid;
  border-radius: 15px;
}
.subfield{
  color: #CD5C5C;
  background-color:#FFB6C1;
  border-color: #CD5C5C; 
}
.subbutton{
  color: #663399;
  background-color:#FFB6C1;
  border-color: #CD5C5C; 
}
</style>
</html>

