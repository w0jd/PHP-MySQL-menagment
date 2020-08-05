
<?php 
 include '../phpFunctions/functions.php';
 include '../phpVariables/variables.php';
 session_start();
 session_regenerate_id();
 function dbShow(){
  $dbConnect= sessionCheck();
 
 $dbShow="SHOW DATABASES;";
 $db_list = mysqli_query($dbConnect, "SHOW DATABASES");

 echo "</br>"."<form action='../dbSelection/dbSelection.php' method='POST'> db list"."</br>"."</br><select name='db_Name'>";
 while ($row = mysqli_fetch_array($db_list)) {
 echo "<option value='$row[0]'>$row[0]</option>";
 } 
 echo "</select> <button type='submit'> Select</button></form>";
 if($dbConnect){
    echo "</br>"."connected"."</br>"."</br>";

 }
 
 
  
  }
  dbShow();
?>
  <!DOCTYPE html>
  <html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="frontend/css/main.css">
    <title>Document</title>
</head>
<body>
  <main>
     
         
           
        </main>

    </body>
  </html>