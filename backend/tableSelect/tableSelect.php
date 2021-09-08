<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../../frontend/css/main.css">
    <link rel="stylesheet" href="../../frontend/css/tableSelect/main.css">
    <script src="../../frontend/javascript/selection.js" async defer></script>
</head>

<body>





    <?php
    error_reporting(0);
    ini_set('display_errors', 0);
    session_start();
    include '../phpFunctions/functions.php';
    include '../phpVariables/variables.php';
    class refrerenceInformation{
        public $tableName=array();
        public $columnName=array();
        public $referencedTableName=array();
        public $referencedColumnName=array();
    }
    function goBack(){
        echo "<form class='goBack_form' method='post' action='../dbSelection/dbSelection.php'>  
        <button type='submit'>Go back</button></form>";

        setcookie("goingBack","1",time()+60*60);}
    function allTables(){
        
        $dbConnect= sessionCheck();    
        $database_name="USE information_schema";
        $dbSelection=mysqli_query($dbConnect,$database_name);
        if($dbSelection){
            $tableName="KEY_COLUMN_USAGE";    
            $searchingQuery="SELECT TABLE_NAME,COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM ".$tableName." WHERE REFERENCED_COLUMN_NAME is NOT NULL and TABLE_SCHEMA='".$_SESSION["db_Name"]."'";
        //   echo $searchingQuery;
            $i=0;
            $j=0;
            $tableSel=mysqli_query($dbConnect,$searchingQuery);
            // echo $searchingQuery;
            if($tableSel){
            // echo "a";
                $not="";
                $objectName=new refrerenceInformation();
                $joiningQuery="";
                while($row = mysqli_fetch_array($tableSel)){
                    // echo "<p>".$row[0]."</p>";
                    

                    
                   
                    $objectName->tableName[$i]=$row[0];
                    $objectName->columnName[$i]=$row[1]; 
            
                    $objectName->referencedTableName[$i]=$row[2]; 
                    $objectName->referencedColumnName[$i]=$row[3]; 
                    $joiningQuery=$joiningQuery." inner join ".$row[2]." on ".$row[1]." = ".$row[3];
                    // echo "a";
                    // echo $row[0]."/".$row[1]."/".$row[2]."/".$row[3]."</br>";
                    $not=$not."and table_name!='".$row[2]."' ";
                    // echo $objectName;
                    
                    $i++; 
                }

                // print_r($objectName->tableName);

                // echo $not;
                // echo $joiningQuery;
                // echo $tableName;
                $newQuery="SELECT TABLE_NAME FROM ".$tableName." WHERE REFERENCED_COLUMN_NAME is NOT NULL and TABLE_SCHEMA='".$_SESSION["db_Name"]."'".$not;
                // echo $newQuery;
                $mainTable=mysqli_query($dbConnect,$newQuery);
                if($mainTable){

                    $row = mysqli_fetch_array($mainTable);
                    $mainTable=  $row[0];
                }
                // echo "asasasas".$mainTable;
                $useDB="USE ".$_SESSION["db_Name"];
                $dbUsage=mysqli_query($dbConnect,$useDB);
                if($dbUsage){
                $showTables="DESC ".$mainTable.";";
                // echo $showTables;
                echo "<header class='first_header'><p>selection succefull</p></header>";
                
                echo "<main><section class='main_section'>";
                echo "<main class='main_container'>";
                $showTablesExecution=mysqli_query($dbConnect,$showTables);
                if($showTablesExecution){
                    // echo "aca";
                    echo "<form method='POST' action='../fullTable/fullTable.php' class='main_form' >";
                    echo "<header class='main_form_section'>Columns list</header>";
                   while( $row=mysqli_fetch_array($showTablesExecution)){
                        echo "<section class='main_form_section'>
                        <label for='$row[0]'>".$row[0]." "."<input type='checkbox' class='selcection' id='$row[0]' name='selection' value='$row[0]'></section>";

                    //    echo "aa";
                   }

                }}
                for($o=0;$o<$i;$o++){    
                    // echo $objectName->tableName[0];
                    $showTables="Desc ".$objectName->referencedTableName[$o].";";
                    // print_r($objectName->referencedTableName);
                    // echo "gggg".$showTables;
                    $showTablesExecution=mysqli_query($dbConnect,$showTables);
                    // echo $showTables;
                    if($showTablesExecution){
                        // echo "aca";
                       while( $row=mysqli_fetch_array($showTablesExecution)){
                            echo "<section class='main_form_section'><label for='$row[0]'>".$row[0]." "."<input name='selection'  class='selcection' type='checkbox' id='$row[0]' value='$row[0]'></section>";

                        //    echo "aa";
                       }
                        
                    }
                }
                $_SESSION['mainTable']=$mainTable;
            $searchingQuery="SELECT* FROM ".$mainTable." WHERE REFERENCED_COLUMN_NAME is NOT NULL and TABLE_SCHEMA='".$_SESSION["db_Name"]."'";
                
            }    

                // echo "ab";
        }
        echo "<section class='main_form_section'><label for='fullData'>Show all data from selecteted table <input class='fullData' type='checkbox' name='fullData' id='fullData'>
        </label></section><section class='main_form_section' id='last_section'><button class='send_btn' >Send</button></section></form></main>";
        // goBack();
    }
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
                    echo "<header class='first_header'><p>selection succefull</p></header>";
                
                    echo "<main><section class='main_section'>";
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
                        </label></section><section class='main_form_section'><button>Send</button></section></form></main>";

                    }
            
            }
        $_SESSION["tableName"]=$tableName;}
        

        
            
        if(isset($_POST["TabSel"])||isset($_POST["TabCreate"])){
            if(isset($_POST['allTables'])){
                    allTables();
            } else{
                if($_POST["TabSel"]){
                    tableSelect();

                        }else if($_POST["TabCreate"]){
                            tableCreation();
                            // goBack();
                                }else{
                                    echo "you have to fill up one of the areas";}
                                    // goBack();   
                }}else{
                    tableSelect();
                    // goBack();
                                        
        }
  goBack();
 ?>




    </section>
    <section>
        <!-- <label for="columnName">Please type a name of the coulmn you want to select </label> -->
        <!-- <input type="text" name="columnName" id="columnName"> -->
        <!-- </br><button type="submit" >Send</button> -->


    </section>
    </main>
    <!-- <script src="../../frontend/javascript/selection.js">

    // btn.addEventListener("mouseover",function(){ console.log("chuj")}  )


</script> -->
</body>

</html>