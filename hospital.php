<?php require_once('config.php'); ?>
<!--
Project Phase III
Group name: Husky Data Inc.
Group members: Elijah Freeman Roy (Dongyeon) Joo
This is the infection script for the "Find Hospitals Near You".

Functionality: It allows users to find hospitals
near them.
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hospitals</title>
        <!-- add a reference to the external stylesheet -->
        <!-- Uses the solar stylesheet from bootswatch -->
        <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
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

                    <li class="nav-item">
                        <a class="nav-link" href="infection.php">Infection</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="covid_test_center.php">Covid Test Centers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="high_risk.php">High Risk Areas</a>
                    </li>
                    <li class="nav-item active">
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

                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <!-- END Add HTML code for the top menu section (navigation bar) -->

        <div class="jumbotron">
            <p style="font-size: 50px" class="lead">Find Hospitals Near You</p>
            <hr class="my-4">
            <form  class ="second_form" id='hospital_near_you' style='visibility: visible' method="GET" action="hospital.php">

                <!-- div container for the drop down form select bar -->
                <div class="form-group">
                    <div class="small-container">
                        <label style="font-size: 17px" for="county_control_form">If you are exhibiting symptoms or your condition
                            worsens please visit your local hospital to get tested.
                        </label>
                        <select class = "custom-select" name="hospital_county" onchange='this.form.submit()'id='county_control_form'>
                            <option selected>Your Location</option>

                            <?php
                            $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                            if ( mysqli_connect_errno() )
                            {
                                die( mysqli_connect_error() );
                            }
                            // Query that retrieves the first and last name and SSN from
                            // our EMPLOYEE table in our database.
                            $sql = "SELECT DISTINCT county FROM HOSPITAL";
                            if ($result = mysqli_query($connection, $sql))
                            {
                                // loop through the data
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo '<option value="' . $row['county'] . '">';
                                    echo $row['county'];
                                    echo "</option>";

                                } // release the memory used by the result set
                                mysqli_free_result($result);
                            }
                            ?>
                        </select>
                    </div>

                </div>


                <?php

                if ($_SERVER["REQUEST_METHOD"] == "GET")
                {
                if (isset($_GET['hospital_county']) )
                {
                ?>

                <p>&nbsp;</p>
                <div class="second-container">
                    <table class="table table-hover">






                        <div class="card mb-3">
                            <h3 class="card-header"><?php echo $row['patient_id'] ?></h3>
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <h6 class="card-subtitle text-muted">Support card subtitle</h6>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
                                <rect width="100%" height="100%" fill="#868e96" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #1d2428;"></rect>
                                <text x="50%" y="50%" fill="#dee2e6" dy=".3em" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #a19d97;">Image cap</text>
                            </svg>
                            <div class="card-body">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Cras justo odio</li>
                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                <li class="list-group-item">Vestibulum at eros</li>
                            </ul>
                            <div class="card-body">
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div>
                            <div class="card-footer text-muted">
                                2 days ago
                            </div>
                        </div>

                        <div class="card text-white bg-info mb-3" style="max-width: 20rem;">
                            <div class="card-header">Patient ID: <?php echo $row['patient_id'] ?></div>
                            <div class="card-body">
                                <h4 class="card-title">Patient Information</h4>
                                <p class="card-text">Sickness Type: <?php echo $row['patient_id'] ?></p>
                                <p class="card-text">Severity of Infection: <?php echo $row['severity'] ?></p>
                                <p class="card-text">Duration: <?php echo $row['patient_id'] ?></p>
                                <p class="card-text">Age: <?php echo $row['patient_id'] ?></p>
                                <p class="card-text">Severity: <?php echo $row['patient_id'] ?></p>
                                <p class="card-text">Severity: <?php echo $row['patient_id'] ?></p>
                                <p class="card-text">Severity: <?php echo $row['patient_id'] ?></p>

                            </div>
                        </div>





                        <thead>
                        <tr class="table-success">
                            <th scope="col">Hospital Near You</th>
                            <th scope="col">Location</th>
                            <th scope="col">Number of Available Bed</th>
                            <th scope="col">Available Tests</th>
                        </tr>
                        </thead>

                        <?php
                        if ( mysqli_connect_errno() )
                        {
                            die(mysqli_connect_error() );
                        }

                        // Selects the infection name, infection rate and the number
                        // of infections of that that type in the county specfied in the
                        // drop down menu by the user.
                        $sql = "SELECT hospital_name, county, availability_bed, covid_test
                        FROM HOSPITAL
                      WHERE county = '{$_GET['hospital_county']}'";

                        if ($result = mysqli_query($connection, $sql))
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                ?>
                                <tr>
                                    <td><?php echo $row['hospital_name'] ?></td>
                                    <td><?php echo $row['county'] ?></td>
                                    <td><?php echo $row['availability_bed'] ?></td>
                                    <td><?php echo $row['covid_test'] ?></td>
                                </tr>

                                <?php
                            } // release the memory used by the result set
                            mysqli_free_result($result);
                        }

                        } // end if (isset)
                        } // end if ($_SERVER)
                        ?>


                    </table>

                </div>

            </form>
        </div>
    </body>
</html>
