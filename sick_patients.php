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
		<title>Husky Data.Inc</title>
		<!-- add a reference to the external stylesheet -->
        <!-- Uses the solar stylesheet from bootswatch -->
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
                <li class="nav-item active">
                    <a class="nav-link" href="sick_patients.php">Sick Patients</a>
                </li>
            </ul>
        </div>
        <button class="btn btn-secondary my-2 my-sm-0" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Sign Up</button>
    </nav>






    <div class="submit-user-button bg-dark" >
        <div id="id01" class="modal">
            <span  onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <form  style="border-color: #474e5d" class="modal-content bg-dark" method="POST" action="sick_patients.php">
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



<div class="jumbotron">
        <p class="lead">Select disease</p>
        <hr class="my-4">

        <form method="GET" action="sick_patients.php">
            <select name="infection_name" onchange='this.form.submit()'>
            <option selected>Select a disease</option>

            <?php
            $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
            if ( mysqli_connect_errno() )
            {
                die( mysqli_connect_error() );
            }
            // Query that retrieves the first and last name and SSN from
            // our EMPLOYEE table in our database.
            $sql = "select  infection_name from INFECTION";
            if ($result = mysqli_query($connection, $sql))
            {
                // loop through the data
                while($row = mysqli_fetch_assoc($result))
                {
                    echo '<option value="' . $row['infection_name'] . '">';
                    echo $row['infection_name'];
                    echo "</option>";

                } // release the memory used by the result set
                mysqli_free_result($result);
             }
            ?>
            </select>

            <!-- Works up until this point -->

            <?php

            if ($_SERVER["REQUEST_METHOD"] == "GET")
            {
                if (isset($_GET['infection_name']) )
                {
            ?>

            <p>&nbsp;</p>
                <table class="table table-hover">
                    <thead>
                        <tr class="table-success">
                            <th scope="col">Patient_id</th>
                            <th scope="col">Severity</th>
                            <th scope="col">Age</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>

                    <?php
                    //error here
                        if ( mysqli_connect_errno() )
                        {
                            die(mysqli_connect_error() );
                        }
                    //error end

                    // SELECT patient_id, severity, age_range, patient_email
                    // Shows that result who has that symptoms that we selected as an option

                    $sql = " SELECT patient_id, severity, age_range, patient_email
                             FROM PATIENT
                             WHERE sickness_type = '{$_GET['infection_name']}'";
                    //$result = mysql_query($query, $conn) or die(mysql_error());

                    if ($result = mysqli_query($connection, $sql))
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                     ?>
                <tr>
                    <td><?php echo $row['patient_id'] ?></td>
                    <td><?php echo $row['severity'] ?></td>
                    <td><?php echo $row['age_range'] ?></td>
                    <td><?php echo $row['patient_email'] ?></td>
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

