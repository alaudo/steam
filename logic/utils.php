 <?php 
    //require_once("underscore.php");

   
    class utils {
        // mapping from one array to another using rules
        public static function map($from, $rules, $con) {
            $ret = array();
            foreach($rules as $key => $value) {
                if (isset($from[$key])) $ret[$value] = mysqli_real_escape_string($con, $from[$key]);
            }
            return $ret;
        }

        public static function ifset($from, $key, $setvalue) {
            if (isset($from[$key])) {
                echo($setvalue);
                return $setvalue;
            } else {
                return false;
            }
        }

        public static function ifequals($from, $key, $value, $setvalue) {
            if ($from[$key] == $value) {
                echo($setvalue);
                return $setvalue;
            } else {
                return false;
            }
        }

        public static function ifexists($from, $key) {
            if (isset($from[$key])) {
                echo($from[$key]);
                return $from[$key];
            } else {
                return false;
            }
        }

        public static function enrich(&$student) {
            
            if (isset($student["email"]) && isset($student["name_first"]) && isset($student["name_last"])) {
                $student["showstep2"] = true;
            }

            if (isset($student["class"])) {
                $query = mysql_query("SELECT * FROM Classroom WHERE ID =" . $student["class"] );
                $student["grade"] = mysql_result($query,0,"Grade");
                $student["room"] = mysql_result($query,0,"Room");
                $student["teacher"] = mysql_result($query,0,"Teacher");
            }

            if (isset($student["email"])) {
                $query = mysql_query("SELECT * FROM Volunteers WHERE Email ='" . $student["email"] . "'" );
                // if email is not valid, trying to match names
                if (mysql_numrows($query) < 1) $query = mysql_query("SELECT * FROM Volunteers WHERE Grade ='" . $student["grade"] . "' AND First='" . $student["parent_first"] ."' AND Last ='". $student["parent_last"] ."'" );

                if (mysql_numrows($query) > 0) {
                    $student["is_parent_workshop"] = true;

                    $workshop = array();

                    $workshop["workshop"] = utils::getworkshop(mysql_result($query,0,"workshop1"));
                    $workshop["role"] = mysql_result($query,0,"role1");
                    $workshop["parent_first"] = mysql_result($query,0,"First");
                    $workshop["parent_last"] = mysql_result($query,0,"Last");
                    $workshop["grade"] = mysql_result($query,0,"Grade");
                    $workshop["regdate"] = mysql_result($query,0,"regdate2");
                    $workshop["phone"] = mysql_result($query,0,"phone");
                    $workshop["phone2"] = mysql_result($query,0,"phone2");
                    $workshop["email"] = mysql_result($query,0,"email");

                    $student["parent_workshop"] = $workshop;

                } else {
                    $student["is_parent_workshop"] = false;
                }

            if (isset($student["grade"])) {
                    
                if (isset($student["workshopsorder"]) && $student["workshopsorder"] != '') {
                    $i = 1;
                    $workshops = array();
                    foreach (explode('&',$student["workshopsorder"]) as $foo) {
                        $id = intval(explode('=',$foo)[1]);
                        $workshops[$i] = utils::getworkshop($id);
                        $i++;
                    }
                    $student["workshops"] = $workshops;
                
                } else {
                    $query = mysql_query("SELECT ID FROM Workshop WHERE Grade =" . $student["grade"] );
                    $workshops = array();
                    $workshops[1] = utils::getworkshopseparator();
                    $i = 2;
                    while ($row = mysql_fetch_array($query)) {
                        $workshops[$i] = utils::getworkshop($row["ID"]);
                        $i++;
                    }
                    $student["workshops"] = $workshops;
                }
            }
                


            }
        }

        public static function getworkshop($id) {
            if ($id == 0) return utils::getworkshopseparator();
            $workshop = mysql_query("SELECT * FROM Workshop WHERE ID =" . $id);
            if (mysql_num_rows($workshop) > 0) {
                $w = array();
                $w["id"] = mysql_result($workshop,0,"ID");
                $w["grade"] = mysql_result($workshop,0,"Grade");
                $w["title"] = mysql_result($workshop,0,"Title");
                $w["description"] = mysql_result($workshop,0,"Description");
                $w["css"] = "panel-primary";
                return $w;
            }
        }
        
 
        public static function getworkshopseparator() {
            $w = array();
            $w["id"] = 0;
            $w["grade"] = 0;
            $w["title"] = "No more workshops ### (workshops separator)";
            $w["description"] = "Drag all workshops you want to attend above this separator. This element should be after the last workshop you would like to attend. All workshops below this elements will be discarded from your choice.";
            $w["css"] = "panel-default";
            return $w;
        }       
        

        public static function savestudent(&$student, $con) {
           $insert = "INSERT INTO `Students`(`Grade`, `StudentLast`, `StudentFirst`, `Teacher`, `S1`, `S2`, `S3`, `S4`, `S5`, `S6`, `Regdate`, `RegIP`, `ParentVolunteer`, `childworkshop`, `Allergy`, `parentName`, `ParentFirst`, `ParentLast`, `Email`) 
                                   VALUES ('{$student['name_first']}', '{$student['name_last']}', '{$student['name_first']}','{$student['teacher']}','{$student['workshops'][1]['id']}','{$student['workshops'][2]['id']}','{$student['workshops'][3]['id']}','{$student['workshops'][4]['id']}','{$student['workshops'][5]['id']}','{$student['workshops'][6]['id']}',{},[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18],[value-19],[value-20],[value-21],[value-22],[value-23],[value-24],[value-25])"; 
        }

    }


 ?>