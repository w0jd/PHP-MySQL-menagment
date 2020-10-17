<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="../../frontend/css/main.css">
    <link rel="stylesheet" href="../../frontend/css/dbselection/main.css">
    </head>
    <body>
    <?php  
 session_start();
 session_regenerate_id();
 include '../phpVariables/variables.php'; 
 function dbSelection(){

 include '../phpFunctions/functions.php';

 $dbConnect= sessionCheck();
 function goBack()
 {
  echo "<form class='goBack_form' method='post' action='../main/php.php'>  
  <input type='submit' value='go back' name='goBack'></form>";
  
 }

 
 if($dbConnect){

      
    
       
    $dbUsage="USE ".database_name();
 
    if(mysqli_query($dbConnect,$dbUsage)){
        echo "<header><p class='first_header'>selection succefull</p></header>";
        echo "<main><section class='main_section'>";
        echo "<header class='first_header'>Table list</header>";
        echo "<main  class='main_container'>
        <aside class='main_aside'><p>selection</p> <p>creation</p> <p>deletion</p></aside>
        <form class='main_form'action='../tableSelect/tableSelect.php' method='POST'><section class='main_form_section'>
        <label for='TabSel'>choose name of table you want select</label></section><section class='main_form_section'> <select id='TabSel' class='section_input' name='TabSel'>";
        $ShowTables = "SHOW TABLES";
        
        $Tables = mysqli_query($dbConnect,$ShowTables);
        if(! mysqli_fetch_row($Tables)){
            echo "db empty";
        }
        
        while ($row = mysqli_fetch_row($Tables)) {
            echo "<option value='$row[0]'>$row[0]</option>";
            
        }echo "</select></section><section class='log-in'><input class='submit-button' type='submit' value='select'></section></form>";}else{
            echo "<header><p>selection failed</p></header>";} 
    }}
 dbSelection();
 goBack(); 
?>

        <form class='content_hidden'action="dbDel.php" method="POST" >
        <section class='main_form_section'>
            <input type="submit" value="delete" name="delDB" id="delDB">
        </section>
        </form>
        
           
    
        <form class='content_hidden' action="../tableCreate/tableCreate.php" method="post">
        <section class="main_form_section">
           <label for="TabCreate">Type name of table you want create</label> </section><section class="main_form_section"><input name="TabCreate" id="TabCreate"></section>
          <section class="log-in">  <input name="tableCreate" id="tableCreate" value='create' type="submit"> </section>
        </section>
        </form>
    </body>
</html>