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
        <title>Patient Information</title>
        <!-- add a reference to the external stylesheet -->
        <!-- Uses the solar stylesheet from bootswatch -->
        <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="patient_stylesheet.css">
    </head>
    <body>
        <!-- START Add HTML code for the top menu section (navigation bar) -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Husky Data Health</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
                    aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
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
                    <li class="nav-item">
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
                    <li class="nav-item active">
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
            <p style="font-size: 50px" class="lead">Patient Dashboard</p>
            <hr class="my-4">
            <form method="GET" action="patient.php">
                <div class="grid-container">
                    <div class="grid-child1">
                     <!-- div container for the drop down form select bar -->
                        <div class="form-group">
                            <h2 id="select-patient-label">Find Patient Information</h2>
                            <p>Find a patient by their patient ID</p>
                            <select class = "form-control" name="patient" onchange='this.form.submit()'
                                    id='county_control_form'>
                                <option selected>Locate a Patient</option>
                                <?php
                                $connection = mysqli_connect(DBHOST, DBUSER,
                                                    DBPASS, DBNAME);
                                if ( mysqli_connect_errno() ) {
                                    die( mysqli_connect_error() );
                                }
                                // Query that retrieves the first and last name and user_id from
                                // our USER_INFO table in our database.
                                $sql = "select patient_id from PATIENT ORDER BY patient_id ASC";
                                if ($result = mysqli_query($connection, $sql)) {
                                    // loop through the data
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['patient_id'] . '">';
                                        echo $row['patient_id'];
                                        echo "</option>";
                                    } // release the memory used by the result set
                                    mysqli_free_result($result);
                                }
                                ?>
                            </select>
                        </div>
                        <div class="container">
                            <div class="item-a">
                                <?php if ($_SERVER["REQUEST_METHOD"] == "GET") {
                                    if (isset($_GET['patient'])) {
                                        ?>
                                        <?php
                                        if ( mysqli_connect_errno() ) {
                                            die(mysqli_connect_error() );
                                        }
                                        // Selects patient information from database using
                                        // their user_id.
                                        $sql = " SELECT * FROM PATIENT
                                                WHERE patient_id = '{$_GET['patient']}' ";
                                        if ($result = mysqli_query($connection, $sql)) {
                                            while($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <div class="card text-white bg-info mb-3" style="max-width: 20rem;">
                                                    <div class="card-header">Patient ID:
                                                        <?php echo $row['patient_id']?></div>
                                                    <div class="card-body">
                                                        <h4 class="card-title"><strong>Patient Information</strong></h4>
                                                        <p class="card-text"><span style="text-decoration: underline;">Sickness Type:</span>
                                                            <em><?php echo $row['sickness_type'] ?></em></p>
                                                        <p class="card-text"><span style="text-decoration: underline;">Severity of Infection:</span>
                                                            <em><?php echo $row['severity'] ?></em></p>
                                                        <p class="card-text"><span style="text-decoration: underline;">Age:</span><em><?php echo $row['age_range'] ?></em></p>
                                                        <p class="card-text"><span style="text-decoration: underline;">Hospital Name:<br></span>
                                                            <em><?php echo $row['hosp_name']?></em></p>
                                                        <p class="card-text"><span style="text-decoration: underline;">Days in Hospital:</span>
                                                            <em><?php echo $row['duration'] ?></em></p>
                                                        <p class="card-text"><span style="text-decoration: underline;">Contact:<br></span>
                                                            <em><?php echo $row['patient_email'] ?></em></p>
                                                    </div>
                                                </div>
                                                <?php
                                            } // release the memory used by the result set
                                            mysqli_free_result($result);
                                        }
                                    } // end if (isset)
                                } // end if ($_SERVER)
                                ?>
                            </div>
                            <div class="item-b">
                                <?php
                                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                                    if (isset($_GET['patient']) ) {
                                        ?>
                                        <?php
                                        if ( mysqli_connect_errno() ) {
                                            die(mysqli_connect_error() );
                                        }
                                        $sql = " select infection_name, infection_rate 
                                                from INFECTION 
                                                where infection_name IN (
                                                    select sickness_type 
                                                    from PATIENT 
                                                    where patient_id = '{$_GET['patient']}') ";
                                        if ($result = mysqli_query($connection, $sql)) {
                                            while($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <div class="alert alert-dismissible alert-primary">
                                                    <strong>Diagnosis</strong>
                                                    <p>This patient has been diagnosed with <em>
                                                            <?php echo $row['infection_name'] ?></em>. This infection
                                                        has an infection rate of
                                                        <strong><?php echo $row['infection_rate'] ?></strong></p>
                                                </div>
                                                <?php
                                            } // release the memory used by the result set
                                            mysqli_free_result($result);
                                        }
                                    }
                                }?>
                            </div>
                            <div class="item-c">
                                <?php
                                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                                    if (isset($_GET['patient'])) {
                                        ?>
                                        <?php
                                        if ( mysqli_connect_errno() ) {
                                            die(mysqli_connect_error() );
                                        }
                                        $sql = " select  infection_name, medication 
                                                from INFECTION 
                                                where infection_name IN (
                                                    select sickness_type 
                                                    from PATIENT 
                                                    where patient_id = '{$_GET['patient']}') ";
                                        if ($result = mysqli_query($connection, $sql)) {
                                            while($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <div class="alert alert-dismissible alert-success">
                                                    <strong>Medication</strong><p>This patient has been diagnosed
                                                        with <em><?php echo $row['infection_name']?></em>.
                                                        Please use <strong><?php echo $row['medication'] ?></strong></p>
                                                </div>
                                                <?php
                                            } // release the memory used by the result set
                                            mysqli_free_result($result);
                                        }
                                    }
                                }?>
                            </div>
                            <div class="item-d">
                                    <?php
                                    if ($_SERVER["REQUEST_METHOD"] == "GET") {
                                        if (isset($_GET['patient']) ) {
                                            ?>
                                        <h3>Patients Symptoms</h3>
                                        <table class="table table-hover">
                                            <thead>
                                            <tr class="table-info">
                                            <th scope="col">Symptom</th>
                                            <th scope="col">Severity</th>
                                            </tr>
                                            </thead>
                                            <?php
                                            if ( mysqli_connect_errno() ) {
                                                die(mysqli_connect_error() );
                                            }
                                            // Selects patient information from database using
                                            // their user_id.
                                            $sql = "SELECT description, severity 
                                                    FROM SYMPTOM 
                                                    where patient_id = '{$_GET['patient']}'; ";
                                            if ($result = mysqli_query($connection, $sql)) {
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <tr>
                                                    <td><?php echo $row['description'] ?></td>
                                                    <td><?php echo $row['severity'] ?></td>
                                                    </tr>
                                                    <?php
                                                } // release the memory used by the result set
                                                mysqli_free_result($result);
                                            }
                                        }
                                    } // end if ($_SERVER)
                                            ?>
                                        </table>
                            </div>
                        </div>
                    </div>
                    <div class="grid-child2">
                        <h2>Patients with the most severe symptoms</h2>
                        <p>The following patients below exhibit symptom severity that is higher
                            than the average severity for all patients register with the Husky Data
                            Health portal.</p>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "GET") {
                            ?>
                        <table class="table table-hover">
                            <thead>
                            <tr class="table-warning">
                                <th scope="col">Patient ID</th>
                                <th scope="col">Infection</th>
                                <th scope="col">Severity</th>
                                <th scope="col">Days Sick</th>
                                <th scope="col">Age</th>
                                <th scope="col">Hospital</th>
                                <th scope="col">Patient Contact</th>
                            </tr>
                            </thead>
                            <?php
                            if ( mysqli_connect_errno() ) {
                                die(mysqli_connect_error() );
                            }
                            // Selects patient information from database using
                            // their user_id.
                            $sql = "SELECT *
                                    FROM PATIENT P1
                                    WHERE SEVERITY >(SELECT AVG(SEVERITY)
                                    FROM PATIENT P2
                                    WHERE P1.HOSP_NAME = P2.HOSP_NAME); ";
                            if ($result = mysqli_query($connection, $sql)) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['patient_id'] ?></td>
                                        <td><?php echo $row['sickness_type'] ?></td>
                                        <td><?php echo $row['severity'] ?></td>
                                        <td><?php echo $row['duration'] ?></td>
                                        <td><?php echo $row['age_range'] ?></td>
                                        <td><?php echo $row['hosp_name'] ?></td>
                                        <td><?php echo $row['patient_email'] ?></td>
                                    </tr>
                                    <?php
                                } // release the memory used by the result set
                                mysqli_free_result($result);
                            }
                        } // end if ($_SERVER)
                            ?>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>


