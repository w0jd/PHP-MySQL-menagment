<?php
session_start();
function tableCreation(){
    $hostname="localhost";
    $username="root";
    $password="";
    $dbConnect= mysqli_connect($hostname,$username,$password);
    $database_name=$_SESSION["db_Name"];
    $tableName=$_POST["TabCreate"];
    $creationCommand="Create TABLE IF NOT EXIST ".$tableName.";";
    $creationQuery=mysqli_query($dbConnect,$creationCommand);



}
function cookieCheck(){
    if(isset ($_COOKIE["goingBack"])){
        if($_COOKIE["goingBack"]==1){
            $tableName=$_SESSION['tableName'];
            $_COOKIE["goingBack"]=0;
        }}else{
         $tableName=$_POST["TabSel"];
        }
    return $tableName;
    }
function tableSelect()
{

 $hostname="localhost";
 $username="root";
 $password="";
 $dbConnect= mysqli_connect($hostname,$username,$password);
 $database_name=$_SESSION["db_Name"];
 $tableName =cookieCheck();
 $colNum=0;
 $i=-1;
 if($dbConnect){
        $dbUsage="USE ".$database_name;
        if(mysqli_query($dbConnect,$dbUsage)){
             echo "<header><p>selection succefull</p></header>";
             echo "<main><section>";
             echo "<header>Columns list</header>";
             echo "<main>";
             $colSel = "DESC ".$tableName;
             $colList = mysqli_query($dbConnect,$colSel);
             while($row = mysqli_fetch_array($colList)){
                     echo $row[0]."<br>";
                     $i++;
                     $_SESSION["colNum"]=$i;
   
                 }

            }
    
    }
  $_SESSION["tableName"]=$tableName;}
if(isset($_POST["TabSel"])||isset($_POST["TabCreate"])){
    if($_POST["TabSel"]){
        tableSelect();

            }else if($_POST["TabCreate"]){
                tableCreation();
  
                    }else{
                        echo "you have to fill up one of the areas";}
                            }else{
                                tableSelect();}
?>
<!DOCTYPE html>
<html>
    <body>
        <main>
            <section>
                <form action="fullTable.php" method="POST">
                    <input type="checkbox" name="fullData" id="fullTData">
                    <label for="fullData">Show all data from selecteted table</label>
            </section>
            <section>
                    <label for="columnName">Please type a name of the coulmn you want to select </label>
                    <input type="text" name="columnName" id="columnName">
                    </br><button type="submit" >Send</button>
                </form>
                
            </section>
        </main>
    </body>
</html>