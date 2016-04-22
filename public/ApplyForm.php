<html>
    <head>
        
    </head>
    <body>
        <form name = "SurveyForm" action="ApplyBackend.php" method="post" enctype="multipart/form-data">
        Vakances Id:     
        <INPUT TYPE = "Text" Name = "VacancyId" Value = <?php echo "{$_POST['apply']}"?> Readonly><br>
        
        <br>
        Vārds: <INPUT TYPE = "Text" Name = "SeekerName" ><br>
        Uzvārds: <INPUT TYPE = "Text" Name = "SeekerLastName" ><br>
        Epasts: <INPUT TYPE = "Email" Name = "SeekerEmail" ><br>
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
        Pievienot CV:<input name="userfile" type="file" id="userfile"><br><br>
        Iesniegt: <INPUT TYPE = "Submit" Name = "Submit1" VALUE = "Iesniegt">
        
        
        <table class="striped">
            <tr class="header">
                <td>QId</td>
                <td>QGroup</td>
                <td>Question</td>
            </tr>
        <?php
        $user = 'root';
        $pass = '';
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=talenthire_dbw', $user, $pass);
            foreach($dbh->query('select * from question') as $row) {
                $tmp=$row['Id'];
                
                echo "<tr class='body'>";
                echo "<td>".$row["Id"]."</td>";
                echo "<td>".$row["QuestionGroup"]."</td>";
                echo "<td>".$row["Question"]."</td>";
                echo "<td>"
                ?>
            
                <td><input type="checkbox" name="<?php echo "box"+$tmp;?>" />&nbsp;</td>
                <?php
                echo "</tr>";
            }
            //print "Error!: " . $e->getMessage() . "<br/>";
            die();
            $dbh = null;
        } catch (PDOException $e) {
        }
        ?>
        </table>
        <!--<INPUT TYPE = "Submit" Name = "Submit2" VALUE = "Iesniegt">-->
        </form>
    </body>
</html>

