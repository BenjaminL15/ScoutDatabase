<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width", initial-scale="1.0">
    <title>Meeting</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>Meeting</header>
        <form action="attendance.php" method="post">
            <div class="attendance first">
                <div class="Mark Attendance">
                    <span class="title">Scout Attendance</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Meeting Date</label>
                            <input type="date" required>
                        </div>
                    </div>
                </div>
            </div>

            <div id="databaseView">
                <span class="title">Scouts</span>
                <input type="text" id="searchInput" onkeyup="searchScouts()" placeholder="Search for scouts...">
                <table id="scoutsTable">
                    <tr>
                        <th>Name</th>
                        <th>Attended</th>
                    </tr>
                    <tr>
                        <td class="placeholder">Ben Lee</td>
                        <td><input type="checkbox" name="attended" value="John Doe"></td>
                    </tr>
                    <tr>
                        <td class="placeholder">Brian Lai</td>
                        <td><input type="checkbox" name="attended" value="Jane Smith"></td>
                    </tr>
                    <tr>
                        <td class="placeholder">Bianca Jewett</td>
                        <td><input type="checkbox" name="attended" value="Jane Smith"></td>
                    </tr>
                    <tr>
                        <td class="placeholder">Husnain Choudhry</td>
                        <td><input type="checkbox" name="attended" value="Jane Smith"></td>
                    </tr>
                </table>
                <button type="submit" class="addButton" disabled>
                    <span class="buttonText">Submit Attendance</span>
                </button>
            </div>
        </form>
    </div>
    <div class="meetingBackground"></div>
</body>
</html>
