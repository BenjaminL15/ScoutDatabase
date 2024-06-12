<?php
    $db = new SQLite3('DatabaseCreator.db');

    $sql = "SELECT AWARDS.AWARDNAME, SCOUTS.FIRSTNAME, SCOUTS.LASTNAME, MEMBER_AWARDS.DATE_AWARDED
        FROM MEMBER_AWARDS 
        JOIN SCOUTS ON MEMBER_AWARDS.SCOUTID = SCOUTS.SCOUTID 
        JOIN AWARDS ON MEMBER_AWARDS.AWARDID = AWARDS.AWARDID";
    $result = $db->query($sql);

    $awards = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $awards[] = $row;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awards Details</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>Awards Details</header>
        <div class="awards-info">
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search for an award...">
                <button onclick="searchAward()">Search</button>
            </div>
            <h2>Awards Information</h2>
            <table id="awardsTable">
                <tr>
                    <th>Award</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date Achieved</th>
                </tr>
                <?php if (!empty($awards)): ?>
                    <?php foreach ($awards as $award): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($award['AWARDNAME']); ?></td>
                            <td><?php echo htmlspecialchars($award['FIRSTNAME']); ?></td>
                            <td><?php echo htmlspecialchars($award['LASTNAME']); ?></td>
                            <td><?php echo htmlspecialchars($award['DATE_AWARDED']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No award information available.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
    <script src="js/viewAward.js"></script>
    <div class="viewBackground"></div>
</body>

</html>
