<html>
    <head>
        
    </head>
    <body>
        <form action="ApplyBackend.php" method="post">
        Vakances tips: <select name='type'>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'talenthire_dbw') 
        or die ('Cannot connect to db');

        $result = $conn->query("select VacancyTypeId, VacancyTypeName from vacancyType");
        while ($row = $result->fetch_assoc()) 
        {
            unset($id, $name);
            $id = $row['VacancyTypeId'];
            $name = $row['VacancyTypeName']; 
            echo '<option value="'.$id.'">'.$name.'</option>';    
        }
        ?>
        </select>
        Konkursa beigu datums: <input type="date" name="expDate"><br>
        Kompānijas nosaukums: <input type="text" name="name"><br>
        Kompānijas e-pasts: <input type="email" name="email"><br>
        Amats: <input type="text" name="positionName"><br>
        Amata apraksts: <textarea name="positionDescription" rows="10" cols="30"></textarea><br>
        Prasības: <textarea name="positionReq" rows="10" cols="30"></textarea><br>
        Piedāvājam: <textarea name="positionOff" rows="10" cols="30"></textarea><br>
        Iesniegt: <input type="submit">
        </form>
    </body>
</html>

