<?php require_once('config.php'); ?>
<!--
Project Phase III
Group name: Husky Data Inc.
Group members: Elijah Freeman, Roy (Dongyeon) Joo, Xiuxiang Wu

Infection Dashboard:
    This webpage allows users to view and analyze key information about a particular infection selected by the user.
    The user can select from a drop down selection menu the infection name they would like to find more information
    about. Once selected, the webpage will display a series of cards: Infection, Symptom, Information about patients
    who are infected with specified infection, Medication, Locations and counts of selected infections. Incorporates
    the majority of tables in HuskyDataInc database.
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infection</title>
    <!-- Uses the solar stylesheet from bootswatch and signup stylesheet for layout
             of the signup page and associated buttons. -->
    <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
    <link rel="stylesheet" href="infection_stylesheet.css">
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
                <!-- List item for current page -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="infection.php">Infection</a>
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
            <form  style="border-color: #474e5d" class="modal-content bg-dark" method="POST" action="infection.php">
                <div class="container">
                    <h1>Sign Up</h1>
                    <label for="First_name"><b>First Name</b></label>
                    <input type="text" placeholder="Enter First Name" name="First_name" required>
                    <label for="Last_name"><b>Last Name</b></label>
                    <input type="text" placeholder="Enter Last Name" name="Last_name" required>
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" required>
                    <label for="user_id"><b>User ID</b></label>
                    <input type="text" placeholder="Enter User ID (ex. 10000) " name="user_id" required><label for="County">
                        <b>County</b></label>
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
    <p style="font-size: 50px" class="lead">Infection Dashboard</p>
    <hr class="my-4">
    <form method="GET" action="infection.php">

        <!-- Infection container is contains all the cards and the select menu for the webpage, required for
             layout of the webpage. -->
        <div class="infection-container">

            <!-- Item-1 represents the select drop down menu that allows the user to select a particular infection
                 to examine.  -->
            <div class="item-1">
                <div class="form-group">
                    <select id="infection_select" class="custom-select" name="infection" onchange='this.form.submit()'>
                        <option selected>Select an Infection</option>
                        <?php
                        $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                        if (mysqli_connect_errno()) {
                            die(mysqli_connect_error());
                        }

                        // Sql query that selects all the infection names from the Infection table.
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
            </div>

            <!-- Item 2 contains the infection card. The infection card displays the infection name, the infection
                 rate, and the total number of cases. -->
            <div class="item-2">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    if (isset($_GET['infection']) ) {
                        if (mysqli_connect_errno()) {
                            die(mysqli_connect_error() );
                        }

                        // Selects the infection name, infection rate, and the number of infections from the
                        // Infection table for the infection that was selected by the user.
                        $sql = "SELECT DISTINCT infection_name, infection_rate, num_of_infections
                            FROM INFECTION
                            WHERE infection_name = '{$_GET['infection']}';";

                        if ($result = mysqli_query($connection, $sql)) {
                            // Creates an array that will store the information that is retrieved from the database.
                            $array = array();
                            while($row = mysqli_fetch_assoc($result)) {
                                array_push($array, $row['infection_rate'], $row['num_of_infections']);
                            }
                            if (empty($array)) {
                                array_push($array, 'Unknown', 'Unknown');
                            }
                            ?>
                            <!-- Display the information in the card -->
                            <div class="card text-white bg-warning mb-3" style="max-width: 20rem;">
                                <div class="card-header">Infection</div>
                                <div class="card-body">
                                    <h4 id="result" class="card-title"><?php echo $_GET['infection'] ?></h4>
                                    <p>Infection Rate: <?php echo $array[0] ?></p>
                                    <p>Total Number of Cases: <?php echo $array[1] ?></p>
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

            <!-- Item 3 is the container for the medication card. In this card, we display the medication
                 that is associated with the particular infection that was selected by the user. -->
            <div class="item-3">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    if (isset($_GET['infection']) ) {
                        if (mysqli_connect_errno()) {
                            die(mysqli_connect_error() );
                        }

                        // Select the name of the medication from the Infection table that is associated with the
                        // infection selected by the user.
                        $sql = "SELECT medication
                            FROM INFECTION 
                            WHERE infection_name = '{$_GET['infection']}';";

                        // Retrieve information from the database and store it in an array.
                        if ($result = mysqli_query($connection, $sql)) {
                            $array = array();
                            while($row = mysqli_fetch_assoc($result)) {
                                array_push($array, $row['medication']);
                            }
                            if (empty($array)) {
                                array_push($array, 'Unknown', 'Unknown');
                            }
                            ?>

                            <!-- Display the information in the card -->
                            <div class="card text-white bg-info mb-3" style="max-width: 20rem;">
                                <div class="card-header">Medication</div>
                                <div class="card-body">
                                    <h4 id="result" class="card-title"><?php echo $array[0] ?></h4>
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

            <!-- Item 4 contains the symptoms card which displays all of the symptoms that have been associated
                 with the infection chosen by the user -->
            <div class="item-4">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                if (isset($_GET['infection']) ) {
                if (mysqli_connect_errno()) {
                    die(mysqli_connect_error() );
                }

                // Select all distinct symptom names for the infection chosen by the user.
                $sql = "SELECT DISTINCT description, infection_name
                            FROM SYMPTOM 
                            WHERE infection_name = '{$_GET['infection']}';";

                if ($result = mysqli_query($connection, $sql)) {
                ?>

                <!-- Display the symptom information using a table that has been embedded into the card. -->
                <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
                    <div class="card-header">Symptoms</div>
                    <div class="card-body">
                        <small style="padding-bottom: 15px" class="form-text">Patients who have <?php echo $_GET['infection'] ?>
                            experience the following symptoms:
                        </small>
                        <table cellpadding="10px" class="table table-hover" style="border-top: none;">
                            <?php
                            if ( mysqli_connect_errno() )
                            {
                                die(mysqli_connect_error() );
                            }

                            // Select all the symptom names that are to be displayed in the table.
                            $sql = "SELECT DISTINCT description, infection_name
                                    FROM SYMPTOM 
                                    WHERE infection_name = '{$_GET['infection']}';";

                            if ($result = mysqli_query($connection, $sql)) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td class="text-white" style="font-size: 16px"><?php echo $row['description'] ?></td>
                                    </tr>

                                    <?php
                                } // release the memory used by the result set
                                mysqli_free_result($result);
                            }

                            } // end if (isset)
                            } // end if ($_SERVER)
                            }
                            ?>

                        </table>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>

            <!-- Item 5 contains the card that contains all of the locations and the current counts of cases for
                 the infection selected by the user. -->
            <div class="item-5">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                if (isset($_GET['infection']) ) {
                if (mysqli_connect_errno()) {
                    die(mysqli_connect_error() );
                }
                if ($result = mysqli_query($connection, $sql)) {
                ?>
                <div class="card text-white bg-danger mb-3" style="max-width: 20rem;">
                    <div class="card-header">Locations and Counts of Current <?$_GET['infection']?> Cases</div>
                    <div class="card-body">
                        <small style="padding-bottom: 15px" class="form-text">Patients who have <?php echo $_GET['infection'] ?>
                            can be found in the following locations:
                        </small>

                        <!-- Embedded table that displays the location and number of cases in that location
                             for the infection specified by the user. -->
                        <table cellpadding="10px" class="table table-hover" style="border-top: none;">
                            <thead>
                            <tr class="text-white">
                                <th scope="col">Location</th>
                                <th scope="col">Cases</th>
                            </tr>
                            </thead>
                            <?php
                            if ( mysqli_connect_errno() ) {
                                die(mysqli_connect_error() );
                            }

                            // Sql query that joins the Patient and hospital on the hospital and then finds the
                            // county, the infection name, and then counts the number of patients who are currently
                            // in that location who are also infected with the specified infection.
                            $sql = "SELECT DISTINCT county, sickness_type, COUNT(county) as infection_count
                                FROM (SELECT county, sickness_type, infection_rate
                                FROM HOSPITAL JOIN PATIENT ON HOSPITAL.hospital_name = PATIENT.hosp_name, INFECTION
                                WHERE PATIENT.sickness_type = INFECTION.infection_name) T1
                                WHERE sickness_type = '{$_GET['infection']}' GROUP BY county";

                            if ($result = mysqli_query($connection, $sql)) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr class="text-white">
                                        <td><?php echo $row['county'] ?></td>
                                        <td><?php echo $row['infection_count'] ?></td>
                                    </tr>
                                    <?php
                                } // release the memory used by the result set
                                mysqli_free_result($result);
                            }

                            } // end if (isset)
                            } // end if ($_SERVER)
                            }
                            ?>

                        </table>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>

            <!-- Item 6 contains the Patient information card. This card allows the user to view relevant information
                 about the patients have this particular infections such as the severity of there infection, their age,
                 and the length of time they have spent in the hospital for this infection. -->
            <div class="item-6">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    if (isset($_GET['infection']) ) {
                        if (mysqli_connect_errno()) {
                            die(mysqli_connect_error() );
                        }
                        $sql = "SELECT  duration, age_range
                                FROM PATIENT 
                                WHERE sickness_type = '{$_GET['infection']}';";
                        if ($result = mysqli_query($connection, $sql)) {
                            ?>
                <div class="card text-white bg-success mb-3" style="max-width: 20rem;">
                    <div class="card-header">Patient Information</div>
                    <div class="card-body">
                        <small style="padding-bottom: 15px" class="form-text">Information about patients who are
                            currently infected with <?php echo $_GET['infection'] ?>
                        </small>

                        <!-- Embedded table that displays the severity, duration in hospital, and the age of the
                             patients who are infected with this infection. -->
                        <table cellpadding="10px" class="table table-hover" style="border-top: none;">
                            <thead>
                            <tr class="text-white">
                                <th scope="col">Severity</th>
                                <th scope="col">Duration in Hospital</th>
                                <th scope="col">Age</th>
                            </tr>
                            </thead>
                            <?php
                            if (mysqli_connect_errno()) {
                                die(mysqli_connect_error() );
                            }

                            // Select the severity, duration, and age of the patients from the Patient table in
                            // the HuskyDataInc database.
                            $sql = "SELECT severity, duration, age_range
                            FROM PATIENT 
                            WHERE sickness_type = '{$_GET['infection']}';";
                            if ($result = mysqli_query($connection, $sql)) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr class="text-white">
                                        <td><?php echo $row['severity'] ?></td>
                                        <td><?php echo $row['duration'] ?></td>
                                        <td><?php echo $row['age_range'] ?></td>
                                    </tr>
                                    <?php
                                } // release the memory used by the result set
                                mysqli_free_result($result);
                            }
                        } // end if (isset)
                    } // end if ($_SERVER)
                }
                ?>
                        </table>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div> <!-- End item 6 container -->

        </div> <!-- End infection container -->
    </form>
</body>
</html>