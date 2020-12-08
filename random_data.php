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
    <title>New Symptom</title>
    <!-- Uses the solar stylesheet from bootswatch and signup stylesheet for layout
             of the signup page and associated buttons. -->
    <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="new_symptoms_stylesheet.css">
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
            <form  style="border-color: #474e5d" class="modal-content bg-dark" method="POST" action="random_data.php">
                <div class="container">
                    <h1>Sign Up</h1>
                    <label for="First_name"><b>First Name</b></label>
                    <input type="text" placeholder="Enter First Name" name="First_name" required>
                    <label for="Last_name"><b>Last Name</b></label>
                    <input type="text" placeholder="Enter Last Name" name="Last_name" required>
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" required>
                    <label for="user_id"><b>User ID</b></label>
                    <input type="text" placeholder="Enter User ID (ex. 10000) " name="user_id" required>
                    <label for="County"><b>County</b></label>
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
    <p style="font-size: 50px" class="lead">Generate Random Data</p>
    <hr class="my-4">
    <form id="form-one" method="POST" action="random_data.php">
        <!-- div container for the drop down form select bar -->
        <div class="item-1">
            <div class="form-group">
                <label style="font-size: 17px" for="symptom_select">Choose a Table to populate with random data.</label>
                <select class = "custom-select" name="table"  id='table-select'>
                    <?php
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    if (mysqli_connect_errno()) {
                        die(mysqli_connect_error());
                    }
                    ?>
                    <option selected>Select a Table</option>
                    <option value="hospital">HOSPITAL</option>
                    <option value="infection">INFECTION</option>
                    <option value="location">LOCATION</option>
                    <option value="patient">PATIENT</option>
                    <option value="symptom">SYMPTOM</option>
                    <option value="user_info">USER_INFO</option>
                </select>
            </div>
        </div>
        <div class="item-2">
            <div class="container">
                <div class="btn-holder">
                    <button  style="display: inline" id="submit_button"  class="btn btn-primary"
                             onclick='this.form.submit()'>Submit
                    </button>
                </div>
            </div>
        </div>
        <div class="item-3">
            <?php
            $hospital_data = array();
            array_push($hospital_data, 'Providence St. Peter Hospital Olympia',
                'Capital Medical Center', 'Providence Medical Center', 'Providence Centralia Hospital',
                'Western State Hospital', 'Mason General Hospital', 'MultiCare Tacoma General Hospital',
                'UW Medical Center - Northwest Seattle Hospital', 'MultiCare Good Samaritan Hospital',
                'St. Joseph Medical Center', 'Willapa Harbor Hospital Campus', 'St. Clare Hospital',
                'MultiCare Allenmore Hospital');
            $county_data = array();
            array_push($county_data, 'King', 'Pierce', 'Snohomish', 'Spokane', 'Clark', 'Thurston',
                'Kitsap', 'Yakima', 'Whatcom', 'Benton', 'Skagit', 'Cowlitz', 'Grant', 'Franklin', 'Island', 'Lewis',
                'Clallam', 'Chelan', 'Grays Harbor', 'Mason', 'Whiman', 'Kittitas', 'Stevens', 'Douglas', 'Okanogan',
                'Jefferson', 'Asotin', 'Pacific', 'Klickitat');
            $infection_data = array();
            array_push($infection_data, 'Influenza', 'Common cold', 'Measles', 'Rubella', 'Chicken Pox',
                'Norovirus', 'Polio', 'Mono', 'Herpes Simplex Virus', 'Human Papillomavirus', 'Meningitis',
                'West Nile Virus', 'Rabies', 'Ebola', 'COVID-19', 'Strep Throat', 'Gonorrhea', 'Syphilis',
                'Tuberculosis', 'Whooping Cough', 'Pneumocococal pneumonia', 'Lyme disease', 'Cholera', 'Botulism',
                'Tetanus', 'Anthrax', 'Malaria', 'Toxoplasmosis', 'Trichomoniasis', 'Giardiasis', 'Tapeworm infection');
            $state_data = array('WA');
            $patient_email_data = array();
            array_push($patient_email_data, 'liedra@optonline.net', 'xtang@live.com', 'singer@msn.com',
                'tromey@me.com', 'attwood@gmail.com', 'augusto@hotmail.com', 'dwheeler@icloud.com',
                'bogjobber@verizon.net','moxfulder@att.net', 'wojciech@att.net', 'djpig@yahoo.com',
                'sumdumass@aol.com');
            $symptom_description_data = array();
            array_push($symptom_description_data, 'Chills', 'Fever', 'Paresthesia', 'Light-headed',
                'Dizzy', 'Nauseated', 'Short of Breath', 'Sleepy', 'Sweaty', 'Thirsty', 'Tired', 'Weak', 'Convulsions',
                'Deformity', 'Discharge', 'Dizziness', 'Hypothermia', 'Jaundice', 'Muscle Weakness', 'Pyrexia',
                'Swelling', 'Weight Gain', 'Arrhymia', 'Bradycardia', 'Chest pain', 'Palpitations', 'Dry Mouth',
                'Hearing Loss', 'Sore Throat', 'Toothache', 'Tinnitus', 'Abdominal Pain', 'Bleeding', 'Diarrhea',
                'Dysphagia', 'Neck Stiffness', 'Paralysis');

            $first_name_data = array();
            array_push($first_name_data, 'James', 'Mary', 'John', 'Patricia', 'Robert', 'Jennifer',
                'Michael', 'Linda', 'William', 'Elizabeth', 'David', 'Barbara', 'Richard', 'Susan', 'Susan', 'Joseph',
                'Jessica', 'Joseph', 'Thomas', 'Sarah', 'Charles', 'Karen', 'Christopher', 'Nancy', 'Daniel', 'Lisa',
                'Matthew');
            $last_name_data = array();
            array_push($last_name_data, 'Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia',
                'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez', 'Hernandez', 'Lopez', 'Gonzalez', 'Wilson',
                'Anderson', 'Thomas', 'Taylor', 'Moore', 'Jackson', 'Martin', 'Lee', 'Perez', 'Thompson', 'White');
            $sex_data = array('M', 'F');
            $medicine_data = array();
            array_push($medicine_data, 'Amoxicillin', 'Azithromycin', 'Amoxicillin', 'Clindamycin',
                'Cephalexin', 'Ciprofloxacin', 'Sulfamethoxazole', 'Trimethoprim', 'Levofloxacin', 'Doxycycline',
                'Lisinopril', 'Atorvastatin', 'Levothyroxine', 'Metformin', 'Amlodipine', 'Metoprolol', 'Omeprazole',
                'Simvastatin', 'Losartan', 'Albuterol', 'Vicodin', 'Simvastatin', 'Metformin', 'Amlodipine');
            ?>

            <?php
            // HERE IS WHERE WE SEND INFORMATION TO OUR DATABASE
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['table'])) {
                ?>
                <?php
                if (mysqli_connect_errno()) {
                    die(mysqli_connect_error());
                }
                // If predefined symptom and no diagnosis then execute
                if ($_POST['table'] == 'hospital') {
                    for ($i = 1;  $i < sizeof($hospital_data); $i++) {
                        $hosp_var = $hospital_data[array_rand($hospital_data)];
                        $total_bed_var = rand(50, 500);
                        $avail_bed_var = rand(0, 250);
                        $county_var = $county_data[array_rand($county_data)];
                        $covid_test_var = rand(0, 1);
                        mysqli_query($connection,
                            "INSERT INTO HOSPITAL(hospital_name, total_bed, availability_bed, county, covid_test) 
                                    VALUES ('$hosp_var', $total_bed_var, $avail_bed_var, '$county_var', 
                                                                                                    $covid_test_var)");
                    }
                } elseif ($_POST['table'] == 'infection') {
                    for ($i = 0; $i <= sizeof($infection_data); $i++) {
                        $infection_var = $infection_data[array_rand($infection_data)];
                        $infection_rate_var = rand(1, 1000)/1000;
                        $medicine_data_var = $medicine_data[array_rand($medicine_data)];
                        $num_infections_var = rand(1, 100000);
                        mysqli_query($connection,
                            "INSERT INTO INFECTION(infection_name, infection_rate, medication, num_of_infections) 
                                    VALUES ('$infection_var', $infection_rate_var, '$medicine_data_var', 
                                            $num_infections_var)");
                    }
                } elseif ($_POST['table'] == 'location') {
                    for ($i = 0;  $i < sizeof($county_data)-1; $i++) {
                        $rand_pop_var = rand(1000, 100000);
                        $rand_num_hosp_var = rand(1, 25);
                        mysqli_query($connection,
                            "INSERT INTO LOCATION(county, state, population, num_of_hospital)
                                    VALUES ('$county_data[$i]', 'WA', $rand_pop_var, $rand_num_hosp_var)");
                    }
                } elseif ($_POST['table'] == 'patient') {
                    // Not a particularly good design choice.
                    // Should update the patient id to auto-increment.
                    $id_counter = 1014;
                    for ($i = 0; $i < sizeof($patient_email_data); $i++) {
                        $id_counter++;
                        $rand_sickness_type = $infection_data[array_rand($infection_data)];
                        $rand_severity = rand(1, 10);
                        $rand_duration = rand(1, 365);
                        $rand_age_range = rand(1, 115);
                        $rand_hosp_name = $hospital_data[array_rand($hospital_data)];
                        $rand_patient_email = $patient_email_data[array_rand($patient_email_data)];

                        mysqli_query($connection,
                            "INSERT INTO PATIENT(patient_id, sickness_type, severity, duration, age_range, 
                                                        hosp_name, patient_email) 
                                    VALUES ($id_counter, '$rand_sickness_type', $rand_severity, $rand_duration,
                                            $rand_age_range, '$rand_hosp_name', '$rand_patient_email')");
                    }
                } elseif ($_POST['table'] == 'symptom') {
                    // Looks good - might be good to add these particular symptoms to a patient? Otherwise
                    // a patient will only have a single
                    for ($i = 0; $i < sizeof($symptom_description_data); $i++) {
                        $rand_desc = $symptom_description_data[array_rand($symptom_description_data)];
                        $rand_sym_severity = rand(1, 10);
                        $rand_infect_name = $infection_data[array_rand($infection_data)];
                        mysqli_query($connection, "INSERT INTO SYMPTOM(description, severity, infection_name) 
                        VALUES ('$rand_desc', $rand_sym_severity, '$rand_infect_name')");
                    }
                } elseif ($_POST['table'] == 'user_info') {
                    $id_counter = 30;
                    for ($i = 0; $i < sizeof($patient_email_data); $i++) {
                        $id_counter = rand(50, 100000);
                        $id_counter++;
                        $rand_email = $patient_email_data[array_rand($patient_email_data)];
                        $rand_first_name = $first_name_data[array_rand($first_name_data)];
                        $rand_last_name = $last_name_data[array_rand($last_name_data)];
                        $rand_county = $county_data[array_rand($county_data)];
                        $rand_sex = $sex_data[array_rand($sex_data)];
                        $rand_age = rand(1, 115);
                        $rand_year = rand(2018, 2020);
                        $rand_month = rand(10, 12);
                        $rand_day = rand(10, 28);
                        $rand_total_year = $rand_year .= $rand_month .= $rand_day;
                        mysqli_query($connection,
                            "INSERT INTO USER_INFO(user_id, email, first_name, last_name, county, sex, age, 
                                                                                                        Case_start_data) 
                                    VALUES ($id_counter, '$rand_email', '$rand_first_name', '$rand_last_name', 
                                            '$rand_county', '$rand_sex', $rand_age, '$rand_total_year')");


                    }

                }



                else {
                    ?>
                    <div id='symptom_alert'>
                        <div class="alert alert-dismissible alert-info">
                            <h4 class="alert-heading">Symptom Recorded</h4>
                            <p class="mb-0">We have recorded your <?php echo $_POST['table']; ?> symptom.
                                    If you feel unwell or your symptom worsen please find
                                    your nearest hospital below. If you would like to record another
                                    symptom re-enter the above information.
                                <a href="covid_test_center.php" class="alert-link">Find a Test Center</a>.</p>
                        </div>
                    </div>
                    <?php
                }
            }// end if (isset)
            } // end if ($_SERVER)
            ?>
        </div>
    </form>
</div>
<!-- Some javascript to provide some functionality -->
</body>
</html>
