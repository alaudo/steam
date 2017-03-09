<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laurel School STEAM Fair</title>
    <?php
        include 'shared\head.php';
    ?>

</head>

<body id="page-top" class="index">

    <?php
        include 'shared\nav.php';
        include 'logic\connect.php';
        if (isset($student["save"])) {
            include 'logic\confirmation.php';
        } else {
            include 'logic\reg_students.php';
        }
        
        include 'shared\footer.php';
        include 'shared\scripts.php';
    ?>


</body>

</html>
