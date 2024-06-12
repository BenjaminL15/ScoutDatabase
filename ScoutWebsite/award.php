<?php
    $db = new SQLite3('DatabaseCreator.db');

    $sql = "SELECT FIRSTNAME, LASTNAME
        FROM SCOUTS"; 
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
    <title>Awards</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>Meeting</header>
        <form action="#">
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
                            <label>Date Recieved</label>
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Award Recieved</th>
                </tr>
                <?php if (!empty($scouts)): ?>
                    <?php foreach ($scouts as $scout): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($scout['FIRSTNAME']); ?></td>
                            <td><?php echo htmlspecialchars($scout['LASTNAME']); ?></td>
                            <td><input type="checkbox" name="award_received[]"></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No award information available.</td>
                    </tr>
                <?php endif; ?>
                </table>
                <button type="submit" class="addButton" disabled>
                    <span class="buttonText">Submit Awards</span>
                </button>
            </div>
        </form>
    </div>
    
    <div class="meetingBackground"></div>
    <script src="js/award.js"></script>
</body>
</html>
