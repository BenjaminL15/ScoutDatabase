<?php
$db = new SQLite3('DatabaseCreator.db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $awardID = $_POST['award'];
    $dateReceived = $_POST['date_received'];

    foreach ($_POST['award_received'] as $scoutID => $received) {
        if ($received == '1') {
            $stmt = $db->prepare("INSERT INTO MEMBER_AWARDS (SCOUTID, AWARDID, DATE_AWARDED) VALUES (:scoutID, :awardID, :dateReceived)");
            $stmt->bindValue(':scoutID', $scoutID, SQLITE3_INTEGER);
            $stmt->bindValue(':awardID', $awardID, SQLITE3_INTEGER);
            $stmt->bindValue(':dateReceived', $dateReceived, SQLITE3_TEXT);
            $stmt->execute();
        }
    }

    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

$sql = "SELECT SCOUTID, FIRSTNAME, LASTNAME FROM SCOUTS";
$result = $db->query($sql);
$scouts = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $scouts[] = $row;
}

$sqlAwards = "SELECT AWARDID, AWARDNAME FROM AWARDS";
$resultAwards = $db->query($sqlAwards);
$awards = [];
while ($row = $resultAwards->fetchArray(SQLITE3_ASSOC)) {
    $awards[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awards</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>Awards</header>
        <form method="post" action="">
            <div class="attendance first">
                <div class="Mark Attendance">
                    <span class="title">Awards</span>
                    <div class="dropdown">
                        <input type="text" id="awardSearchInput" onkeyup="searchAwards()" placeholder="Search for awards...">
                        <select id="awardDropdown" name="award">
                            <?php foreach ($awards as $award): ?>
                                <option value="<?php echo $award['AWARDID']; ?>"><?php echo htmlspecialchars($award['AWARDNAME']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="fields">
                        <div class="input-field">
                            <label>Date Received</label>
                            <input type="date" name="date_received" required>
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
                        <th>Award Received</th>
                    </tr>
                    <?php if (!empty($scouts)): ?>
                        <?php foreach ($scouts as $scout): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($scout['FIRSTNAME']); ?></td>
                                <td><?php echo htmlspecialchars($scout['LASTNAME']); ?></td>
                                <td><input type="checkbox" name="award_received[<?php echo $scout['SCOUTID']; ?>]" value="1"> Yes</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No scouts found.</td>
                        </tr>
                    <?php endif; ?>
                </table>
                <button type="submit" class="addButton">
                    <span class="buttonText">Submit Awards</span>
                </button>
            </div>
        </form>
    </div>
    
    <div class="meetingBackground"></div>
    <script src="js/award.js"></script>
</body>
</html>
