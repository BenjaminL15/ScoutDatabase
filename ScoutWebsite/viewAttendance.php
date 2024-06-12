<?php
    $db = new SQLite3('DatabaseCreator.db');
    
    $sql = " SELECT
        s.FIRSTNAME,
        s.LASTNAME,
        m.MEETINGDATE,
        CASE
            WHEN ms.ATTENDANCE = 1 THEN 'Yes'
            ELSE 'No'
        END AS ATTENDED
        FROM
            SCOUTS s
        JOIN
            MEETING_SCOUT ms ON s.SCOUTID = ms.SCOUTID
        JOIN
            MEETING m ON ms.MEETINGID = m.MEETINGID ";

    $result = $db->query($sql);

    $attendances = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $attendances[] = $row;
    }
?>


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

            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Meeting Date</th>
                    <th>Attended</th>
                </tr>
                <?php if (!empty($attendances)): ?>
                    <?php foreach ($attendances as $attendance): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($attendance['FIRSTNAME']); ?></td>
                            <td><?php echo htmlspecialchars($attendance['LASTNAME']); ?></td>
                            <td><?php echo htmlspecialchars($attendance['MEETINGDATE']); ?></td>
                            <td><?php echo htmlspecialchars($attendance['ATTENDED']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No scout information available.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
    <script src="js/viewAttendance.js"></script>
    <div class="viewBackground"></div>
</body>

</html>
