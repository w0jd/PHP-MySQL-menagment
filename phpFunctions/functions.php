<?php 
function mysqlConection(){
 $hostname="localhost";
 $username="root";
 $password="";
 $dbConnect= mysqli_connect($hostname,$username,$password);
 return $dbConnect;
}
?>