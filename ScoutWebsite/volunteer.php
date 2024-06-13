<?php
    $db = new SQLite3('DatabaseCreator.db');
    
    $sql = "SELECT ADULT_VOLID, AVFNAME, AVLNAME, AVPHONE, AVADDRESS, AVSTATE, AVZIP,
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
                    <th>Actions</th> 
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
                            <td class="actions">
                                <button class="edit-btn" onclick="openVolunteerModal(
                                   '<?php echo htmlspecialchars($volunteer['ADULT_VOLID']); ?>',
                                   '<?php echo htmlspecialchars($volunteer['AVFNAME']); ?>',
                                   '<?php echo htmlspecialchars($volunteer['AVLNAME']); ?>',
                                   '<?php echo htmlspecialchars($volunteer['AVPHONE']); ?>',
                                   '<?php echo htmlspecialchars($volunteer['AVADDRESS']); ?>',
                                   '<?php echo htmlspecialchars($volunteer['AVSTATE']); ?>',
                                   '<?php echo htmlspecialchars($volunteer['AVZIP']); ?>'
                               )">Edit</button>
                                <button class="delete-btn" onclick="confirmDeleteVolunteer('<?php echo htmlspecialchars($volunteer['ADULT_VOLID']); ?>')">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">No volunteer information available.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeVolunteerModal()">&times;</span>
            <h2>Edit Volunteer Information</h2>
            <form id="editForm" action="updateVolunteer.php" method="post">
                <input type="hidden" id="editVolunteerId" name="editVolunteerId" value="">
                <label for="editFirstName">First Name:</label>
                <input type="text" id="editFirstName" name="editFirstName" required><br><br>
                <label for="editLastName">Last Name:</label>
                <input type="text" id="editLastName" name="editLastName" required><br><br>
                <label for="editPhone">Phone Number:</label>
                <input type="text" id="editPhone" name="editPhone"><br><br>
                <label for="editAddress">Address:</label>
                <input type="text" id="editAddress" name="editAddress"><br><br>
                <label for="editState">State:</label>
                <input type="text" id="editState" name="editState"><br><br>
                <label for="editZIP">ZIP:</label>
                <input type="text" id="editZIP" name="editZIP"><br><br>
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>
    <div class="popup-overlay" id="popupOverlay"></div>
    <div class="popup" id="popup">
        <img src="check.png" alt="Success" class="checkmark-icon">
        <p>Volunteer has been successfully removed!</p>
        <button class="close-btn" onclick="closePopup()">Return Home</button>
        <button class="refresh-btn" onclick="refreshPage()">Stay on Page</button>
    </div>
    <div class="popup-overlay" id="confirmPopupOverlay"></div>
    <div class="popup" id="confirmPopup">
        <p>Are you sure you want to delete this volunteer?</p>
        <button class="confirm-btn" onclick="deleteVolunteer()">Yes</button>
        <button class="cancel-btn" onclick="closeConfirmPopup()">No</button>
    </div>
    <script src="js/viewVolunteer.js"></script>
    <div class="viewBackground"></div>
</body>
</html>

