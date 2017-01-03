<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Laurel Art and Science Registration</title>
    </head>
    <body bgColor="#FFCC66">
        
 <?php 
 
 $grade=$_POST[grade];
    
 echo "<h1> Laurel School STEAM Fair Registration</h1>";
 
     If (isset($_POST['grade'])){
        $grade=$_POST[grade];
 //       print_r($_POST);
        
        switch($grade) {
         case "K":
          echo "<br><h1>for Kindergartners</h1><br>";  
          $query="SELECT * FROM Classroom WHERE grade LIKE 'K' ORDER BY Teacher";
          $query1="SELECT * FROM Workshop WHERE grade LIKE 'K' ORDER BY Title";
          break;
          
         case "1":
          echo "<br><h1>for First Graders</h1><br>";  
          $query="SELECT * FROM Classroom WHERE grade LIKE '1' ORDER BY Teacher";
          $query1="SELECT * FROM Workshop WHERE grade LIKE '1' ORDER BY Title";
          break;
      
         case "2":
          echo "<br><h1>for Second Graders</h1><br>";  
          $query="SELECT * FROM Classroom WHERE grade LIKE '2' ORDER BY Teacher";
          $query1="SELECT * FROM Workshop WHERE grade LIKE '2' ORDER BY Title"; 
          break;
      
         case "3":
          echo "<br><h1>for Third Graders</h1><br>";  
          $query="SELECT * FROM Classroom WHERE grade LIKE '3' ORDER BY Teacher";
          $query1="SELECT * FROM Workshop WHERE grade LIKE '3' ORDER BY Title";   
          break;
        }
        
//        
//        If ($grade =='K'){
//          echo "<br><h1>for Kindergartners</h1><br>";  
//          $query="SELECT * FROM Kclassrm ORDER BY Teacher";
//          $query1="SELECT * FROM KWorkshop";
//        }
//        Else {
//          echo "<br><h1>for First and Second graders</h1><br>";
//          $query="SELECT * FROM 12classrm ORDER BY Teacher";
//          $query1="SELECT * FROM 12Workshop";
//        }
        
        echo "<h3 style='color:green'>*Please double check your entries before hitting submit.<br>
                Hitting the submit button will reserve your child's choices.<br>
                You will need to contact an Art and Science coordinator to make changes. </h3><br>";
         
        $username="phpreader";
        $password="ReadOnly1";
        $database="Laurel";
        
        mysql_connect(localhost,$username,$password);
        @mysql_select_db($database) or die( "Unable to select database");
        
//        $query="SELECT * FROM 12classrm ORDER BY Teacher";
        $teachers=mysql_query($query);
        $numteachers=mysql_numrows($teachers);
        
//        $query1="SELECT * FROM 12Workshop";
        $workshop=mysql_query($query1);
        $numworkshop=mysql_numrows($workshop);
?>
        <form action="Regsubmit.php" method="post">
            <input type="submit" value="Submit" /><br><br>
            Child's First Name: <input type="text" name="fname" />   Child's Last Name:<input type="text" name="lname" />
            <br><br>
            Any food allergies, please list <input type="text" name="allergies" size="50" /><br><br>
            
            <b>Important information for PARENT VOLUNTEERS</b><br>
            If you want your child to be in your workshop with you, you MUST rank that workshop FIRST!<br>    
            Parent Name:<input size="60" type="text" name="pname" /><br>
            Parent Workshop:
            <select name="pchoice">   
<?php
        $j=0;
        while ($j < $numworkshop) {
            $workname=mysql_result($workshop,$j,"Title");
            $workID=mysql_result($workshop,$j,"ID");
           echo "<option value= $workID selected> $workname</option>";
            
          $j++;}  
 ?>
            <option selected='selected'>Select...</option> 
            </select>
            <br><br>
            Check this box if you definitely want your child to be in your workshop: <input type="checkbox" name="childwork" value="1" /> 
            <!-- Can include all teachers. Can sort out Kinder vs. 1-2 later -->
            <br><br>
            Teacher: <select name="teacher">
<?php
        $i=0;
        while ($i < $numteachers) {
            $tname=mysql_result($teachers,$i,"Teacher");
			$tID=mysql_result($teachers,$i,"ID");
            
           echo "<option value= $tID selected> $tname </option>";
            
          $i++;}  
?> 
            <option selected='selected'>Select...</option>
            </select>

            <br><br>            
<!--Choice table starts here:            -->
<b>Please select at least 4 workshops</b>
            <br><br>
            <table border="1" cellpadding="5" cellspacing="5">
            <tr>
            <td align="center"><b>Choice</b></td><td align="center"><b>Workshop</b></td>
            </tr>
<!--First Choice-->
            <tr>
                <td>First</td><td> <select name="choice1">
<?php
        $j=0;
        while ($j < $numworkshop) {
            $workname=mysql_result($workshop,$j,"Title");
            $workID=mysql_result($workshop,$j,"ID");
           echo "<option value= $workID selected> $workname</option>";
            
          $j++;}  
 ?>
            <option selected='selected'>Select...</option>                       
            </select></td>
            </tr>
         
<!--Second Choice -->
             <tr>
                <td>Second</td><td> <select name="choice2">
<?php
        $j=0;
        while ($j < $numworkshop) {
            $workname=mysql_result($workshop,$j,"Title");
            $workID=mysql_result($workshop,$j,"ID");
           echo "<option value= $workID selected> $workname </option>";
            
          $j++;}  
?> 
                <option selected="selected">Select...</option>                        
            </select></td>
            </tr>           

<!--Third Choice-->
            <tr>
                <td>Third</td><td> <select name="choice3">
<?php
        $j=0;
        while ($j < $numworkshop) {
            $workname=mysql_result($workshop,$j,"Title");
            $workID=mysql_result($workshop,$j,"ID");
           echo "<option value= $workID selected> $workname </option>";
            
          $j++;}  
?>
                <option selected="selected">Select...</option>                        
            </select></td></tr>
  
<!--Fourth Choice-->
            <tr>
                <td>Fourth</td><td> <select name="choice4">                  
<?php
        $j=0;
        while ($j < $numworkshop) {
            $workname=mysql_result($workshop,$j,"Title");
            $workID=mysql_result($workshop,$j,"ID");
           echo "<option value= $workID selected> $workname </option>";
            
          $j++;}  
?>
                <option selected="selected">Select...</option>                              
            </select></td></tr>

<!--Fifth Choice-->
            <tr>
                <td>Fifth</td><td> <select name="choice5">                        
<?php
        $j=0;
        while ($j < $numworkshop) {
            $workname=mysql_result($workshop,$j,"Title");
            $workID=mysql_result($workshop,$j,"ID");
           echo "<option value= $workID selected> $workname </option>";
            
          $j++;}  
?>
                <option selected="selected">Select...</option>                       
            </select></td></tr>
            
<!-- Sixth Choice -->
            <tr>
                <td>Sixth</td><td> <select name="choice6">                     
<?php
        $j=0;
        while ($j < $numworkshop) {
            $workname=mysql_result($workshop,$j,"Title");
            $workID=mysql_result($workshop,$j,"ID");
           echo "<option value= $workID selected> $workname </option>";
            
          $j++;}  
?>
                <option selected="selected">Select...</option>                          
            </select></td></tr>      
        </table>
<?php
        echo "<input type='hidden' name='grade' value= $grade >";
?>        
            <br>
        </form>
<!-- Workshop table with descriptions -->
<h2>Workshop Descriptions</h2>
        <table border="1" cellpadding="5" cellspacing="5">
        <tr><td>Name</td><td>Description</td></tr>
<?php
        $j=0;
        while ($j < $numworkshop) {
            $workname=mysql_result($workshop,$j,"Title");
            $workdesc=mysql_result($workshop,$j,"Description");
           echo "<tr><td>$workname</td><td>$workdesc</td></tr>";
            
          $j++;} 
?>      
        </table>

<?php

     mysql_close();
                
     }
     Else { ?>
        <h3>Please submit the grade of your child</h3><br>
            <form action="assign.php" method="post">
            <input align="left" type="radio" name="grade" value="K"/>Kindergarten<br>
            <input align="left" type="radio" name="grade" value="1" checked/>First<br>
            <input align="left" type="radio" name="grade" value="2" />Second<br>
            <input align="left" type="radio" name="grade" value="3" />Third<br>
            <input type="submit" name="submit"/>  
            </form>
<?
     }
                             
?>
                 
   </body>
</html>