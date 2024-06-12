<?php

    $db = new SQLite3('DatabaseCreator.db');

    $successMessage = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $meetingDate = $_POST['meeting_date'];
        $attendance = $_POST['attendance'];

        $db->exec("INSERT INTO MEETING (MEETINGDATE) VALUES ('$meetingDate')");
        $meetingID = $db->lastInsertRowID();

        foreach ($attendance as $scoutID => $attended) {
            $attendedValue = $attended === 'on' ? 1 : 0;
            $db->exec("INSERT INTO MEETING_SCOUT (MEETINGID, SCOUTID, ATTENDANCE) VALUES ($meetingID, $scoutID, $attendedValue)");
        }

        $successMessage = 'Attendance successfully recorded.';

        header("Location: {$_SERVER['PHP_SELF']}");
        exit(); 
    }

    $sql = "SELECT SCOUTID, FIRSTNAME, LASTNAME FROM SCOUTS"; 
    $result = $db->query($sql);

    $scouts = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $scouts[] = $row;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>Meeting</header>
        <?php if ($successMessage): ?>
            <div class="success-message"><?php echo htmlspecialchars($successMessage); ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="attendance first">
                <div class="Mark Attendance">
                    <span class="title">Scout Attendance</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Meeting Date</label>
                            <input type="date" name="meeting_date" required>
                        </div>
                    </div>
                </div>
            </div>

            <div id="databaseView">
                <span class="title">Scouts</span>
                <input type="text" id="searchInput" onkeyup="searchScouts()" placeholder="Search for scouts...">
                <table id="scoutsTable">
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Attended</th>
                    </tr>
                    <?php if (!empty($scouts)): ?>
                        <?php foreach ($scouts as $scout): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($scout['FIRSTNAME']); ?></td>
                                <td><?php echo htmlspecialchars($scout['LASTNAME']); ?></td>
                                <td><input type="checkbox" name="attendance[<?php echo $scout['SCOUTID']; ?>]"></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No scouts available.</td>
                        </tr>
                    <?php endif; ?>
                </table>
                <button type="submit" class="addButton">
                    <span class="buttonText">Submit Attendance</span>
                </button>
            </div>
        </form>
    </div>
    <script src="js/addAttendance.js"></script>
    <div class="meetingBackground"></div>
</body>
</html>
