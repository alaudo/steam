 <?php 
    //require_once("underscore.php");

   
    class utils {
        // mapping from one array to another using rules
        public static function map($from, $rules) {
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
                $query = mysql_query("SELECT ID FROM Workshop WHERE Grade =" . $student["grade"] );
                $workshops = array();
                while ($row = mysql_fetch_array($query)) {
                    $workshops[$row["ID"]] = utils::getworkshop($row["ID"]);

                }
                $student["workshops"] = $workshops;
            }
                


            }
        }

        public static function getworkshop($id) {
            $workshop = mysql_query("SELECT * FROM Workshop WHERE ID =" . $id);
            if (mysql_num_rows($workshop) > 0) {
                $w = array();
                $w["id"] = mysql_result($workshop,0,"ID");
                $w["grade"] = mysql_result($workshop,0,"Grade");
                $w["title"] = mysql_result($workshop,0,"Title");
                $w["description"] = mysql_result($workshop,0,"Description");
                return $w;
            }
        }
        
        
        

    }


 ?>