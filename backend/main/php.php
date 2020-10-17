
<!DOCTYPE html>
  <html lang="pl" class="html_full_height">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../frontend/css/main.css">
    <title>Document</title>
</head>
<body>


<?php 

 include '../phpFunctions/functions.php';
 include '../phpVariables/variables.php';
 session_start();
 session_regenerate_id();
 function dbShow(){
  $dbConnect= sessionCheck();
 
 $dbShow="SHOW DATABASES;";
 $db_list = mysqli_query($dbConnect, "SHOW DATABASES");

 echo "<main class='main_container'><form class='main_form' action='../dbSelection/dbSelection.php' method='POST'><section class='main_form_section'> db list</section>"."<section class='main_form_section'><select name='db_Name'>";

 
 while ($row = mysqli_fetch_array($db_list)) {
 echo "<option value='$row[0]'>$row[0]</option>";
 } 
 echo "</select></section>";
 
 echo "<section class='log-in'> <button class='submit-button' type='submit'> Select</button></section>";
 
 if($dbConnect){
  // echo "<section class='main_form_section'>Status: connected</section>";
}
 echo "</form></main>";
  
  }
  dbShow();
?>
  
  </body>
  </html>