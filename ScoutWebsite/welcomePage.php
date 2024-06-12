<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width", initial-scale="1.0">
    <title> Welcome </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper">
        <form action="">
            <h1>Welcome!</h1>
            <h2>What do you need to do?</h2>
            <div class="buttons-option">
                <div class="dropdown">
                    <button class="dropbtn">Scouts</button>
                    <div class="dropdown-content">
                        <a href="ScoutAdd.php">Add Scout</a>
                        <a href="viewScout.php">View Scouts</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="dropbtn">Volunteers</button>
                    <div class="dropdown-content">
                        <a href="addVolunteers.php">Add Volunteers</a>
                        <a href="volunteer.php">View Volunteers</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="dropbtn">Awards</button>
                    <div class="dropdown-content">
                        <a href="award.php">Add Awards</a>
                        <a href="viewAwards.php">View Awards</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="dropbtn">Attendance</button>
                    <div class="dropdown-content">
                        <a href="attendance.php">Add Attendance</a>
                        <a href="viewAttendance.php">View Attendance</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="welcomeBackground"></div>
</body>

</html>
