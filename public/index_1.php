<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        </br> </br> </br>
        <!--
        <form name = "vacancyType" action = "vacancyType.php">
            "Show all vacancy types"
            <input type = "submit" value = "Open" />
        </form>
        -->
        <form name = "addNewVacancy" action = "addNewVacancy.php">
            Add new vacancy:
            <input type = "submit" value = "Add new" />
        </form>
        <table class="striped">
            <tr class="header">
                <td>Id</td>
                <td>Type</td>
                <td>Expiry date</td>
                <td>Company name</td>
                <td>Company email</td>
                <td>Position</td>
                <td>Description</td>
                <td>Requirements</td>
                <td>Offer</td>
            </tr>
        <?php
        $user = 'root';
        $pass = '';
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=talenthire_dbw', $user, $pass);
            foreach($dbh->query('select * from vacancytable') as $row) {
                $tmp=$row['vacancyId'];
                $vacTypeId = $row["vacancyTypeId"];
                
                $sql= "select * from vacancyType where VacancyTypeId = :vacTypeId"; 
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(':vacTypeId', $vacTypeId, PDO::PARAM_INT); 
                $stmt->execute();
                $vacTypeTable = $stmt->fetchObject();
                
                echo "<tr>";
                echo "<td>".$row["vacancyId"]."</td>";
                echo "<td>".$vacTypeTable->VacancyTypeName."</td>";
                echo "<td>".$row["vacancyExpDate"]."</td>";
                echo "<td>".$row["companyName"]."</td>";
                echo "<td>".$row["companyEmail"]."</td>";
                echo "<td>".$row["positionName"]."</td>";
                echo "<td>".$row["positionDescription"]."</td>";
                echo "<td>".$row["positionReq"]."</td>";
                echo "<td>".$row["positionOff"]."</td>";
                echo "<td>"
                ?>

                <form name="form" method="POST" action="ApplyForm.php">
                  <input value="<?php echo $tmp;?>" type="hidden" name="apply">
                  <input type="submit"  value="Apply">
                </form>
                    
                <?php
            }
                echo "</td>";
                echo "</tr>";
                
            //print "Error!: " . $e->getMessage() . "<br/>";
            die();
            $dbh = null;
        } catch (PDOException $e) {
        }
        ?>
        </table>
    </body>
</html>
