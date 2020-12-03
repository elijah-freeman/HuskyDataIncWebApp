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
        </head>
    <body>
        <!-- START -- Add HTML code for the top menu section (navigation bar) -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Husky Data Health</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
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
                   <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                    </li> -->
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
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