 <?php 
        // including utils
        require_once("utils.php");

        $username="phpreader";
        $password="ReadOnly1";
        $database="Laurel";
        
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
            // saving $student
            utils::savestudent($student, $con);
        }
        


 ?>        