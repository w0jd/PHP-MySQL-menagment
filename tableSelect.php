<?php

 session_start();
 include 'phpFunctions/functions.php';
 function goBack(){
    echo "<form method='post' action='dbSelection.php'>  
    <button type='submit'>Go back</button></form>";
    setcookie("goingBack","1",time()+60*60);}

 function tableCreation(){
    include 'phpFunctions/functions.php';
    $dbConnect= sessionCheck();
    $database_name=$_SESSION["db_Name"];
    $tableName=$_POST["TabCreate"];
    $creationCommand="Create TABLE IF NOT EXIST ".$tableName.";";
    $creationQuery=mysqli_query($dbConnect,$creationCommand);}
 function tableSelect(){

 
    $dbConnect= sessionCheck();
    $database_name=$_SESSION["db_Name"];
    if(isset($_POST["TabSel"])){
     $tableName =cookieCheck($_POST["TabSel"],$_POST["TabSel"]);
     }else{
     $tableName=cookieCheck($_SESSION['tableName'],$_SESSION['tableName']);}
                          
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
             echo $tableName;
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
                goBack();
                    }else{
                        echo "you have to fill up one of the areas";}
                        goBack();   
                        }else{
                                tableSelect();
                                goBack();
                            
                            }
 
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