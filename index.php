<!-- TCSS 445 : Autumn 2020 -->
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
            <title>Assignment 4 Demo</title>
            <!-- add a reference to the external stylesheet -->
            <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
            <link rel="stylesheet" href="signup.css">
        </head>
    <body>




    <div class="menubar-container">
        <!-- START Add HTML code for the top menu section (navigation bar) -->
        <nav id = "nav-area" class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Husky Data Health</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
                    aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
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
            <button class="btn btn-secondary my-2 my-sm-0" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Sign Up</button>
        </nav>






        <div class="submit-user-button bg-dark" >
            <div id="id01" class="modal">
                <span  onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <form  style="border-color: #474e5d" class="modal-content bg-dark" method="POST" action="index.php">
                    <div class="container">
                        <h1>Sign Up</h1>
                        <label for="First_name"><b>First Name</b></label>
                        <input type="text" placeholder="Enter First Name" name="First_name" required>
                        <label for="Last_name"><b>Last Name</b></label>
                        <input type="text" placeholder="Enter Last Name" name="Last_name" required>
                        <label for="email"><b>Email</b></label>
                        <input type="text" placeholder="Enter Email" name="email" required>
                        <label for="user_id"><b>User ID</b></label>
                        <input type="text" placeholder="Enter User ID" name="user_id" required><label for="County"><b>County</b></label>
                        <input type="text" placeholder="County" name="County" required>
                        <label for="Sex"><b>Sex</b></label>
                        <input type="text" placeholder="Enter Sex (F or M)" name="Sex" required>
                        <label for="Age"><b>Age</b></label>
                        <input type="text" placeholder="Enter Age" name="Age" required>
                        <label for="case_start_date"><b>Case start Date</b></label>
                        <input type="text" placeholder="case start date(MM-DD-YYY)" name="case_start_date" required>
                        <div class="clearfix">
                            <button type="submit" class="btn btn-primary" onclick='this.form.submit()'>Sign Up</button>
                        </div>
                        <?php
                        $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                        // HERE IS WHERE WE SEND INFORMATION TO OUR DATABASE
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (isset($_POST['First_name'], $_POST['Last_name'],$_POST['email'],$_POST['user_id'],$_POST['County'],$_POST['Sex'],$_POST['Age'],$_POST['case_start_date'])) {
                                ?>
                                <?php
                                if (mysqli_connect_errno()) {
                                    die(mysqli_connect_error());
                                }
                                $sql = "INSERT INTO USER_INFO(user_id, email, first_name, last_name, county, sex, age, Case_start_data)
                                    VALUES ({$_POST['user_id']}, '{$_POST['email']}', '{$_POST['First_name']}', '{$_POST['Last_name']}', '{$_POST['County']}', 
                                            '{$_POST['Sex']}', {$_POST['Age']}, '{$_POST['case_start_date']}')";
                                if (!mysqli_query($connection, $sql)) {
                                    echo "Error: Could not execute $sql";
                                }
                            }
                        }
                        ?>
                    </div>
                </form>
            </div>
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
    </div>









        <!-- END -- Add HTML code for the top menu section (navigation bar) -->
        <div class="jumbotron">
            <h1 class="display-3"> <img src="husky-data-inc.png" alt="Husky Data Inc."> Welcome to Husky Data Inc.</h1>

            <p class="lead">How are you doing? And, how is your family doing during the pandemic? Do you want to get the COVID-19 Test?
                Sign up today. We will find the hospitals near you and the testing centers.</p>
            <hr class="my-4">
            <p>Our database will provide information such as near hospitals, operation
                hours and specialists depending on symptoms to patients. It will help patients to
                decide which hospital they can go to. Also, we are going to analyze data like the
                relationship between symptoms and disease or average fever of COVID-19.
                Analyzing data will help doctors, medical staff, and facilities who are working at
                the hospital to make better service to patients and figure out diseases.
                Moreover, the users can provide their symptoms and locations, so we can suggest
                the users to go to get COVID-19 test or not with testing locations.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Thank you for visiting!</a>
            </p>
        </div>
    </body>
</html>