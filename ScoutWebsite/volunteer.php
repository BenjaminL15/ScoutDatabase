<?php
    $db = new SQLite3('DatabaseCreator.db');
    
    $sql = "SELECT AVFNAME, AVLNAME, AVPHONE, AVADDRESS, AVSTATE, AVZIP,
        CASE WHEN PARENTID IS NOT NULL THEN 'Yes' ELSE 'No' END AS IsParent,
        CASE WHEN COUNSELOR_ID IS NOT NULL THEN 'Yes' ELSE 'No' END AS IsCounselor
        FROM ADULT_VOLUNTEERS";
    
    $result = $db->query($sql);

    $volunteers = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $volunteers[] = $row;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Volunteers</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>Volunteers Information</header>
        <div class="volunteers-info">
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search for a volunteer...">
                <button onclick="searchVolunteer()">Search</button>
            </div>
            <h2>Volunteers Details</h2>
            <table id="volunteerTable">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>State</th>
                    <th>ZIP</th>
                    <th>Parent</th>
                    <th>Merit Badge Counselor</th>
                </tr>
                <?php if (!empty($volunteers)): ?>
                    <?php foreach ($volunteers as $volunteer): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($volunteer['AVFNAME']); ?></td>
                            <td><?php echo htmlspecialchars($volunteer['AVLNAME']); ?></td>
                            <td><?php echo htmlspecialchars($volunteer['AVPHONE']); ?></td>
                            <td><?php echo htmlspecialchars($volunteer['AVADDRESS']); ?></td>
                            <td><?php echo htmlspecialchars($volunteer['AVSTATE']); ?></td>
                            <td><?php echo htmlspecialchars($volunteer['AVZIP']); ?></td>
                            <td><?php echo htmlspecialchars($volunteer['IsParent']); ?></td>
                            <td><?php echo htmlspecialchars($volunteer['IsCounselor']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No volunteer information available.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
    <script src="js/viewVolunteer.js"></script>
    <div class="viewBackground"></div>
</body>

</html>
