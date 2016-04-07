<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>Vakancu tipi
        <?php
        /*
        // put your code here
        function __autoload($class_name) {
        require_once $class_name . '.php';
        }
        $db = new DBClass();
        $db->connect();
        $db->select("VacancyType", $where)
         * 
         */
        try {
        $user = "root";
        $pass = "";
        $dbh = new PDO('mysql:host=localhost;dbname=talenthire_dbw', $user, $pass);
        foreach($dbh->query('SELECT * from vacancytype') as $row) {
            print_r($row);
        }
        $dbh = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        ?>
    </body>
</html>