<?php

session_start();
function fullTable()
{
$hostname="localhost";
$username="root";
$password="";
$dbConnect= mysqli_connect($hostname,$username,$password);


$database_name=$_SESSION["db_Name"];
$tableName=$_SESSION["tableName"];

mysqli_query($dbConnect,'SELECT * FROM'.$tableName);
if($dbConnect){
    $dbUsage="USE ".$database_name;
    if(mysqli_query($dbConnect,$dbUsage)){
        echo "<header><p>selection succefull</p></header>";
        echo "<main><section>";
    
        echo "<header> list of data</header>";
    
        echo "<main><table><thead>";

        $colSel = "DESC ".$tableName;
$colList = mysqli_query($dbConnect,$colSel);
while($row = mysqli_fetch_array($colList)){
    echo "<th> ".$row[0]."</th> ";
  

   
}
echo "</thead><tbody>";
        $selectionCommand='SELECT * FROM '.$tableName.';';
       $selection = mysqli_query($dbConnect,$selectionCommand);

       while($row= mysqli_fetch_array($selection)){
      $colNum=$_SESSION["colNum"];

      for($t=0;$t<= $colNum;$t++ ){
        if($t==0){
          echo "<tr>";}
          echo "<td>".$row[$t]."</td>";
         if($t==$colNum){
           echo "</tr>";
         }
         
      }

   
    
  }
  echo "</table>";
    }}}
    function specyficData(){
      $hostname="localhost";
$username="root";
$password="";
$dbConnect= mysqli_connect($hostname,$username,$password);
$database_name=$_SESSION["db_Name"];
$tableName=$_SESSION["tableName"];
$specfied=$_POST["columnName"];
$specfiedTableCommand='SELECT '.$specfied.' FROM '.$tableName.';';
echo $specfiedTableCommand;

if($dbConnect){
    $dbUsage="USE ".$database_name;
    if(mysqli_query($dbConnect,$dbUsage)){
        echo "<header><p>selection succefull</p></header>";
        echo "<main><section>";
    
        echo "<header> list of ".$specfied."</header>";
        $specfiedTable=mysqli_query($dbConnect,$specfiedTableCommand);
    while($row=mysqli_fetch_array($specfiedTable)){
        echo $row[0]."</br>";
    }
    }}




    }
    if($_POST['fullData']){
      fullTable();
    }else if($_POST['columnName']){
      specyficData();
    }else{
      echo "both areas can't be empty";
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  
</body>
</html>