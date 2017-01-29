 <?php 
        // timezone 
        date_default_timezone_set('America/Los_Angeles');
        // including utils
        require_once("utils.php");

        $username="phpreader";
        $password="ReadOnly1";
        $database="Laurel";
        $error = "";
        
        $con = mysql_connect(localhost,$username,$password);
        @mysql_select_db($database) or die( "Unable to select database");

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
            $retval = utils::savestudent($student,$con);

            if(! $retval ) {
               $error = var_dump(mysql_error());
            } else {
               $student["updated"] = "Saved your data at " . date("Y-m-d h:i:sa"); 
            }

        } 
        


 ?>        