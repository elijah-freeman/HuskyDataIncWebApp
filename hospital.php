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
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
	<!-- END Add HTML code for the top menu section (navigation bar) -->

    <div class="jumbotron">
        <p class="lead">Select Hospital Name.</p>
        <hr class="my-4">

        <form method="GET" action="hospital.php">
        <select name="hospital" onchange='this.form.submit()'>
            <option selected>Select a Hospital</option>

            <?php
            $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
            if ( mysqli_connect_errno() )
            {
                die( mysqli_connect_error() );
            }
            // Query that retrieves the first and last name and SSN from
            // our EMPLOYEE table in our database.
            $sql = "select hospital_name from HOSPITAL";
            if ($result = mysqli_query($connection, $sql))
            {
                // loop through the data
                while($row = mysqli_fetch_assoc($result))
                {
                    echo '<option value="' . $row['hospital_name'] . '">';
                    echo $row['hospital_name'];
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
                if (isset($_GET['hospital']) )
                {
            ?>

            <p>&nbsp;</p>
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
                    //error here
                        if ( mysqli_connect_errno() )
                        {
                            die(mysqli_connect_error() );
                        }
                    //error end

                    // Selects all from the result whose ssn is
                    // specified by drop down menu (user only sees
                    // the name but we track the ssn) and match
                    // on department number to find their department.
                    $sql = " SELECT hospital_name, total_bed, availability_bed, covid_test
                             FROM HOSPITAL
                             WHERE hospital_name = '{$_GET['hospital']}'";

                    if ($result = mysqli_query($connection, $sql))
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
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

