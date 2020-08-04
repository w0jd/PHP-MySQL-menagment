<?php


session_start();
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
?>