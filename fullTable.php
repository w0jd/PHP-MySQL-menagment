<?php

session_start();
include 'phpFunctions/functions.php';
include 'phpVariables/variables.php';
function goBack()
{
  echo "<form method='post' action='tableSelect.php'>  
  <button type='submit'>Go back</button></form>";
  setcookie("goingBack","1",time()+60*60);
}
function fullTable()
{

  $dbConnect= sessionCheck();


 $database_name=$_SESSION["db_Name"];
 $tableName=$_SESSION["tableName"];

 
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
      $selColNum=0;
      $dbConnect= sessionCheck();
      $database_name=$_SESSION["db_Name"];
      $tableName=$_SESSION["tableName"];
      //$specfied=$_POST["columnName"];
     

    
     
      

      if($dbConnect){
        $dbUsage="USE ".$database_name;
        if(mysqli_query($dbConnect,$dbUsage)){
        echo "<header><p>selection succefull</p></header>";
        echo "<main><section>";
        $colList=$_SESSION['colList'];
        $specfied="";
          
        $colList = mysqli_query($dbConnect,$colList );
      
        while($row = mysqli_fetch_array($colList)){
          $rowName=  $row[0];
          if( isset($_POST[ $rowName])){
           if($selColNum<=0){
            $specfied=$specfied." ".$rowName." ";}
              else{
              $specfied=$specfied.",".$rowName." ";
            }
            $_SESSION['specyfied']=$specfied;
            $selColNum++;
           
          }
         
          
        } 
        $selColNum--;
        $specfied=$_SESSION['specyfied'];
        $specfiedTableCommand='SELECT '.$specfied.' FROM '.$tableName.';';
        echo $specfiedTableCommand;
        echo "<header> list of ".$specfied."</header><main><table><tbody>";
        $specfiedTable=mysqli_query($dbConnect,$specfiedTableCommand);
        while($row=mysqli_fetch_array($specfiedTable)){
         for($x=0; $x<=$selColNum;$x++){
          if($x==0){echo '<tr>';}
          echo "<td>".$row[$x]."</td>";
          if($x==$selColNum){echo '</tr>';}
        }}
        echo '</tbody></table></main>';
    }}




    }
  if(isset($_POST['fullData'])){
      fullTable();
    }else if(!isset($_POST['fullData'])){
      specyficData();
    }else{
      echo "both areas can't be empty";
  }
  goBack();
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