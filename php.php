<?php 
$hostname="localhost";
$username="root";
$password="";
$database_name;
$dbConnect= mysqli_connect($hostname,$username,$password);
$dbShow="SHOW DATABASES;";
$db_list = mysqli_query($dbConnect, "SHOW DATABASES");

echo "</br>"."db list"."</br>"."</br>";
while ($row = mysqli_fetch_array($db_list)) {
 echo $row[0]."</br>";
}  
if($dbConnect){
    echo "</br>"."connected"."</br>"."</br>";

}
  ?>
  <!DOCTYPE html>
  <html lang="pl">
<head>
    <meta charset="UTF-8">
    
    <title>Document</title>
</head>
<body>
  <main>
      <form action="dbSelection.php" method="POST">
          <label for="dbName">Please type database name</label>
          <input  name="db_Name" id="dbName">
            <button type="submit"> Select</button>
        </main>

    </body>
  </html>