<html>
   <body>
      <h3>Enter information about an item to  add to the database:</h3>

      <form action="php_insert_item.php" method="post">
         Name: <input type="text" name="name"><br>
         Price_Per_LB: <input type="text" name="price_per_lb"><br>
         Roasting: <input type="text" name="roasting"><br>
         <input name="submit" type="submit" >
      </form>
      <br><br>

<?php
   include("php_db.php"); // include database class

   // replace ' ' with '\ ' in the strings so they are treated as single command line a
    $name = $_POST[name];
    $price_per_lb = $_POST[price_per_lb];
    $roasting = $_POST[roasting];
    echo $price_per_lb;
	if (isset($_POST['submit'])) 
	{  
	  $myDb = new php_db('zachapma','Eeja3dae','zachapma'); // create a new object, class php_db(), replace MYUSERNAME and MYSQLPASSWORD with your MySQL username and password
      //initialize database
      $myDb->initDatabase();
      // show Items data before inserting a record
      $Items = $myDb->query('SELECT * FROM ITEM');  // we show data befor and after the insert
      echo '<br>Table ITEM before:';
      $myDb->printTable($Items);
      $id='90'; // change ID everytime you run your program
      $values = '\''. $id. '\', \'' . $name . '\', \'' . $price_per_lb . '\', \''. $roasting . '\' ';
      $myDb->insert('ITEM', $values);
      
      // show Item data after inserting a record
      $Items = $myDb->query('SELECT * from ITEM'); // select ALL from Restaurant - After the insert
	  echo '<br>Table Item after:';
	  $myDb->printTable($Items);
	  
	}  
?>
</body>
</html>
