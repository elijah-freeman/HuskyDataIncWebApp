<?php require_once('config.php'); ?>
<!--
Project Phase III
Group name: Husky Data Inc.
Group members: Elijah Freeman, Roy (Dongyeon) Joo, Xiuxiang Wu

Hospital:
    Allows the user to find hospitals near them by selecting from a set of locations. It also allows the user to view
    information about the hospitals in a particular location near them. It also adds the functionality of having
    google maps embedded in the website so the user can easily navigate to the hospital's exact location if needed.
-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Find a Hospital</title>
        <!-- Uses the solar stylesheet from bootswatch and signup stylesheet for layout
             of the signup page and associated buttons. -->
		<link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
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
                <!-- List item for current page -->
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
            <span  onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">
                &times;</span>
            <!-- Sign up form -->
            <form  style="border-color: #474e5d" class="modal-content bg-dark" method="POST" action="hospital.php">
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
    <p class="lead">Select Hospital Name.</p>
    <hr class="my-4">
    <form method="GET" action="hospital.php">
        <select name="hospital" onchange='this.form.submit()'>
            <option selected>Select a Hospital</option>
            <?php
            $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
            if ( mysqli_connect_errno() ) {
                die( mysqli_connect_error() );
            }
            // Query that selects all names of hospitals that are currently stored in the Hospital table of
            // the HuskyDataInc database.
            $sql = "select hospital_name from HOSPITAL";
            if ($result = mysqli_query($connection, $sql)) {
                // loop through the data
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['hospital_name'] . '">';
                    echo $row['hospital_name'];
                    echo "</option>";
                } // release the memory used by the result set
                mysqli_free_result($result);
            }
            ?>
        </select>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET['hospital'])) {
                ?>
        <p>&nbsp;</p>

        <!-- This table displays the Hospital name, total number of beds in the hospital, the total number
             of available beds in the hospital and whether or not this hospital is covid test center. -->
        <table class="table table-hover">
            <thead>
            <tr class="table-success">
                <th scope="col">Hospital Name</th>
                <th scope="col">Total bed</th>
                <th scope="col">Availability</th>
                <th scope="col">Covid-test</th>
            </tr>
            </thead>
            <?php
            if ( mysqli_connect_errno() ) {
                die(mysqli_connect_error() );
            }

            // Selects the hospital name, total beds, available beds, covid_test availability from the
            // Hospital table in the HuskyDataInc database.
            $sql = " SELECT hospital_name, total_bed, availability_bed, covid_test
                     FROM HOSPITAL WHERE hospital_name = '{$_GET['hospital']}'";

            if ($result = mysqli_query($connection, $sql)) {
                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['hospital_name'] ?></td>
                        <td><?php echo $row['total_bed'] ?></td>
                        <td><?php echo $row['availability_bed'] ?></td>
                        <td><?php echo $row['covid_test'] ?></td>
                        <td colspan = "2" valign = 'right'>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5375.550587755085!2d-122.31277886511229!3d47.6499333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x98ab1d36f904c3a!2sMedical%20Specialties%20Center%20at%20UW%20Medical%20Center%20-%20Montlake!5e0!3m2!1sen!2sus!4v1606952950455!5m2!1sen!2sus"
                                width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </td>
                    </tr>
                    <?php
                } // release the memory used by the result set
                mysqli_free_result($result);
            }
            } // end if (isset)
        } // end if ($_SERVER)
            ?>
        </table>
    </form>
</div>
</body>
</html>

