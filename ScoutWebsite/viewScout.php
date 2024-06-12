<?php
    $db = new SQLite3('DatabaseCreator.db');
    
    $sql = "SELECT s.FIRSTNAME, s.LASTNAME, s.SCOUT_RANK, s.SCOUT_BIRTHDAY, p.PARENT_FNAME, p.PARENT_LNAME, p.PARENTPHONE 
        FROM SCOUTS s 
        LEFT JOIN SCOUT_PARENT sp ON s.SCOUTID = sp.SCOUTID
        LEFT JOIN PARENTS p ON sp.PARENTID = p.PARENTID AND sp.CONTACT_PRIORITY = 1";

    
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
    <title>Scout Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>Scout Details</header>
        <div class="scout-info">
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search for a scout...">
                <button onclick="searchScout()">Search</button>
            </div>
            <h2>Scout Information</h2>
            <table id="scoutTable">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Rank</th>
                    <th>Birthday</th>
                    <th>Parent's First Name</th>
                    <th>Parent's Last Name</th>
                    <th>Parent's Phone Number</th>
                </tr>
                <?php if (!empty($scouts)): ?>
                    <?php foreach ($scouts as $scout): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($scout['FIRSTNAME']); ?></td>
                            <td><?php echo htmlspecialchars($scout['LASTNAME']); ?></td>
                            <td><?php echo htmlspecialchars($scout['SCOUT_RANK']); ?></td>
                            <td><?php echo htmlspecialchars($scout['SCOUT_BIRTHDAY']); ?></td>
                            <td><?php echo htmlspecialchars($scout['PARENT_FNAME']); ?></td>
                            <td><?php echo htmlspecialchars($scout['PARENT_LNAME']); ?></td>
                            <td><?php echo htmlspecialchars($scout['PARENTPHONE']); ?></td>
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
    <script src="js/viewScout.js"></script>
    <div class="viewBackground"></div>
</body>
</html>
