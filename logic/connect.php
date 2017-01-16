 <?php 
        // including utils
        require_once("utils.php");

        $username="phpreader";
        $password="ReadOnly1";
        $database="Laurel";
        
        mysql_connect(localhost,$username,$password);
        @mysql_select_db($database) or die( "Unable to select database");

        // trying to get data from post
        $student_rules = array(
            "student_first" => "name_first", 
            "student_last" => "name_last", 
            "parent_first" => "parent_first", 
            "parent_last" => "parent_last", 
            "class" => "class", 
            "email" => "email");
        $student = utils::map($_POST,$student_rules);
        utils::enrich($student);

 ?>        