<html>
<body>
    
<?php
require 'mailer.php';
//echo $_POST["name"];
//echo $_POST["email"];
$user = 'root';
$pass = '';
try {
    if (isset($_POST["VacancyId"]))
    {
        $vacId = $_POST["VacancyId"];
    }
    $dbh = new PDO('mysql:host=localhost;dbname=talenthire_dbw', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //doWork
    $dbh->errorInfo();
    //
    //Insert new job seeker
    //
    $seekerInsSql = "INSERT INTO seeker(
            Name,
            LastName,
            Email) VALUES (
            :seekerName,
            :seekerLastName,
            :seekerEmail
            )";
    $seekerstmt = $dbh->prepare($seekerInsSql);    
    if (!$seekerstmt) {
        echo "\nPDO::errorInfo():\n";
        print_r($pdo->errorInfo());
        
    }
    
    $seekerstmt->bindParam(':seekerName', $_POST['SeekerName'], PDO::PARAM_STR);       
    $seekerstmt->bindParam(':seekerLastName', $_POST['SeekerLastName'], PDO::PARAM_STR); 
    $seekerstmt->bindParam(':seekerEmail', $_POST['SeekerEmail'], PDO::PARAM_STR);
    $seekerstmt->execute();
    echo("<h2>Darba mekletajs pievienots! Paldies!</h2>");
    
    $seekerSelectSql = "SELECT * From seeker ORDER BY Id DESC LIMIT 1";
    $seekerSelectStmt = $dbh->query($seekerSelectSql);
    $seekerRow = $seekerSelectStmt->fetchObject();
    //TODO: Check if exists seeker. (Out of scope)
    //
    //Upload CV
    //
    if(isset($_POST['Submit1']) && $_FILES['userfile']['size'] > 0)
    {
        $fileName = $_FILES['userfile']['name'];
        $tmpName  = $_FILES['userfile']['tmp_name'];
        $fileSize = $_FILES['userfile']['size'];
        $fileType = $_FILES['userfile']['type'];

        $fp      = fopen($tmpName, 'r');
        $content = fread($fp, filesize($tmpName));
        $content = addslashes($content);
        fclose($fp);

        if(!get_magic_quotes_gpc())
        {
            $fileName = addslashes($fileName);
        }
        $seekerCVInsertSql = "INSERT INTO upload (name, size, type, content ) ".
        "VALUES ('$fileName', '$fileSize', '$fileType', '$content')";
        $seekerCVInsertStmt = $dbh->prepare($seekerCVInsertSql);
        if (!$seekerCVInsertStmt) {
            echo "\nPDO::errorInfo():\n";
            print_r($pdo->errorInfo());
        }
        $seekerCVInsertStmt->execute();
        echo("<h2>CV pievienots! Paldies!</h2>");
    } 
    //
    //Insert answer
    //
    $answerSql = "INSERT INTO answer(
            
            SeekerId,
            QuestionId,
            Answer) VALUES (
            
            :seekerId, 
            :questionId, 
            :answer)";
    
    $answerstmt = $dbh->prepare($answerSql);
    if (!$answerstmt) {
        echo "\nPDO::errorInfo():\n";
        print_r($pdo->errorInfo());
        
    }
    $answerstmt->bindParam(':seekerId', $seekerRow->Id, PDO::PARAM_INT); 
    //TODO:
    //TODO: Select count questions
    $questionCountSql = "SELECT COUNT(*) FROM question";
    $questionCountStmt = $dbh->prepare($questionCountSql);
    if (!$questionCountStmt) {
        echo "\nPDO::errorInfo():\n";
        print_r($pdo->errorInfo());
    }
    $questionCountStmt->execute();
    $questionCount = $questionCountStmt->fetchColumn();
    //for loop through
    //echo($questionCount);
    $Escore = 0;
    $Iscore = 0;
    $Sscore = 0;
    $Nscore = 0;
    $Fscore = 0;
    $Tscore = 0;
    $Jscore = 0;
    $Pscore = 0;
    for ($k = 1; $k <= $questionCount; $k++)
    {
        $answerstmt->bindParam(':questionId', $k, PDO::PARAM_INT);
        
        if (empty($_POST['box'+$k]))
        {
            $score = -10;
            $fls = 0;
            $answerstmt->bindParam(':answer', $fls, PDO::PARAM_INT);
        }
        else
        {
            $score = +10;
            $tru = 1;
            $answerstmt->bindParam(':answer', $tru, PDO::PARAM_INT);   
        }
        if($answerstmt->execute())
            echo("Anketa saglabata!");
        else 
            echo("Anketu NEIZDEVAS saglabat");   
        
        if ($k <= 11)
            $Escore += $score;
        if ($k >= 12 && $k <= 21)
            $Iscore += $score;
        if ($k >= 22 && $k <= 32)
            $Sscore += $score;
        if ($k >= 33 && $k <= 43)
            $Nscore += $score;
        if ($k >= 44 && $k <= 54)
            $Fscore += $score;
        if ($k >= 55 && $k <= 65)
            $Tscore += $score;
        if ($k >= 66 && $k <= 72)
            $Jscore += $score;
        if ($k >= 73 && $k <= 79)
            $Pscore += $score;
    }
    
    echo("<h2>Anketa aizpildita! Paldies!</h2>");
    
    $scoreSql = "INSERT INTO seekersurveyscore(           
            seekerId,
            vacancyId,   
            Escore,
            Sscore,
            Tscore,
            Jscore,
            Iscore,
            Nscore,
            Fscore,
            Pscore
            ) VALUES (
            :seekerId,
            :vacancyId,
            :Escore,
            :Sscore,
            :Tscore,
            :Jscore,
            :Iscore,
            :Nscore,
            :Fscore,
            :Pscore)";
    $scoreStmt = $dbh->prepare($scoreSql);
    if (!$scoreStmt) {
        echo "\nPDO::errorInfo():\n";
        print_r($pdo->errorInfo());
        
    }
    
    
    $scoreStmt->bindParam(':seekerId', $seekerRow->Id, PDO::PARAM_INT);
    $scoreStmt->bindParam(':vacancyId', $vacId, PDO::PARAM_INT);
    $scoreStmt->bindParam(':Escore', $Escore , PDO::PARAM_INT);
    $scoreStmt->bindParam(':Sscore', $Sscore , PDO::PARAM_INT);
    $scoreStmt->bindParam(':Tscore', $Tscore , PDO::PARAM_INT);
    $scoreStmt->bindParam(':Jscore', $Jscore , PDO::PARAM_INT);
    $scoreStmt->bindParam(':Iscore', $Iscore , PDO::PARAM_INT);
    $scoreStmt->bindParam(':Nscore', $Nscore , PDO::PARAM_INT);
    $scoreStmt->bindParam(':Fscore', $Fscore , PDO::PARAM_INT);
    $scoreStmt->bindParam(':Pscore', $Pscore , PDO::PARAM_INT);
    if($scoreStmt->execute());
        echo("Rezultats saglabats");
    $vacancySelectSql = "SELECT * From vacancytable
           WHERE vacancytable.vacancyId = $vacId";
    $vacancySelectStmt = $dbh->query($vacancySelectSql);
    $vacancyRow = $vacancySelectStmt->fetchObject();
    
    $seekerName = $seekerRow->Name.$seekerRow->LastName;
    echo $seekerName;
    $seekerMail = $seekerRow->Email;
    $companyEmail = $vacancyRow->companyEmail;
    
    $bodyText = "<html><body> Darba mekletajs  $seekerName aizpildija pieteikumu vakancei $vacId.<br>
            Rezultati: E:$Escore S:$Sscore T:$Tscore J:$Jscore <br>
            I:$Iscore N:$Nscore F:$Fscore P:$Pscore <br>
            Darbinieka epasts: $seekerMail </body></html>";
    $dbh = null;
    $mailerClass = new mailSender();
    //echo $bodyText;
    //if($tmpName === UPLOAD_ERR_OK)
        $mailerClass->sendNow($companyEmail, $bodyText, $tmpName, $fileName);
    
    
//
    //TODO: Update score
    //TODO: Send mail
    //TODO: Update seekerStatss
}
catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>            

    <br><a href="index.php">Iet uz sākumu</a>
    
</body>
</html>

