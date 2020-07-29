<?php
session_start();
function tableSelect(){

$hostname="localhost";
$username="root";
$password="";
$dbConnect= mysqli_connect($hostname,$username,$password);
$database_name=$_SESSION["db_Name"];
if(isset ($_COOKIE["goingBack"])){
if($_COOKIE["goingBack"]==1){
    $tableName=$_SESSION['tableName'];
    $_COOKIE["goingBack"]=0;
}}else{
$tableName=$_POST["TabSel"];}
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
tableSelect();
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