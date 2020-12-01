<?php require_once('config.php'); ?>
<!--
Project Phase III
Group name: Husky Data Inc.
Group members: Elijah Freeman Roy (Dongyeon) Joo
This is the infection script for the "New Symptoms".

Functionality: It allows users to upload new symptoms.
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New Symptom</title>
        <!-- add a reference to the external stylesheet -->
        <!-- Uses the solar stylesheet from bootswatch -->
        <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="styleguide_general.css">
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
                    <li class="nav-item">
                        <a class="nav-link" href="hospital.php">Find a Hospital</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="patient.php">Patients</a>
                    </li>
                    <li class="nav-item active">
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
            <p style="font-size: 50px" class="lead">Describe your Symptoms</p>
            <hr class="my-4">

            <form id="form-one" method="POST" action="new_symptoms.php">
                
                <div class = "float-container">
                <!-- div container for the drop down form select bar -->
                <div class="float-child">
                    <div class="form-group">
                        <label style="font-size: 17px" for="symptom_select">Symptom Name:
                        </label>
                        <select class = "custom-select" name="symptom_desc"  id='symptom_select' onchange='changeVisibilityHide(); hideAlert()'>
                            <option selected>Choose a symptom that best describes how you're feeling.</option>

                            <?php
                            $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                            if ( mysqli_connect_errno() )
                            {
                                die( mysqli_connect_error() );
                            }

                            $sql = "SELECT DISTINCT description 
                                    FROM SYMPTOM";

                            if ($result = mysqli_query($connection, $sql))
                            {
                                // loop through the data
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo '<option value="' . $row['description'] . '">';
                                    echo $row['description'];
                                    echo "</option>";

                                } // release the memory used by the result set

                                mysqli_free_result($result);
                            }
                            ?>
                            <option>Other</option>

                        </select>
                    </div>
                </div>

                    <!-- TODO this seems like it should go in the database and not tied to the view-->

                    <div class="float-child">
                        <div id="new-symptom" class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="new-symptom-checkbox" onchange="addNewSymptom()">
                                <label style="font-size: 17px" id='new-symptom-label' class="custom-control-label" for="new-symptom-checkbox">Do you have a symptom that is not listed?</label>
                            </div>
                            <input name="new_symptom" style="visibility: hidden" type="text" class="form-control" id="symptomInput" aria-describedby="symptom_help" placeholder="Name your symptom">
                            <small style="visibility: hidden"  id="symptom_help" class="form-text text-muted">Please use a single word to name your symptom (e.g. fever, headache, chills, etc).</small>
                        </div>
                    </div>


                </div>

                <div class="float-child2">
                    <div class="form-group" id="severity_dropdown" >
                        <label style="font-size: 17px" for="severity-select" id="severity_selector_label">How severe is your symptom?</label>
                        <select class="custom-select" name="severity" id="severity-select" onchange='changeVisibility(); hospitalNearYouVisible()'>
                            <option selected>Choose a value: Minor to Severe </option>
                            <option value="1">1 Mild</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5 Moderate</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10 Severe</option>
                        </select>

                    </div>

                </div>

                <div class="container">
                    <div class="btn-holder">
                        <button  style="visibility: hidden" id="submit_button"  class="btn btn-primary" onclick='this.form.submit()'>Submit</button>
                    </div>
                </div>




                <?php
                // HERE IS WHERE WE SEND INFORMATION TO OUR DATABASE
                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    if (isset($_POST['symptom_desc'], $_POST['severity']) )
                    {
                ?>
                    <?php
                        if ( mysqli_connect_errno() )
                        {
                            die(mysqli_connect_error() );
                        }

                        if (($_POST['new_symptom'] != '')) {
                            $sql = "INSERT INTO SYMPTOM(description, severity, infection_name, user_id) 
                                VALUES ('{$_POST['new_symptom']}',{$_POST['severity']}, 'THROW UP', 3)";
                        } else {
                            $sql = "INSERT INTO SYMPTOM(description, severity, infection_name, user_id) 
                                VALUES ('{$_POST['symptom_desc']}',{$_POST['severity']}, 'THROW UP', 3)";
                        }

                        if (!mysqli_query($connection, $sql)) {
                            echo "Error: Could not execute $sql";
                        } else {
                            ?>

                            <div  id='symptom_alert'>
                                <div class="alert alert-dismissible alert-info">
                                    <h4 class="alert-heading">Symptom Recorded</h4>
                                    <p class="mb-0">We have recorded your <?php echo $_POST['symptom_desc']; ?> symptom.
                                        If you feel unwell or your symptom worsen please find
                                        your nearest hospital below. If you would like to record another
                                        symptom re-enter the above information. <a href="covid_test_center.php" class="alert-link">Find a Test Center</a>.</p>
                                </div>
                            </div>

                            <?php
                        }

                    } // end if (isset)
                } // end if ($_SERVER)
                    ?>

            </form>



        <form  class ="second_form" id='hospital_near_you' style='visibility: visible' method="GET" action="new_symptoms.php">

            <!-- div container for the drop down form select bar -->
            <div class="form-group">
                <div class="small-container">
                <label style="font-size: 17px" for="county_control_form">If your symptoms get worse please go to your local hospital
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

    <!-- Some javascript to provide some functionality -->

    <script>
        function changeVisibility() {
            document.getElementById('submit_button').style.visibility = 'visible';
        }
        function changeVisibilityHide() {
            document.getElementById('submit_button').style.visibility = 'hidden';
        }


        function addNewSymptom() {

            if (document.getElementById("new-symptom-checkbox").checked === true) {
                document.getElementById('symptomInput').style.visibility = 'visible';
                document.getElementById('symptom_help').style.visibility = 'visible';
            } else {
                document.getElementById('symptomInput').style.visibility = 'hidden';
                document.getElementById('symptom_help').style.visibility = 'hidden';
            }
        }
        function hospitalNearYouVisible() {
            document.getElementById('hospital_near_you').style.visibility = 'visible'
        }

        function hideAlert() {
            document.getElementById('symptom_alert').style.visibility = 'hidden'
        }
    </script>
    </body>
</html>
