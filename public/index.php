<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TalentHire</title>
        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/newcss.css">
    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    </head>
    <body style="background-image: url(pics/background.jpg); background-repeat: repeat;">
        
        
        
        
        
        
        
        <div class="panel panel-default" id="block">
        <div class="container-fluid">
  <div class="row content">
    
      <div class="col-sm-6 sidenav">
      @yield('content')
      </div>
      <div id="login" class="col-sm-2 sidenav">
      <div class="well">
          @if (Auth::guest())
          <a href="{{ href="login.blade.php" }}" role="button" class="btn btn-info">Login</a> <br>
          <a href="{{ href="register.blade.php" }}" role="button" class="btn btn-info">Register</a> <br>
          
        @else
        <a href="{{ url('/addrecipe') }}" role="button" class="btn btn-info">Add new</a>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
      </div>
    </div>
</div>
      </div>
            </div>
        
        
        
        
        
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
