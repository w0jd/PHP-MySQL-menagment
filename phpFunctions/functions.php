<?php 
function sessionCheck(){
    if(isset($_SESSION['hostname'])){
        $hostname=$_SESSION['hostname'];
        $username=$_SESSION['username'];
        $password=$_SESSION['password'];
       
        $dbConnect=  mysqlConection($hostname,$username,$password);
        return  $dbConnect;
    }else{
        session_start();
        session_regenerate_id();
        $hostname=$_POST['hostname'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $_SESSION['hostname']=$hostname;
       $_SESSION['username']= $username;
       $_SESSION['password']=$password;
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
function database_name() {
    if(isset($_POST["db_Name"])){
        $database_name =cookieCheck($_POST["db_Name"],$_POST["db_Name"]);
         $_SESSION["db_Name"]=$database_name;
    }else{
        $database_name=cookieCheck($_SESSION['db_Name'],$_SESSION['db_Name']);
        
    }
    return $database_name;
 }
?>