<html>
<body>


<?php 
//echo $_POST["name"];
//echo $_POST["email"];
$user = 'root';
$pass = '';
try {
    $dbh = new PDO('mysql:host=localhost;dbname=talenthire_dbw', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //doWork
    $dbh->errorInfo();
    $sql = "INSERT INTO vacancytable(
            
            vacancyTypeId,
            vacancyExpDate,
            companyName,
            companyEmail,
            positionName,
            positionDescription,
            positionReq,
            positionOff) VALUES (
            
            :vacancyTypeId, 
            :vacancyExpDate, 
            :companyName, 
            :companyEmail, 
            :positionName,
            :positionDescription,
            :positionReq,
            :positionOff)";
                                          
    $stmt = $dbh->prepare($sql);
    if (!$stmt) {
        echo "\nPDO::errorInfo():\n";
        print_r($pdo->errorInfo());
        
    }
    
    $stmt->bindParam(':vacancyTypeId', $_POST['type'], PDO::PARAM_STR);       
    $stmt->bindParam(':vacancyExpDate', $_POST['expDate'], PDO::PARAM_STR); 
    $stmt->bindParam(':companyName', $_POST['name'], PDO::PARAM_STR);
    // use PARAM_STR although a number  
    $stmt->bindParam(':companyEmail', $_POST['email'], PDO::PARAM_STR); 
    $stmt->bindParam(':positionName', $_POST['positionName'], PDO::PARAM_STR);   
    $stmt->bindParam(':positionDescription', $_POST['positionDescription'], PDO::PARAM_STR);
    $stmt->bindParam(':positionReq', $_POST['positionReq'], PDO::PARAM_STR);
    $stmt->bindParam(':positionOff', $_POST['positionOff'], PDO::PARAM_STR); 
    
    $stmt->execute(); 
    $dbh = null;
    echo("<h2>Vakance pievienota!, Paldies!</h2>");
}
catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>            

    <a href="index.php">Iet uz sakumu</a>
    
    </body>
</html>
