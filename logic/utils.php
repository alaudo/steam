 <?php 
    //require_once("underscore.php");

   
    class utils {
        // mapping from one array to another using rules
        public static function map($from, $rules, $con) {
            $ret = array();
            foreach($rules as $key => $value) {
                if (isset($from[$key])) $ret[$value] = $from[$key];
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

            $student["ip"] = $_SERVER['REMOTE_ADDR'];

            if (isset($student["email"]) && isset($student["name_first"]) && isset($student["name_last"])) {
                $student["showstep2"] = true;
            }

            if (isset($student["class"])) {
                $query = mysql_query("SELECT * FROM Classroom WHERE ID =" . $student["class"] );
                $student["grade"] = mysql_result($query,0,"Grade");
                $student["room"] = mysql_result($query,0,"Room");
                $student["teacher"] = mysql_result($query,0,"Teacher");
                $student["teacherid"] = mysql_result($query,0,"ID");
            }

            if (isset($student["email"])) {
                // -------  loading parent data ------ 
                $query = mysql_query("SELECT * FROM Volunteers WHERE Email ='{$student['email']}'" );
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

                if (isset($student["load"])) {
                    // loading from db
                    $query = mysql_query("SELECT * FROM `Students` WHERE Email = '{$student['email']}' ORDER BY ID DESC LIMIT 1");
                    // if email is not valid, trying to match names
                    if (mysql_numrows($query) < 1) $query = mysql_query("SELECT * FROM Students WHERE Grade ='{$student['grade']}' AND ParentFirst='{$student['parent_first']}' AND ParentFirst='{$student['parent_first']}'" );

                    if (mysql_numrows($query) > 0) {
                    // there is an entry in the db
                        var $ws =  utils::getworkshops($student["grade"]);
                        foreach(range(1,6) as $num) {
                            utils::swapworkshop($ws,$num,mysql_result($query,0,"S" . $num))
                        }

                    } else {
                    // creating new student

                    }

                    


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
                        $student["workshops"] = utils::getworkshops($student["grade"]);
                    }
                }

            }
        }

        public static function swapworkshop(&$workshops,$pos, $id) {

        }


        public static function getworkshops($grade) {
            $query = mysql_query("SELECT ID FROM Workshop WHERE Grade =" . $student["grade"] );
            $workshops = array();
            $workshops[1] = utils::getworkshopseparator();
            $i = 2;
            while ($row = mysql_fetch_array($query)) {
                $workshops[$i] = utils::getworkshop($row["ID"]);
                $i++;
            }
            return $workshops;
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
           $parent = $student['parent_first'] . " " . $student['parent_last'];
           $pworkshop = $student["is_parent_workshop"] ? $student["parent_workshop"]["workshop"]["id"]: '0';
           $pvolonteer = $student['is_parent_workshop'] ? "1" : "0";

           $insert = "INSERT INTO `Students`(`Grade`, `StudentLast`, `StudentFirst`, `Teacher`, `S1`, `S2`, `S3`, `S4`, `S5`, `S6`, `Regdate`, `RegIP`, `ParentVolunteer`, `parentwork`, `Allergy`, `parentName`, `ParentFirst`, `ParentLast`, `Email`) " .
                                "VALUES ('{$student['grade']}', '{$student['name_last']}', '{$student['name_first']}','{$student['teacherid']}','{$student['workshops'][1]['id']}','{$student['workshops'][2]['id']}','{$student['workshops'][3]['id']}','{$student['workshops'][4]['id']}'," . 
                                "'{$student['workshops'][5]['id']}','{$student['workshops'][6]['id']}',now(),'{$student['ip']}','{$pvolonteer}'," . 
                                "{$pworkshop},'{$student['allergy']}','{$parent}','{$student['parent_first']}','{$student['parent_last']}','{$student['email']}')"; 

           return mysql_query( $insert, $con );;                    
        }

    }


 ?>