<?php
    $db = new SQLite3('DatabaseCreator.db');
    
    $sql = "SELECT 
        s.SCOUTID,
        s.FIRSTNAME, 
        s.LASTNAME, 
        r.RANK_NAME AS SCOUT_RANK, 
        s.SCOUT_BIRTHDAY, 
        p.PARENT_FNAME, 
        p.PARENT_LNAME, 
        p.PARENTPHONE
    FROM SCOUTS s 
    LEFT JOIN (
        SELECT 
            sp.SCOUTID,
            p.PARENT_FNAME,
            p.PARENT_LNAME,
            p.PARENTPHONE
        FROM SCOUT_PARENT sp
        INNER JOIN PARENTS p ON sp.PARENTID = p.PARENTID
        WHERE sp.CONTACT_PRIORITY = 1
    ) p ON s.SCOUTID = p.SCOUTID
    LEFT JOIN RANK r ON s.RANKID = r.RANKID
    ";

    $result = $db->query($sql);

    $scouts = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $scouts[] = $row;
    }

    $sql_rank = "SELECT RANKID, RANK_NAME FROM RANK";
    $result = $db->query($sql_rank);

    $ranks = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $ranks[] = $row;
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
                <input type="text" id="searchInput" placeholder="Scout information...">
                <input type="date" id="dateInput">
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
                    <th>Action</th>
                </tr>
                <?php if (!empty($scouts)): ?>
                    <?php foreach ($scouts as $scout): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($scout['FIRSTNAME']); ?></td>
                            <td><?php echo htmlspecialchars($scout['LASTNAME']); ?></td>
                            <td><?php echo htmlspecialchars($scout['SCOUT_RANK']); ?></td>
                            <td><?php echo htmlspecialchars($scout['SCOUT_BIRTHDAY']); ?></td>
                            <td><?php echo is_null($scout['PARENT_FNAME']) ? 'N/A' : htmlspecialchars($scout['PARENT_FNAME']); ?></td>
                            <td><?php echo is_null($scout['PARENT_LNAME']) ? 'N/A' : htmlspecialchars($scout['PARENT_LNAME']); ?></td>
                            <td><?php echo is_null($scout['PARENTPHONE']) ? 'N/A' : htmlspecialchars($scout['PARENTPHONE']); ?></td>
                            <td class="actions">
                                <button class="edit-btn" onclick="openModal(
                                   '<?php echo htmlspecialchars($scout['SCOUTID']); ?>',
                                   '<?php echo htmlspecialchars($scout['FIRSTNAME']); ?>',
                                   '<?php echo htmlspecialchars($scout['LASTNAME']); ?>',
                                   '<?php echo htmlspecialchars($scout['SCOUT_RANK']); ?>',
                                   '<?php echo htmlspecialchars($scout['SCOUT_BIRTHDAY']); ?>'
                               )">Edit</button>
                                <button class="delete-btn" onclick="deleteScout('<?php echo htmlspecialchars($scout['SCOUTID']); ?>')">Delete</button>
                           </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No scout information available.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Edit Scout Information</h2>
            <form id="editForm" action="updateScout.php" method="post">
                <input type="hidden" id="editScoutId" name="editScoutId" value="">
                <label for="editFirstName">First Name:</label>
                <input type="text" id="editFirstName" name="editFirstName" required><br><br>
                <label for="editLastName">Last Name:</label>
                <input type="text" id="editLastName" name="editLastName" required><br><br>
                <label for="editRank">Rank:</label>
                <select id="editRank" name="editRank">
                    <?php foreach ($ranks as $rank): ?>
                        <option value="<?php echo $rank['RANKID']; ?>"><?php echo htmlspecialchars($rank['RANK_NAME']); ?></option>
                    <?php endforeach; ?>
                </select><br><br>
                <label for="editBirthday">Birthday:</label>
                <input type="date" id="editBirthday" name="editBirthday"><br><br>
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>
    <div class="popup-overlay" id="popupOverlay"></div>
    <div class="popup" id="popup">
        <img src="check.png" alt="Success" class="checkmark-icon">
        <p>Scout has been successfully removed!</p>
        <button class="close-btn" onclick="closePopup()">Return Home</button>
        <button class="refresh-btn" onclick="refreshPage()">Stay on Page</button>
    </div>
    <script src="js/viewScout.js"></script>
    <div class="viewBackground"></div>
</body>
</html>
