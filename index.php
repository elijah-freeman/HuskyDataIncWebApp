<?php require_once('config.php'); ?>
<!--
Project Phase III
Group name: Husky Data Inc.
Group members: Elijah Freeman, Roy (Dongyeon) Joo, Xiuxiang Wu

Index (Homepage) :

-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- add a reference to the external stylesheet -->
    <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
    <link rel="stylesheet" href="signup.css">
</head>
<body>

<!-- Container to hold the menubar and associated functionality. Sign-up toggle button is located
     within this menu bar. -->
<div class="menubar-container">
    <nav id = "nav-area" class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Husky Data Health</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
                    aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor02">
                <!-- Unordered list of navigation items to other webpages. -->
                <ul class="navbar-nav mr-auto">
                    <!-- List item for the current Covid Test Center page -->
                    <li class="nav-item active">
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
                <form  style="border-color: #474e5d" class="modal-content bg-dark" method="POST"
                       action="index.php">
                    <div class="container">
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

<!-- END -- Add HTML code for the top menu section (navigation bar) -->
<div class="jumbotron">
    <h1 class="display-3"> <img src="husky-data-inc.png" alt="Husky Data Inc."> Welcome to Husky Data Inc.</h1>
    <p class="lead">Overview</p>
    <hr class="my-4">
    <p>As a team, we wanted to design our project based around our health community given the current global health crisis.
                The problem that we are trying to solve is getting more health information directly into the public hands. 
                We will have a sophisticated database that has the ability to store a variety of information pertaining to the; hospital, hospital staff, patient, doctor, user, and location information. 
                The database will monitor infection rate of certain disease types, hospital availability based on room count, as well as comprehensive information about the health and symptoms of the patients.
                By storing all this data together in our database, it will allow us to extrapolate statistical information about infection rate, hospital availability, and duration of sickness based on disease 
                type among many others. Our project will be available to use by the general public who will also be able to see doctor/patient and nurse/patient ratios that we can use to help predict likelihood 
                of patient wait times based on the hospital. This application will also be used by the hospital management staff so that they can improve efficiency in key areas to improve public health response 
                rates. For example, a healthcare management team can more easily distribute the number of patients evenly to doctors as well as see what equipment they may need depending on the infection rate of 
                a particular type of disease (e.g. COVID-19).
                Furthermore we will provide a platform for users to update their personal health information such as any symptoms they may exhibit so that we can closely monitor local community health and inform 
                users of a rise in a particular type of infection in their area. Our database application may also serve as a COVID-19 tracker where a person can document when and where they encountered an individual
                with COVID-19 or someone with relevant symptoms.
                Husky Data Inc. was formed out of an idea of commitment to the health and wellness of our community at large. It is our mission to encourage and promote the dissemination of information directly
                related to the health of our communities.</p>
    <p class="lead">Project Description</p>
    <hr class="my-4">
    <p>We are planning to create delivery methods such as web pages or an application and demonstrate in front of other students and the professor how this program works.
                For example, if a patient types his/her symptoms and location then it will show the specialists arounds you and the nearest hospital location. 
                For creating a web page or application, We are planning to use Javascript, HTML, Java and python. For analyzing data, we will use R or Python to analyze data 
                and also provide graphs by using graphing tools such as pyplot, matplotlib to visualize the relationship between attributes. 
                We also want to use a database management tool which is SQL to manage dataset to update and modify our database. 
                We will use Github for the repository, so we can share the repository to other people who need hospitals and medical data.</p>
    <p class="lead">Members' Contact Information</p>
    <p>Elijah Freeman: elijahff@uw.edu</p>
    <p>Roy(Dongyeon) Joo: djoo@uw.edu</p>
    <p>Xiuxiang Wu: xwu29@uw.edu</p>
</div>
</body>
</html>