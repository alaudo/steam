    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <?php
                    $query = "SELECT CONCAT(C.Grade, ' ', C.Teacher) AS Grade, CONCAT(F.StudentLast, ', ', F.StudentFirst) AS Student, CONCAT(F.S1, ' ', F.S2, ' ', F.S3, ' ', F.S4, ' ', F.S5, ' ', F.S6) AS Pref, X.LastReg, X.RegAttempts FROM ( select MAX(Regdate2) as LastReg, COUNT(*) AS RegAttempts from `Students` group by CONCAT(StudentLast, StudentFirst, Teacher) ) as X inner join `Students` as F on F.Regdate2 = x.LastReg INNER JOIN Classroom AS C ON C.ID = F.Teacher ORDER BY X.LastReg ASC"; 
                    
                    $result = mysql_query($query);

                    echo "<table class='table table-sm table-hover'>"; 
                    echo "<thead><tr><th>Grade</th><th>Student</th><th>Preferences</th><th>Last</th><th>Attempts</th></tr>"; 
                    echo "<tbody>"; 

                    while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
                    echo "<tr><td>" . $row['Grade'] . "</td><td>" . $row['Student'] . "</td><td>" . $row['Pref'] ."</td><td>" . $row['LastReg'] . "</td><td>" . $row['RegAttempts'] . "</td></tr>";  //$row['index'] the index here is a field name
                    }

                    echo "</tbody>"; 
                    echo "</table>"; //Close the table in HTML
                    ?>
                </div>
            </div>        
       </div>
    </section>
