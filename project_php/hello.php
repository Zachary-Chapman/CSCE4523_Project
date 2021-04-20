<html>
   <body>
      <h3>Enter your name: </h3>

      <form action="hello.php" method="post">
         Name: <input type="text" name="name"><br>
         <input name="submit" type="submit" >
      </form>
      <br><br>
   </body>
</html>

<?php
   
   function hello ($name)
   {
	   // echo "Hello again $name<br>";
	   echo "Hello";
   }

   if (isset($_POST['submit'])) 
   {
	   $name = $_POST[name];
	   echo "<h3> Hello $name </h3>";
   }
?>
