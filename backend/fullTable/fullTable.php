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
      // echo $tableName;
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
  // print_r($_COOKIE);
  // echo "aaaaaaaa".$_COOKIE['cathedBoxes'];




  if($dbConnect) {
    $dbUsage="USE ".$database_name;

    if(mysqli_query($dbConnect, $dbUsage)) {
      echo "<header  class='main_header first_header'><p class='main_header_paragraph'>selection succefull</p></header>";
      echo "<main class='main_container main_form' ><section class='main_section'>";
     
      $specfied="";
      $selectionCommand="";
      
      echo "<main class='sub_main'><table class='table'><thead class='table_header'>";
      if(isset($_SESSION['allTables'])) {
        // $selectionCommand=$selectionCommand." ".$_SESSION['join'];
        // echo $selectionCommand;
        $re=$_COOKIE['cathed'];
        // echo "gówno".$re;
        // $cookiesString=implode(", ",$_COOKIE['cathedBoxes']);

        // $specfied=$_SESSION['specyfied'];

        // echo $cookiesString;
        $specfiedTableCommand=$re.' FROM '.$tableName.$_SESSION['join'].';';
        // echo $specfiedTableCommand;
      }


      else {
        $colList=$_SESSION['colList'];
        $colList=mysqli_query($dbConnect, $colList);
        $specfied=$_SESSION['specyfied'];
        $specfiedTableCommand='SELECT '.$specfied.' FROM '.$tableName.';';
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
      }}

      echo "</tr></thead><tbody>";
      $selColNum--;
     
      echo $specfiedTableCommand;

      $specfiedTable=mysqli_query($dbConnect, $specfiedTableCommand);
      
      while($row=mysqli_fetch_array($specfiedTable)) {
        // echo $row[1].$row[0];
        $x=0;
        while(isset($row[$x])) {
          if($x==0) {
            echo '<tr>';
          }
          // echo "aaaaaaa".$x;
          echo "<td>".$row[$x]."</td>";

          if($x==$selColNum) {
            echo '</tr>';
          }
          $x++;
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