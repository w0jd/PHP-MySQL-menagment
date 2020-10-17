<!DOCTYPE html>
<html>
    <head> <link rel="stylesheet" href="../../frontend/css/main.css"></head>
    <body>
        
           
       
      
           
<?php

 session_start();
 include '../phpFunctions/functions.php';
 include '../phpVariables/variables.php';
 function goBack(){
    echo "<form method='post' action='../dbSelection/dbSelection.php'>  
    <button type='submit'>Go back</button></form>";
    setcookie("goingBack","1",time()+60*60);}

 function tableCreation(){
    include '../phpFunctions/functions.php';
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
     $i=0;
     if($dbConnect){
        $dbUsage="USE ".$database_name;
        if(mysqli_query($dbConnect,$dbUsage)){
             echo "<aside><p>selection succefull</p></aside>";
        
            
             echo "<main class='main_container'>";
             $colSel = "DESC ".$tableName;
            
             $colList = mysqli_query($dbConnect,$colSel);
             $_SESSION['colList']=$colSel;
             echo "<form method='POST' action='../fullTable/fullTable.php' class='main_form' >";
             echo "<header class='main_form_section'>Columns list</header>";
             while($row = mysqli_fetch_array($colList)){
                     echo "<section class='main_form_section'><label for='$row[0]'>".$row[0]." "."<input type='checkbox' id='$row[0]' name='$row[0]'></section>";
                     $_SESSION["colNum"]=$i;
                     $i++;
                     
   
                 }
                 echo "<section class='main_form_section'><label for='fullData'>Show all data from selecteted table <input type='checkbox' name='fullData' id='fullData'>
                 </label></section><section class='main_form_section'><button>Send</button></section></form>";

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

            
                   
        </main>
            <section>
                    <!-- <label for="columnName">Please type a name of the coulmn you want to select </label> -->
                    <!-- <input type="text" name="columnName" id="columnName"> -->
                    <!-- </br><button type="submit" >Send</button> -->
          
                
            </section>
        </main>
    </body>
</html>