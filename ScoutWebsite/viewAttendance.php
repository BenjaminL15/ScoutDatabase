<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>Scout Attendance Information</header>
        <div class="attendance-info">
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search for a scout...">
                <input type="date" id="dateInput">
                <button onclick="searchAttendance()">Search</button>
            </div>
            <h2>Attendance Details</h2>
            <p class="placeholder">This is placeholder data until the database is ready.</p>

            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Meeting Date</th>
                    <th>Attended</th>
                </tr>
                <tr>
                    <td class="placeholder">John</td>
                    <td class="placeholder">Doe</td>
                    <td class="placeholder">2024-06-10</td>
                    <td class="placeholder">Yes</td>
                </tr>
                <tr>
                    <td class="placeholder">Jane</td>
                    <td class="placeholder">Smith</td>
                    <td class="placeholder">2024-06-10</td>
                    <td class="placeholder">No</td>
                </tr>
            </table>
        </div>
    </div>
    <script src="viewAttendance.js"></script>
    <div class="viewBackground"></div>
</body>

</html>
