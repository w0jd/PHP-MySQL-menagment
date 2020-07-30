<?php 
 function dbSelection(){
 session_start();
 session_regenerate_id();
 $hostname="localhost";
 $username="root";
 $password="";
//  $database_name=$_POST["db_Name"];
 $dbConnect= mysqli_connect($hostname,$username,$password);


 if($dbConnect){

      
    function cookieCheck($sessionName,$inputName){
        if(isset ($_COOKIE["GoingToDBSelection"])){
            if($_COOKIE["GoingToDBSelection"]==1){
                $varName=$sessionName;
                $_COOKIE["GoingToDBSelection"]=0;
             
            }}else{
             $varName=$inputName;
            
            }
        return $varName;
        }
        
        if(isset($_POST["db_Name"])){
            $database_name =cookieCheck($_POST["db_Name"],$_POST["db_Name"]);
             $_SESSION["db_Name"]=$database_name;
        }else{
            $database_name=cookieCheck($_SESSION['db_Name'],$_SESSION['db_Name']);
            
        }

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
        }}else{
            echo "<header><p>selection failed</p></header>";}}}
 dbSelection();

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