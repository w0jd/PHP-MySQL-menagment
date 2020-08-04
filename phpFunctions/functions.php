<?php 
function sessionCheck(){
    if(isset($_SESSION['hostname'])){
        $hostname=$_SESSION['hostname'];
        $username=$_SESSION['username'];
        $password=$_SESSION['password'];
        $dbConnect=  mysqlConection($hostname,$username,$password);
        return  $dbConnect;
    }else{
        $hostname=$_POST['hostname'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $dbConnect=  mysqlConection($hostname,$username,$password);
        return  $dbConnect;
    }
}
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