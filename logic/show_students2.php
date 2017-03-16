    <section id="portfolio">
        <div class="">
            <div class="">
                <div class="">
                    <?php
                    $query = "SELECT S.Grade, Teacher, StudentLast, StudentFirst 
                            , W1.Title AS Choice1
                            , W2.Title AS Choice2
                            , W3.Title AS Choice3
                            , W4.Title AS Choice4
                            , W5.Title AS Choice5
                            , W6.Title AS Choice6
                            , ParentVolunteer AS ChildInWorkshop
                            , Allergy
                            , ParentLast
                            , ParentFirst
                            , PW.Title AS ParentWorkshop
                            , S.LastReg
                            , S.RegAttempts
                            FROM 
                            (SELECT C.Grade, C.Teacher, F.StudentLast, F.StudentFirst, F.S1, F.S2, F.S3, F.S4, F.S5, F.S6, CASE WHEN ParentVolunteer = 1 THEN 'Yes' ELSE 'No' END AS ParentVolunteer ,Allergy, ParentLast, ParentFirst, parentwork, X.LastReg, X.RegAttempts FROM ( select MAX(Regdate2) as LastReg, COUNT(*) AS RegAttempts from `Students` group by CONCAT(TRIM(StudentLast), TRIM(StudentFirst), TRIM(Teacher)) ) as X inner join `Students` as F on F.Regdate2 = x.LastReg INNER JOIN Classroom AS C ON C.ID = F.Teacher) S 
                            INNER JOIN Workshop W1 ON S.S1 = W1.ID
                            INNER JOIN Workshop W2 ON S.S2 = W2.ID
                            INNER JOIN Workshop W3 ON S.S3 = W3.ID
                            INNER JOIN Workshop W4 ON S.S4 = W4.ID
                            INNER JOIN Workshop W5 ON S.S5 = W5.ID
                            INNER JOIN Workshop W6 ON S.S6 = W6.ID
                            INNER JOIN Workshop PW ON S.parentwork = PW.ID

                            ORDER BY S.Grade, Teacher, StudentLast, StudentFirst"; 
                    
                    $result = mysql_query($query);
                    // echo $query;

                    echo "<table class='table table-sm table-hover'>"; 
                    echo "<thead><tr><th>Grade</th><th>Teacher</th><th>StudentLast</th><th>StudentFirst</th><th>Choice1</th><th>Choice2</th><th>Choice3</th><th>Choice4</th><th>Choice5</th><th>Choice6</th><th>ChildInWorkshop</th><th>Allergy</th><th>ParentLast</th><th>ParentFirst</th><th>ParentWorkshop</th><th>Last Registration</th><th>Attempts</th></tr>"; 
                    echo "<tbody>"; 

                    while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
                    echo "<tr><td>" . $row['Grade'] . "</td><td>" . $row['Teacher'] . "</td><td>" . $row['StudentLast'] . "</td><td>" . $row['StudentFirst'] . "</td><td>" . $row['Choice1'] . "</td><td>" . $row['Choice2'] . "</td><td>" . $row['Choice3'] ."</td><td>" . $row['Choice4'] ."</td><td>" . $row['Choice5'] ."</td><td>" . $row['Choice6'] ."</td><td>" . $row['ChildInWorkshop'] . "</td><td>" . $row['Allergy'] . "</td><td>"  . $row['ParentLast'] . "</td><td>" . $row['ParentFirst'] . "</td><td>" . $row['ParentWorkshop'] . "</td><td>" . $row['LastReg'] . "</td><td>" . $row['RegAttempts'] . "</td></tr>";  //$row['index'] the index here is a field name
                    }

                    echo "</tbody>"; 
                    echo "</table>"; //Close the table in HTML
                    ?>
                </div>
            </div>        
       </div>
    </section>
