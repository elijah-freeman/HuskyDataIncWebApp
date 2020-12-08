<?php require_once('config.php'); ?>
<!--
Project Phase III
Group name: Husky Data Inc.
Group members: Elijah Freeman, Roy (Dongyeon) Joo, Xiuxiang Wu


Patient Dashboard:
    This webpage allows the user to locate information about a particular patient. This webpage is intended to be
    used by authorized medical service providers. The user will select a patient id from a drop down menu and then
    will be able to see relevant information. This includes multiple cards that display the patient's diagnosis along
    with infection rate, type of medication that can be used. It also displays additional information about the
    particular patient such as their hospital, contact info, etc.

    On the right hand side of the webpage, the user will be able to see all the patients in the database with an
    infection severity that is higher than average. These are the patients with the most urgent infections.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Information</title>
    <!-- Uses the solar stylesheet from bootswatch and signup stylesheet for layout
             of the signup page and associated buttons. -->
    <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="patient_stylesheet.css">
    <link rel="stylesheet" href="signup.css">
</head>
<body>
<!-- Container to hold the menubar and associated functionality. Sign-up toggle button is located
     within this menu bar. -->
<div class="menubar-container">
    <!-- START Add HTML code for the top menu section (navigation bar) -->
    <nav id = "nav-area" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Husky Data Health</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
                aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor02">
            <!-- Unordered list of navigation items to other webpages. -->
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
                <!-- List item for current page -->
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
        </div>
        <!-- Sign-up button. Opens a pop-up that allows a user to fill out information. -->
        <button class="btn btn-success my-2 my-sm-0" onclick="document.getElementById('id01').style.display='block'"
                style="width:auto;">Sign Up</button>
    </nav>

    <!-- Container for the the sign up popup. Allows user to register their information with our website. Does so
         by using sql insert into HuskyDataInc Database. If the user clicks the sign-up button or clicks outside of the
         focused frame then the signup popup will disappear and no information will be recorded.-->
    <div class="submit-user-button bg-dark" >
        <div id="id01" class="modal">
            <!-- Exit button -->
            <span  onclick="document.getElementById('id01').style.display='none'" class="close"
                   title="Close Modal">&times;</span>
            <!-- Sign up form -->
            <form  style="border-color: #474e5d" class="modal-content bg-dark" method="POST" action="patient.php">
                <div class="container" >
                    <h1>Sign Up</h1>
                    <label for="First_name"><b>First Name</b></label>
                    <input type="text" placeholder="Enter First Name" name="First_name" required>
                    <label for="Last_name"><b>Last Name</b></label>
                    <input type="text" placeholder="Enter Last Name" name="Last_name" required>
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" required>
                    <label for="user_id"><b>User ID</b></label>
                    <input type="text" placeholder="Enter User ID (ex. 10000) " name="user_id" required><label
                            for="County"><b>County</b></label>
                    <input type="text" placeholder="County" name="County" required>
                    <label for="Sex"><b>Sex</b></label>
                    <input type="text" placeholder="Enter Sex (F or M)" name="Sex" required>
                    <label for="Age"><b>Age</b></label>
                    <input type="text" placeholder="Enter Age" name="Age" required>
                    <label for="case_start_date"><b>Case start Date</b></label>
                    <input type="text" placeholder="YYYY-MM-DD" name="case_start_date" required>
                    <div class="clearfix">
                        <button type="submit" class="btn btn-primary" onclick='this.form.submit()'>Sign Up</button>
                    </div>
                    <!-- In this form, we connect the HuskyDataInc database and after we have established a connection
                         we use http POST method to send information to the database. -->
                    <?php
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    // HERE IS WHERE WE SEND INFORMATION TO OUR DATABASE
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST['First_name'], $_POST['Last_name'],$_POST['email'],$_POST['user_id'],
                            $_POST['County'],$_POST['Sex'],$_POST['Age'],$_POST['case_start_date'])) {
                            ?>
                            <?php
                            if (mysqli_connect_errno()) {
                                die(mysqli_connect_error());
                            }
                            // Inserts user information into the USER_INFO table of the Husky Data Inc. database.
                            $sql = "INSERT INTO USER_INFO(user_id, email, first_name, last_name, county, sex, age,
                                                                                                    Case_start_data)
                                    VALUES ({$_POST['user_id']}, '{$_POST['email']}', '{$_POST['First_name']}',
                                            '{$_POST['Last_name']}', '{$_POST['County']}', 
                                            '{$_POST['Sex']}', {$_POST['Age']}, '{$_POST['case_start_date']}')";

                            // If there is an error, we notify the user to contact their administrator. This
                            // error will occur if the input data by the user is bad.
                            if (!mysqli_query($connection, $sql)) {
                                // echo "Error: Could not execute $sql";
                                echo "An error has occurred, please contact administrator.";
                            }

                        }
                    }
                    ?>
                </div>
            </form>
        </div>
        <!-- JavaScript that allows for the sign-up popup feature to appear and disappear according
             to where the user of the website clicks. -->
        <script>
            // Get the modal
            var modal = document.getElementById('id01');
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    </div>
</div> <!-- Close the menubar container. -->

<!-- The following class contains the main content of the webpage. -->
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
                        $connection = mysqli_connect(DBHOST, DBUSER,DBPASS, DBNAME);
                        if ( mysqli_connect_errno() ) {
                            die( mysqli_connect_error() );
                        }
                        // Select all the patient id from the patient table and order them in ascending order.
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
                <div class="container-pat">
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
                                                <p class="card-text"><span style="text-decoration: underline;">Age:</span>
                                                    <em><?php echo $row['age_range'] ?></em></p>
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

                    <!-- Item b contains the diagnosis card. In this card, there is a description of the
                         the patients diagnosis and the infection rate. -->
                    <div class="item-b">
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "GET") {
                            if (isset($_GET['patient']) ) {
                                ?>
                                <?php
                                if ( mysqli_connect_errno() ) {
                                    die(mysqli_connect_error() );
                                }

                                // Select the infection name and infection rate from infection where
                                // the infection matches the patients infections.
                                $sql = " select infection_name, infection_rate 
                                        from INFECTION 
                                        where infection_name IN (
                                                            select sickness_type 
                                                            from PATIENT 
                                                            where patient_id = '{$_GET['patient']}') ";
                                if ($result = mysqli_query($connection, $sql)) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <!-- The card that displays information to the user. -->
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

                    <!-- Card c contains the medication card that displays information about the medication that
                         should be used for their infection. -->
                    <div class="item-c">
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "GET") {
                            if (isset($_GET['patient'])) {
                                ?><?php
                                if ( mysqli_connect_errno() ) {
                                            die(mysqli_connect_error() );
                                        }

                                        // This is the same query that was used previously but we are now interested
                                        // in retrieving the medication.
                                        $sql = " select  infection_name, medication 
                                                from INFECTION 
                                                where infection_name IN (
                                                    select sickness_type 
                                                    from PATIENT 
                                                    where patient_id = '{$_GET['patient']}') ";

                                        if ($result = mysqli_query($connection, $sql)) {
                                            while($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <!-- The card that displays the medication information -->
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

                            <!-- Item d contains a table that displays all of the symptoms that this patient
                                 is exhibiting. -->
                            <div class="item-d">
                                    <?php
                                    if ($_SERVER["REQUEST_METHOD"] == "GET") {
                                        if (isset($_GET['patient']) ) {
                                            ?>
                                        <h3>Patients Symptoms</h3>

                                        <!-- Table displays the list of symptoms and their severity for the patient. -->
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

                    <!-- Contains the table on the right hand side of the website that contains the patients that
                         exhibit the most severe infections. -->
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
                            // Selects patients who exhibit higher than average severity.
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


