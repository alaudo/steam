 <?php 
        // timezone 
        date_default_timezone_set('America/Los_Angeles');
        // including utils
        require_once("utils.php");

        $connectstr_dbhost = '';
        $connectstr_dbname = '';
        $connectstr_dbusername = '';
        $connectstr_dbpassword = '';

        foreach ($_SERVER as $key => $value) {
            if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
                continue;
            }
            
            $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
            $connectstr_dbname = "laurel"; // preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
            $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
            $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
        }

        $con = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname);

        
        // $con = mysql_connect("MYSQLCONNSTR_localdb",$username,$password);
        // @mysql_select_db($database) or die( "Unable to select database");
        mysql_query("set names 'utf8'");

        // trying to get data from post
        $student_rules = array(
            "student_first" => "name_first", 
            "student_last" => "name_last", 
            "parent_first" => "parent_first", 
            "parent_last" => "parent_last", 
            "class" => "class", 
            "email" => "email",
            "workshopsorder" => "workshopsorder",
            "allergy" => "allergy",
            "withmychild" => "withmychild",
            "save" => "save",
            "load" => "load");

        $student = utils::map($_POST,$student_rules,$con);

        utils::enrich($student); 

        if (isset($student["save"])) {
            // parsing workshops         
            if (isset($student["workshopsorder"]) && $student["workshopsorder"] != '') {
                $i = 1;
                $workshops = array();
                foreach (explode('&',$student["workshopsorder"]) as $foo) {
                    $id = intval(explode('=',$foo)[1]);
                    $workshops[$i] = utils::getworkshop($id);
                    $i++;
                }
                $student["workshops"] = $workshops;
            }
            $retval = utils::savestudent($student,$con);

            if(! $retval ) {
               $error = var_dump(mysql_error());
            } else {
               $student["saved"] = true;
            }

        }

        if (isset($student["showstep2"])) {
            utils::enrich2($student); 
        } 
        


 ?>        