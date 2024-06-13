<?php
$db = new SQLite3('DatabaseCreator.db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $scout_first = $_POST['scout_first'];
    $scout_last = $_POST['scout_last'];
    $rank = $_POST['rank'];
    $scout_bday = $_POST['scout_bday'];

    $parent_first = $_POST['parent_first'];
    $parent_last = $_POST['parent_last'];
    $parent_number = $_POST['parent_number'];
    $parent_address = $_POST['parent_address'];
    $parent_state = $_POST['parent_state'];
    $parent_zip = $_POST['parent_zip'];
    $parent_relationship = $_POST['parent_relationship'];
    $parent_contact = isset($_POST['parent_contact']) ? 1 : 2;

    $parent2_first = $_POST['parent2_first_name'];
    $parent2_last = $_POST['parent2_last_name'];
    $parent2_number = $_POST['parent2_number'];
    $parent2_address = $_POST['parent2_address'];
    $parent2_state = $_POST['parent2_state'];
    $parent2_zip = $_POST['parent2_zip'];
    $parent2_relationship = $_POST['parent2_relationship'];
    $parent2_contact = isset($_POST['parent2_contact']) ? 1 : 2;

    $sql = "INSERT INTO SCOUTS (FIRSTNAME, LASTNAME, RANKID, SCOUT_BIRTHDAY) VALUES ('$scout_first', '$scout_last', '$rank', '$scout_bday')";
    $db->exec($sql);

    $scout_id = $db->lastInsertRowID();

    $sql = "INSERT INTO PARENTS (SCOUTID, PARENT_FNAME, PARENT_LNAME, PARENTPHONE, PARENTADDRESS, PARENTSTATE, PARENTZIP) VALUES ('$scout_id', '$parent_first', '$parent_last', '$parent_number', '$parent_address', '$parent_state', '$parent_zip')";
    $db->exec($sql);

    $parent_id = $db->lastInsertRowID();

    $sql = "INSERT INTO SCOUT_PARENT (PARENTID, SCOUTID, RELATIONSHIP_TYPE, CONTACT_PRIORITY) VALUES ('$parent_id', '$scout_id', '$parent_relationship', '$parent_contact')";
    $db->exec($sql);

    if (!empty($parent2_first) && !empty($parent2_last)) {
        $sql = "INSERT INTO PARENTS (SCOUTID, PARENT_FNAME, PARENT_LNAME, PARENTPHONE, PARENTADDRESS, PARENTSTATE, PARENTZIP) VALUES ('$scout_id', '$parent2_first', '$parent2_last', '$parent2_number', '$parent2_address', '$parent2_state', '$parent2_zip')";
        $db->exec($sql);

        $parent2_id = $db->lastInsertRowID();

        $sql = "INSERT INTO SCOUT_PARENT (PARENTID, SCOUTID, RELATIONSHIP_TYPE, CONTACT_PRIORITY) VALUES ('$parent2_id', '$scout_id', '$parent2_relationship', '$parent2_contact')";
        $db->exec($sql);
    }
    $response = ['success' => true];
    echo json_encode($response);
    exit();
}

$sql = "SELECT RANKID, RANK_NAME FROM RANK";
$result = $db->query($sql);

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
    <title>Information</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>Information & Details</header>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form" id="scoutForm">
            <div class="details personal">
                <span class="title">Scout Information</span>

                <div class="fields">
                    <div class="input-field">
                        <label>Scout First Name</label>
                        <input type="text" placeholder="First name" name='scout_first' required>
                    </div>
                    <div class="input-field">
                        <label>Scout Last Name</label>
                        <input type="text" placeholder="Last name" name='scout_last' required>
                    </div>
                    <div class="input-field">
                        <label>Rank</label>
                        <select id="rankDropdown" name="rank">
                            <?php foreach ($ranks as $rank): ?>
                                <option value="<?php echo $rank['RANKID']; ?>"><?php echo htmlspecialchars($rank['RANK_NAME']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-field">
                        <label>Scout Birthday</label>
                        <input type="date" placeholder="Birthday" name='scout_bday' required>
                    </div>
                </div>

                <div class="fields">
                    <div class="input-field">
                        <label>Parent First Name</label>
                        <input type="text" placeholder="First name" name="parent_first" required>
                    </div>
                    <div class="input-field">
                        <label>Parent Last Name</label>
                        <input type="text" placeholder="Last name" name="parent_last" required>
                    </div>
                    <div class="input-field">
                        <label>Parent Phone Number</label>
                        <input type="tel" placeholder="Phone Number" name="parent_number" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required>
                    </div>
                    <div class="input-field">
                        <label>Parent Address</label>
                        <input type="text" placeholder="Address" name="parent_address" required>
                    </div>
                    <div class="input-field">
                        <label>Parent State</label>
                        <input type="text" placeholder="State" name="parent_state" required>
                    </div>
                    <div class="input-field">
                        <label>Parent Zip Code</label>
                        <input type="text" placeholder="Zip" name="parent_zip" required>
                    </div>
                    <div class="input-field">
                        <label>Parent Relationship</label>
                        <input type="text" placeholder="Relationship" name="parent_relationship" required>
                    </div>
                    <div class="input-field">
                        <label for="primary-contact">Primary Contact</label>
                        <input type="checkbox" id="primary-contact" name="parent_contact">
                    </div>
                </div>

                <div class="fields">
                    <div class="input-field">
                        <label>2nd Parent First Name</label>
                        <input type="text"                     placeholder="First name" name="parent2_first_name">
                    </div>
                    <div class="input-field">
                        <label>2nd Parent Last Name</label>
                        <input type="text" placeholder="Last name" name="parent2_last_name">
                    </div>
                    <div class="input-field">
                        <label>2nd Parent Phone Number</label>
                        <input type="tel" placeholder="Phone Number" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" name="parent2_number">
                    </div>
                    <div class="input-field">
                        <label>2nd Parent Address</label>
                        <input type="text" placeholder="Address" name="parent2_address">
                    </div>
                    <div class="input-field">
                        <label>2nd Parent State</label>
                        <input type="text" placeholder="State" name="parent2_state">
                    </div>
                    <div class="input-field">
                        <label>2nd Parent Zip Code</label>
                        <input type="text" placeholder="Zip" name="parent2_zip">
                    </div>
                    <div class="input-field">
                        <label>2nd Parent Relationship</label>
                        <input type="text" placeholder="Relationship" name="parent2_relationship">
                    </div>
                    <div class="input-field">
                        <label for="primary-contact2">Primary Contact</label>
                        <input type="checkbox" id="primary-contact" name="parent2_contact">
                    </div>
                </div>
            </div>

            <div class="buttons">
                <button type="submit" class="addButton">
                    <span class="buttonText">Submit</span>
                </button>
            </div>
        </form>
    </div>
    <div class="popup-overlay" id="popupOverlay"></div>
    <div class="popup" id="popup">
        <img src="check.png" alt="Success" class="checkmark-icon">
        <p>Awards have been successfully submitted!</p>
        <button class="close-btn" onclick="closePopup()">Return Home</button>
        <button class="refresh-btn" onclick="refreshPage()">Stay on Page</button>
    </div>
    <div class="scoutBackground"></div>
    <script src="js/addScout.js"></script>
</body>
</html>

