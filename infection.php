<?php require_once('config.php'); ?>
<!--
Project Phase III
Group name: Husky Data Inc.
Group members: Elijah Freeman Roy (Dongyeon) Joo
This is the infection script for the "Find infection
near you".

Functionality: It allows the users to find information
regarding infections. Find infections by county through
a select menu.
-->

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Infection</title>
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

                <li class="nav-item active">
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
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
	<!-- END Add HTML code for the top menu section (navigation bar) -->

    <div class="jumbotron">
        <p style="font-size: 50px" class="lead">Find Infections Near You</p>
        <hr class="my-4">
        <form method="GET" action="infection.php">

      <!-- div container for the drop down form select bar -->
      <div class="form-group">
        <label style="font-size: 17px" for="county_control_form">If the number of infections in your
             are is high it is recommended that you limit travel.
        </label>
        <select class = "form-control" name="infection" onchange='this.form.submit()' id='county_control_form'>
            <option selected>Select a County</option>

            <?php
            $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
            if ( mysqli_connect_errno() )
            {
                die( mysqli_connect_error() );
            }
            // Query that retrieves the first and last name and SSN from
            // our EMPLOYEE table in our database.
            $sql = "SELECT DISTINCT county
                FROM HOSPITAL JOIN PATIENT ON HOSPITAL.hospital_name = PATIENT.hosp_name, INFECTION
                WHERE PATIENT.sickness_type = INFECTION.infection_name";
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
            <?php

            if ($_SERVER["REQUEST_METHOD"] == "GET")
            {
                if (isset($_GET['infection']) )
                {
            ?>

            <p>&nbsp;</p>
                <table class="table table-hover">
                    <thead>
                        <tr class="table-success">
                            <th scope="col">Infection Name</th>
                            <th scope="col">Infection Rate</th>
                            <th scope="col">Number of Infections</th>
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
                     $sql = "SELECT sickness_type, infection_rate, COUNT(sickness_type) as infection_count
                      FROM (SELECT county, sickness_type, infection_rate
                             FROM HOSPITAL JOIN PATIENT ON HOSPITAL.hospital_name = PATIENT.hosp_name, INFECTION
                             WHERE PATIENT.sickness_type = INFECTION.infection_name) T1
                      WHERE county = '{$_GET['infection']}' GROUP BY sickness_type";

                    if ($result = mysqli_query($connection, $sql))
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                     ?>
                <tr>
                    <td><?php echo $row['sickness_type'] ?></td>
                    <td><?php echo $row['infection_rate'] ?></td>
                    <td><?php echo $row['infection_count'] ?></td>
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

