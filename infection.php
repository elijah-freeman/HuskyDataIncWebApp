<?php require_once('config.php'); ?>
<!--
Project Phase III
Group name: Husky Data Inc.
Group members: Elijah Freeman, Roy (Dongyeon) Joo, Xiuxiang Wu
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infection</title>
    <!-- add a reference to the external stylesheet -->
    <!-- Uses the solar stylesheet from bootswatch -->
    <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
    <link rel="stylesheet" href="infection_stylesheet.css">
</head>
<body>
<!-- START Add HTML code for the top menu section (navigation bar) -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Husky Data Health</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <!-- May need to modify the following line -->
                <a class="nav-link" href="index.php">Home
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="infection.php">Infection</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="covid_test_center.php">Covid Test Centers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="high_risk.php">High Risk Areas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="hospital.php">Find a Hospital</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="patient.php">Patients</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="new_symptoms.php">New Symptom</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user_info.php">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="sick_patients.php">Sick Patients</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<!-- END Add HTML code for the top menu section (navigation bar) -->
<div class="jumbotron">
    <p style="font-size: 50px" class="lead">Infection Dashboard</p>
    <hr class="my-4">
    <form method="GET" action="infection.php">
        <!-- div container for the drop down form select bar -->

        <div class="item-1">
            <div class="form-group">
                <select id="infection_select" class="custom-select" name="infection" onchange='this.form.submit()'>
                    <option selected>Select an Infection</option>
                    <?php
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    if (mysqli_connect_errno()) {
                        die(mysqli_connect_error());
                    }
                    $sql = "SELECT DISTINCT infection_name FROM SYMPTOM";
                    if ($result = mysqli_query($connection, $sql)) {
                        // loop through the data
                        while($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['infection_name'] . '">';
                            echo $row['infection_name'];
                            echo "</option>";
                        } // release the memory used by the result set
                        mysqli_free_result($result);
                    }
                    ?>
                </select>
            </div>




            <div>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    if (isset($_GET['infection']) ) {
                        if (mysqli_connect_errno()) {
                            die(mysqli_connect_error() );
                        }
                        $sql = "SELECT DISTINCT description, infection_name
                            FROM SYMPTOM 
                            WHERE infection_name = '{$_GET['infection']}';";
                        if ($result = mysqli_query($connection, $sql)) {
                            $array = array();
                            while($row = mysqli_fetch_assoc($result)) {
                                array_push($array, $row['description']);
                            }
                            ?>
                            <div class="card bg-light mb-3" style="max-width: 20rem;">
                                <div class="card-header"><?php  echo $_GET['infection'] ?> </div>
                                <div class="card-body">
                                    <h4 id="result" class="card-title">Symptoms:</h4>
                                    <?php
                                    sort($array);
                                    foreach ($array as &$value) {
                                        ?>
                                        <p style="margin-bottom: 0; margin-top: 0; line-height:1;" ><?php echo $value ?></p>
                                    <?php } ?>
                                    <p class="card-text"></p>
                                </div>
                            </div>
                            <?php
                        } // release the memory used by the result set
                        mysqli_free_result($result);
                    }
                } // end if (isset)
                // end if ($_SERVER)
                ?>
            </div>





        </div>
    </form>

</div>



</body>
</html>