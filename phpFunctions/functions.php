<?php 
function mysqlConection($hostname,$username,$password){

 $dbConnect= mysqli_connect($hostname,$username,$password);
 return $dbConnect;
}
function cookieCheck($sessionName,$inputName){
    if(isset ($_COOKIE["goingBack"])){
        if($_COOKIE["goingBack"]==1){
            $varName=$sessionName;
            $_COOKIE["goingBack"]=0;
         
        }}else{
         $varName=$inputName;
        
        }
    return $varName;
}
?>