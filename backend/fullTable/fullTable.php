<!DOCTYPE html>
<html lang="pl"><head>
  <meta charset="UTF-8">
  <meta name="viewport"content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet"href="../../frontend/css/main.css">
  <link rel="stylesheet"href="../../frontend/css/fullTable/main.css">
  </head>
  <body class="body_container">
  <?php 
  // error_reporting(0);
// ini_set('display_errors', 0);
session_start();
include '../phpFunctions/functions.php';
include '../phpVariables/variables.php';

function goBack() {
  echo "<form class='goBack_form' method='post' action='../tableSelect/tableSelect.php'>  
<button type='submit'>Go back</button></form>";
setcookie("goingBack", "1", time()+60*60);
}

function fullTable() {

  $dbConnect=sessionCheck();


  $database_name=$_SESSION["db_Name"];
  $tableName=$_SESSION["tableName"];


  if($dbConnect) {
    $dbUsage="USE ".$database_name;

    if(mysqli_query($dbConnect, $dbUsage)) {


      echo "<header class='main_header first_header'><p class='main_header_paragraph'>selection succefull</p></header>";
      echo "<main class='main_container main_form'  ><section class='main_section'>";

      echo "<header class='main_section_header'> list of data</header>";

      echo "<main class='sub_main '><table class='table'><thead class='table_header'>";

      $colSel="DESC ".$tableName;
      $colList=mysqli_query($dbConnect, $colSel);
      echo $tableName;
      $selectionCommand='SELECT * FROM '.$tableName;

      if(isset($_SESSION['allTables'])) {
        $selectionCommand=$selectionCommand." ".$_SESSION['join'];
      }

      else {
        while($row=mysqli_fetch_array($colList)) {
          echo "<th> ".$row[0]."</th> ";
        }
      }

      $selectionCommand=$selectionCommand.";";
      // echo $selectionCommand;
      echo "</thead><tbody class='table_body'>";

      $selection=mysqli_query($dbConnect, $selectionCommand);

      while($row=mysqli_fetch_array($selection)) {
        $colNum=$_SESSION["colNum"];
        echo "<tr>";
        $t=0;

        while(isset($row[$t])) {

          echo "<td>".$row[$t]."</td>";

          $t++;

        }

        echo "</tr>";



      }

      echo "</tbody></table></main></section></main>";
    }
  }
}

function specyficData() {
  $selColNum=0;
  $dbConnect=sessionCheck();
  $database_name=$_SESSION["db_Name"];
  $tableName=$_SESSION["tableName"];
  //$specfied=$_POST["columnName"];






  if($dbConnect) {
    $dbUsage="USE ".$database_name;

    if(mysqli_query($dbConnect, $dbUsage)) {
      echo "<header  class='main_header first_header'><p class='main_header_paragraph'>selection succefull</p></header>";
      echo "<main class='main_container main_form' ><section class='main_section'>";
      $colList=$_SESSION['colList'];
      $specfied="";

      $colList=mysqli_query($dbConnect, $colList);
      echo "<main class='sub_main'><table class='table'><thead class='table_header'>";

      while($row=mysqli_fetch_array($colList)) {
        // loop to check which cols were selected
        $rowName=$row[0]; // asing value string of row to variable

        if(isset($_POST[ $rowName])) {
          //checking what was selected

          echo "<th>".$row[0]."</th>";

          if($selColNum<=0) {
            //if it's first value don't write ","
            $specfied=$specfied." ".$rowName." ";
          }

          else {
            $specfied=$specfied.",".$rowName." "; //if it's not first value then wirete "," before it
          }

          $_SESSION['specyfied']=$specfied;
          $selColNum++;
        }
      }

      echo "</tr></thead><tbody>";
      $selColNum--;
      $specfied=$_SESSION['specyfied'];
      $specfiedTableCommand='SELECT '.$specfied.' FROM '.$tableName.';';


      $specfiedTable=mysqli_query($dbConnect, $specfiedTableCommand);

      while($row=mysqli_fetch_array($specfiedTable)) {
        for($x=0; $x<=$selColNum; $x++) {
          if($x==0) {
            echo '<tr>';
          }

          echo "<td>".$row[$x]."</td>";

          if($x==$selColNum) {
            echo '</tr>';
          }
        }
      }

      echo '</tbody></table></main></section></main>';
    }
  }




}

if(isset($_POST['fullData'])) {
  fullTable();
}

else if( !isset($_POST['fullData'])) {
  specyficData();
}

else {
  echo "both areas can't be empty";
}

goBack();

?></body></html>