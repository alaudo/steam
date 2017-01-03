<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title></title>
    </head>
    <body>
        
 <?php 
 
 $grade=$_POST[grade];
 
 echo "<h1> Laurel School STEAM Fair Volunteer Sign-ups</h1>";
 
     If (isset($_POST['grade'])){
        $grade=$_POST[grade];
//        print_r($_POST);
        
        switch($grade) {
         case "K":
          echo "<h1>for Kinders</h1>";  
          $query="SELECT * FROM Classroom WHERE grade LIKE 'K' ORDER BY Teacher";
          $query1="SELECT * FROM Workshop WHERE grade LIKE 'K' ORDER BY Title";
          break;
          
         case "1":
          echo "<h1>for First Grade</h1>";  
          $query="SELECT * FROM Classroom WHERE grade LIKE '1' ORDER BY Teacher";
          $query1="SELECT * FROM Workshop WHERE grade LIKE '1' ORDER BY Title";
          break;
      
         case "2":
          echo "<h1>for Second Grade</h1>";  
          $query="SELECT * FROM Classroom WHERE grade LIKE '2' ORDER BY Teacher";
          $query1="SELECT * FROM Workshop WHERE grade LIKE '2' ORDER BY Title"; 
          break;
      
         case "3":
          echo "<h1>for Third Grade</h1>";  
          $query="SELECT * FROM Classroom WHERE grade LIKE '3' ORDER BY Teacher";
          $query1="SELECT * FROM Workshop WHERE grade LIKE '3' ORDER BY Title";   
          break;

         case "4":
          echo "<h1>for Fourth Grade</h1>";  
          $query="SELECT * FROM Classroom WHERE grade LIKE '4' ORDER BY Teacher";
          $query1="SELECT * FROM Workshop WHERE grade LIKE '4' ORDER BY Title";   
          break;

         case "5":
          echo "<h1>for Fifth Grade</h1>";  
          $query="SELECT * FROM Classroom WHERE grade LIKE '5' ORDER BY Teacher";
          $query1="SELECT * FROM Workshop WHERE grade LIKE '5' ORDER BY Title";   
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
        
         
        $username="phpreader";
        $password="ReadOnly1";
        $database="Laurel";
        
        mysql_connect(localhost,$username,$password);
        @mysql_select_db($database) or die( "Unable to select database");
        
        $workshop=mysql_query($query1);
        $numworkshop=mysql_numrows($workshop);
?>
        <table>
        <form action="volRegsubmit.php" method="post">
            <input type="submit" value="Submit" /><br><br>
            <tr><td>First Name:</td><td><input type="text" name="fname" /></td> 
            <td>Last Name:</td><td><input type="text" name="lname" /></td>
            </tr>
            <tr><td>Email:</td><td><input type="text" name="ename" size="30" /> </td>
            </tr>
            <tr><td>Phone:</td><td><input type="text" name="ephone" /></td> 
                <td>Cell Phone:</td><td><input type="text" name="ephone2" /></td>
            </tr>    
        </table>
       
        <input type="checkbox" name="iagree" value="yes" /> I acknowledge that if I find after January 1 that I CANNOT volunteer,
        I am required to find my own replacement. Note that the STEAM Fair will take place on Friday, April 28, 2017.
        Please refer to 
        <a href="http://laurel.mpcsd.org/Page/411">FAQ</a>
         for more information.<br>
            <br>

            
<!--Choice table starts here:            -->

            <br><br>
            <table border="1" cellpadding="5" cellspacing="5">
            <tr>
            <td align="center" width="5"></td><td align="center"><b>Workshop</b></td><td align="center"><b>Role</b></td>
            </tr>
<!--First Choice-->
            <tr>
                <td></td><td> <select name="choice1">
<?php
        $j=0;
        while ($j < $numworkshop) {
            $workname=mysql_result($workshop,$j,"Title");
            $workID=mysql_result($workshop,$j,"ID");
            $workavaillead=mysql_result($workshop,$j,"availleaders");
            $workavailassist=mysql_result($workshop,$j,"availassistants");
           echo "<option value= $workID> $workname</option>";
            
          $j++;}  
 ?>
            <option selected='selected'>Select...</option>                       
            </select></td>
            <td>
            <input align='left' type='radio' name='role1' value='1'/>Leader
            <input align='left' type='radio' name='role1' value='2'/>Assistant
            </td>
            </tr>

        </table>
<?php
        echo "<input type='hidden' name='grade' value= $grade >";
?>        
            <br>
        </form>
<!-- Workshop table with descriptions -->
<h2>Workshop Descriptions</h2>
        <table border="1" cellpadding="5" cellspacing="5">
            <tr><td>Name</td><td>Description</td><td size="8">#Leaders Needed</td><td size="8">#Assistants Needed</td></tr>
<?php
        $j=0;
        while ($j < $numworkshop) {
            $workname=mysql_result($workshop,$j,"Title");
            $workdesc=mysql_result($workshop,$j,"Description");
            $workavaillead=mysql_result($workshop,$j,"availleaders");
            $workavailassist=mysql_result($workshop,$j,"availassistants");
            
            echo "<tr><td>$workname</td><td>$workdesc</td><td align='center'>";      
                 If ($workavaillead > 0) {
                 echo $workavaillead;}
                 Else {
                 echo "Full";} 
            echo "</td><td align='center'>";        
                 If ($workavailassist > 0) {
                 echo $workavailassist;}
                 Else {
                 echo "Full";}        
            echo "</td></td></tr>";
   
          $j++;} 
?>      
        </table>

<?php

     mysql_close();
                
     }
     Else { ?>
        <h3>Please submit the grade of your child and agree to terms</h3>
             STEAM Fair will be held on Friday, April 28, 2017. Upper Campus 
                students (3rd to 5th graders) will participate at their workshops in the morning from 9am to 11:45am.
                Lower Campus students (K to 2nd graders) will have their workshops in the afternoon from 1pm to 3pm.
                If you have children at both campuses, you are welcomed to Lead/Assist one workshop at the Upper Campus
                and another workshop in the Lower Campus. Simply sign up twice with different grades.<br>
            <br>
            <form action="assignvol.php" method="post">
            <input align="left" type="radio" name="grade" value="K"/>Kindergarten (Lower Campus)<br>
            <input align="left" type="radio" name="grade" value="1" checked/>First (Lower Campus)<br>
            <input align="left" type="radio" name="grade" value="2" />Second (Lower Campus)<br>
            <input align="left" type="radio" name="grade" value="3" />Third (Upper Campus)<br>
            <input align="left" type="radio" name="grade" value="4" />Fourth (Upper Campus)<br>
            <input align="left" type="radio" name="grade" value="5" />Fifth (Upper Campus)<br>
            <br>
            <input type="submit" name="submit"/>  
            </form>
<?
     }
                             
?>
                 
   </body>
</html>