<?php require_once('config.php'); ?>
<!-- Elijah Freeman -->
<!-- Employee file that represents the employee page on our website
    that is hosted through Google Cloud Platform. Allows users
    to select different employees using a dropdown menu. The data
    from the dropdown menu is then used in a query to our database
    to retrieve some information about the employee. -->
<!-- TCSS 445 : Autumn 2020 -->
<!-- Assignment 4 Template -->
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
                <li class="nav-item active">
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
        <p class="lead">Select county.</p>
        <hr class="my-4">

        <form method="GET" action="covid_test_center.php">
            <select name="county" onchange='this.form.submit()'>
            <option selected>Select a name</option>

            <?php
            $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
            if ( mysqli_connect_errno() )
            {
                die( mysqli_connect_error() );
            }
            // Query that retrieves the first and last name and SSN from
            // our EMPLOYEE table in our database.
            $sql = "select DISTINCT county from LOCATION";
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

            <!-- Works up until this point -->

            <?php

            if ($_SERVER["REQUEST_METHOD"] == "GET")
            {
                if (isset($_GET['county']) )
                {
            ?>

            <p>&nbsp;</p>
                <table class="table table-hover">
                    <thead>
                        <tr class="table-success">
                            <th scope="col">Hospital Name</th>
                            <th scope="col">Covid test</th>
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
                    $sql = " SELECT hospital_name, covid_test
                             FROM HOSPITAL
                             WHERE county = '{$_GET['county']}'";

                    if ($result = mysqli_query($connection, $sql))
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                     ?>
                <tr>
                    <td><?php echo $row['hospital_name'] ?></td>
                    <td><?php echo $row['covid_test'] ?></td>
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

