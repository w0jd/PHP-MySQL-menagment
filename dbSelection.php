<?php 
session_start();
session_regenerate_id();
$hostname="localhost";
$username="root";
$password="";
$database_name=$_POST["db_Name"];
$dbConnect= mysqli_connect($hostname,$username,$password);
$_SESSION["db_Name"]=$database_name;

if($dbConnect){

      
    
    
    $dbUsage="USE ".$database_name;
    
    if(mysqli_query($dbConnect,$dbUsage)){
        echo "<header><p>selection succefull</p></header>";
echo "<main><section>";
echo "<header>Table list</header>";
echo "<main>";
$ShowTables = "SHOW TABLES";
        $Tables = mysqli_query($dbConnect,$ShowTables);
        
      
        
        while ($row = mysqli_fetch_row($Tables)) {
            echo "<p> $row[0]</p>";
        }

}else{
    echo "<header><p>selection failed</p></header>";

}
}
?>
<!DOCTYPE html>
<html>
    <body>
        <form action="dbDel.php" method="POST"  >
        <section>
            <button value="delete" name="delDB" id="delDB">Delete data base</button>
        </section>
        </form>
        <form action="tableSelect.php" method="POST"  >
        <section>
           <label for="TabSel">Type name of table you want select</label> <input id="TabSel" name="TabSel">
            <button value="tableSelect" name="tableSelect" id="tableSelect" type="submit">Select one of tables</button>
        </section>
        </form>
        <form action="tableCreate.php" method="post">
        <section>
           <label for="TabCreate">Type name of table you want create</label> <input name="TabCreate" id="TabCreate">
            <button value="tableCreate" name="tableCreate" id="tableCreate" type="submit">create <table></table></button>
        </section>
        </form>
    </body>
</html>