<?php  
 session_start();
 session_regenerate_id();
 include 'phpVariables/variables.php'; 
 function dbSelection(){

 include 'phpFunctions/functions.php';

 $dbConnect= sessionCheck();
 function goBack()
 {
  echo "<form method='post' action='php.php'>  
  <input type='submit' value='go back' name='goBack'></form>";
  
 }

 
 if($dbConnect){

      
    
       
    $dbUsage="USE ".database_name();
 
    if(mysqli_query($dbConnect,$dbUsage)){
        echo "<header><p>selection succefull</p></header>";
        echo "<main><section>";
        echo "<header>Table list</header>";
        echo "<main><form action='tableSelect.php' method='POST'><section>
        <label for='TabSel'>choose name of table you want select</label> <select id='TabSel' name='TabSel'>";
        $ShowTables = "SHOW TABLES";
        
        $Tables = mysqli_query($dbConnect,$ShowTables);
        if(! mysqli_fetch_row($Tables)){
            echo "db empty";
        }
        
        while ($row = mysqli_fetch_row($Tables)) {
            echo "<option value='$row[0]'>$row[0]</option>";
            
        }echo "</select></section><input type='submit' value='select'></form>";}else{
            echo "<header><p>selection failed</p></header>";} 
    }}
 dbSelection();
 goBack();
?>
<!DOCTYPE html>
<html>
    <body>
        <form action="dbDel.php" method="POST"  >
        <section>
            <input type="submit" value="delete" name="delDB" id="delDB">
        </section>
        </form>
        
           
    
        <form action="tableCreate.php" method="post">
        <section>
           <label for="TabCreate">Type name of table you want create</label> <input name="TabCreate" id="TabCreate">
            <input name="tableCreate" id="tableCreate" value='create' type="submit"> 
        </section>
        </form>
    </body>
</html>