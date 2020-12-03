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
        <link rel="stylesheet" type="text/css" href="new_symptoms_stylesheet.css">
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
            <p style="font-size: 50px" class="lead">Describe your Symptoms</p>
            <hr class="my-4">
            <form id="form-one" method="POST" action="new_symptoms.php">
                <!-- div container for the drop down form select bar -->
                <div class="item-1">
                    <div class="form-group">
                        <label style="font-size: 17px" for="symptom_select">Symptom Name:</label>
                        <select class = "custom-select" name="symptom_desc"  id='symptom_select' onchange='hideAlert()'>
                            <option selected>Choose a symptom that best describes how you're feeling.</option>
                            <?php
                            $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                            if (mysqli_connect_errno()) {
                                die(mysqli_connect_error());
                            }
                            $sql = "SELECT DISTINCT description 
                                    FROM SYMPTOM ORDER BY description ASC";
                            if ($result = mysqli_query($connection, $sql)) {
                                // loop through the data
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['description'] . '">';
                                    echo $row['description'];
                                    echo "</option>";
                                } // release the memory used by the result set
                                mysqli_free_result($result);
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- TODO this seems like it should go in the database and not tied to the view-->
                <div class="item-2">
                    <div id="new-symptom" class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="new-symptom-checkbox" onchange="addNewSymptom()">
                            <label style="font-size: 17px" id='new-symptom-label' class="custom-control-label" for="new-symptom-checkbox">Do you have a symptom that is not listed?</label>
                        </div>
                        <input name="new_symptom" style="display: none" type="text" class="form-control" id="symptomInput" aria-describedby="symptom_help" placeholder="Name your symptom">
                        <small style="display: none"  id="symptom_help" class="form-text text-muted">Please use a single word to name your symptom (e.g. fever, headache, chills, etc).</small>
                    </div>
                </div>
                <div class="item-3">
                    <div class="form-group" id="severity_dropdown" >
                        <label style="font-size: 17px" for="severity-select" id="severity_selector_label">How severe is your symptom?</label>
                        <select class="custom-select" name="severity" id="severity-select">
                            <option selected>Choose a value: Mild to Severe </option>
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
                <!-- TODO this seems like it should go in the database and not tied to the view-->
                <div class="item-4">
                    <div id="new-diagnosis" class="form-group">
                        <div class="form-group" >
                            <label style="font-size: 17px" for="diagnosis-select" id="diagnosis_selector_label">Have you been diagnosed?</label>
                            <select class="custom-select" id="diagnosis-select" onchange="addNewDiagnosis()">
                                <option selected>Select an option</option>
                                <option value="1">Yes</option>
                                <option value="2">No</option>
                            </select>
                        </div>
                        <input name="new_diagnosis" style="display: none" type="text" class="form-control" id="diagnosisInput" aria-describedby="diagnosis_help" placeholder="Enter your diagnosis">
                        <small style="display: none"  id="diagnosis_help" class="form-text text-muted">Your information is confidential.</small>
                    </div>
                </div>
                <div class="item-5">
                    <div id="is-patient-container" class="form-group">
                        <div class="form-group" >
                            <label style="font-size: 17px" for="is-patient-select" id="is-patient-select-label">Are you a current patient?</label>
                            <select class="custom-select" id="is-patient-select" onchange="addPatient(); changeVisibility();">
                                <option selected>Select an option</option>
                                <option value="1">Yes</option>
                                <option value="2">No</option>
                            </select>
                        </div>
                        <input name="is-patient" style="display: none" type="text" class="form-control" id="patientInput" aria-describedby="patient_help" placeholder="Enter you patient ID number">
                        <small style="display: none"  id="patient_help" class="form-text text-muted">Your symptom will be recorded in your confidential patient chart associated with your ID.</small>
                    </div>
                </div>
                <div class="item-6">
                    <div class="container">
                        <div class="btn-holder">
                            <button  style="display: none" id="submit_button"  class="btn btn-primary" onclick='this.form.submit()'>Submit</button>
                        </div>
                    </div>
                </div>
                <div class="item-7">
                <?php
                // HERE IS WHERE WE SEND INFORMATION TO OUR DATABASE
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST['symptom_desc'], $_POST['severity'])) {
                        ?>
                        <?php
                        if (mysqli_connect_errno()) {
                            die(mysqli_connect_error());
                        }
                        // If new user defined symptom and a new diagnosis then execute
                        if (($_POST['new_symptom'] != '') && ($_POST['new_diagnosis'] != '')) {
                            if ($_POST['is-patient'] != '') {
                                $sql = "INSERT INTO SYMPTOM(description, severity, infection_name, patient_id) 
                                    VALUES ('{$_POST['new_symptom']}',{$_POST['severity']}, '{$_POST['new_diagnosis']}', '{$_POST['is-patient']}')";
                            } else {
                                $sql = "INSERT INTO SYMPTOM(description, severity, infection_name) 
                                    VALUES ('{$_POST['new_symptom']}',{$_POST['severity']}, '{$_POST['new_diagnosis']}')";
                            }
                        }
                        // If new user defined symptom and no diagnosis then execute
                        elseif (($_POST['new_symptom'] != '') && ($_POST['new_diagnosis'] == '')) {
                            if ($_POST['is-patient'] != '') {
                                $sql = "INSERT INTO SYMPTOM(description, severity, infection_name, patient_id) 
                                    VALUES ('{$_POST['new_symptom']}',{$_POST['severity']}, 'UNKNOWN', '{$_POST['is-patient']}')";
                            } else {
                                $sql = "INSERT INTO SYMPTOM(description, severity, infection_name) 
                                    VALUES ('{$_POST['new_symptom']}',{$_POST['severity']}, 'UNKNOWN')";
                            }
                        }
                        // If predefined symptom and diagnosis then execute
                        elseif (($_POST['new_symptom'] == '') && ($_POST['new_diagnosis'] != '')) {
                            if ($_POST['is-patient'] != '') {
                                $sql = "INSERT INTO SYMPTOM(description, severity, infection_name, patient_id) 
                                    VALUES ('{$_POST['symptom_desc']}',{$_POST['severity']}, '{$_POST['new_diagnosis']}', '{$_POST['is-patient']}')";
                            } else {
                                $sql = "INSERT INTO SYMPTOM(description, severity, infection_name) 
                                    VALUES ('{$_POST['symptom_desc']}',{$_POST['severity']}, '{$_POST['new_diagnosis']}')";
                            }
                        }
                        // If predefined symptom and no diagnosis then execute
                        else {

                            if ($_POST['is-patient'] != '') {
                                $sql = "INSERT INTO SYMPTOM(description, severity, infection_name, patient_id) 
                                    VALUES ('{$_POST['symptom_desc']}', {$_POST['severity']}, 'UNKNOWN', '{$_POST['is-patient']}')";
                            } else {
                                $sql = "INSERT INTO SYMPTOM(description, severity, infection_name) 
                                    VALUES ('{$_POST['symptom_desc']}', {$_POST['severity']}, 'UNKNOWN')";
                            }
                        }
                        if (!mysqli_query($connection, $sql)) {
                            ?>
                                <script>
                                    alert("Ooops! Something went wrong. Please contact administrator or try again.")
                                </script>
                            <?php
                            // echo "Error: Could not execute $sql";
                        } else {
                            ?>
                            <div id='symptom_alert'>
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
                </div>
            </form>
        </div>

    <!-- Some javascript to provide some functionality -->
        <script type="text/javascript">
            function changeVisibility() {
                document.getElementById('submit_button').style.display = 'inline';
            }
            function changeVisibilityHide() {
                document.getElementById('submit_button').style.display = 'none';
            }
            function addNewSymptom() {
                if (document.getElementById("new-symptom-checkbox").checked === true) {
                    document.getElementById('symptomInput').style.display = 'inline';
                    document.getElementById('symptom_help').style.display = 'inline';
                } else {
                    document.getElementById('symptomInput').style.display = 'none';
                    document.getElementById('symptom_help').style.display = 'none';
                }
            }
            function hideAlert() {
                document.getElementById('symptom_alert').style.display = 'none';
            }
            function addNewDiagnosis() {
                if (document.getElementById("diagnosis-select").value === "1") {
                    document.getElementById('diagnosisInput').style.display = 'inline';
                    document.getElementById('diagnosis_help').style.display = 'inline';
                } else {
                    document.getElementById('diagnosisInput').style.display = 'none';
                    document.getElementById('diagnosis_help').style.display = 'none';
                }
            }
            function addPatient() {
                if (document.getElementById("is-patient-select").value === "1") {
                    document.getElementById('patientInput').style.display = 'inline';
                    document.getElementById('patient_help').style.display = 'inline';
                } else {
                    document.getElementById('patientInput').style.display = 'none';
                    document.getElementById('patient_help').style.display = 'none';
                }
            }
        </script>
    </body>
</html>
