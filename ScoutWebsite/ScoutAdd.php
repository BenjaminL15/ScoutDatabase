<?php
$db = new SQLite3('DatabaseCreator.db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $scoutfirst = $_POST['scout_first'];
    $scoutlast = $_POST['scout_last'];
    $scoutbday = $_POST['scout_bday'];
    
    $parentfirst = $_POST['parent_first'];
    $parentlast = $_POST['parent_last'];
    $parentnumber = $_POST['parent_number'];
    $parentaddress = $_POST['parent_address'];
    $parentstate = $_POST['parent_state'];
    $parentzip = $_POST['parent_zip'];
    $parentrelationship = $_POST['parent_relationship'];
    $parentcontact = $_POST['parent_contact'];

    $parent2first = $_POST['parent2_first_name'];
    $parent2last = $_POST['parent2_last_name'];
    $parent2number = $_POST['parent2_number'];
    $parent2address = $_POST['parent2_address'];
    $parent2state = $_POST['parent2_state'];
    $parent2zip = $_POST['parent2_zip'];
    $parent2relationship = $_POST['parent2_relationship'];
    $parent2contact = $_POST['parent2_contact'];

    // Scout
    $db->exec("INSERT INTO SCOUTS (FIRSTNAME, LASTNAME, SCOUT_BIRTHDAY) VALUES ('$scoutfirst, $scoutlast, $scoutbday')");
    $scoutID = $db->lastInsertRowID();

    // Parent 1
    $db->exec("INSERT INTO PARENTS (SCOUTID, PARENT_FNAME, PARENT_LNAME, PARENTPHONE, PARENTADDRESS, PARENTSTATE, PARENTZIP) VALUES ($scoutID, '$parentfirst', '$parentlast', '$parentnumber', '$parentaddress', '$parentstate', '$parentzip', '$parentrelationship', '$parentcontact')");
    $parentID = $db->lastInsertRowID();
    $db->exec("INSERT INTO SCOUTS (PARENTID, SCOUTID, RELATIONSHIP_TYPE, CONTACT_PRIORITY) VALUES ($parentID, $scoutID, $parentrelationship, $parentcontact)");

    // Parent 2
    $db->exec("INSERT INTO PARENTS (SCOUTID, PARENT_FNAME, PARENT_LNAME, PARENTPHONE, PARENTADDRESS, PARENTSTATE, PARENTZIP) VALUES ($scoutID, '$parent2first', '$parent2last', '$parent2number', '$parent2address', '$parent2state', '$parent2zip', '$parent2relationship', '$parent2contact')");
    $parent2ID = $db->lastInsertRowID();
    $db->exec("INSERT INTO SCOUTS (PARENTID, SCOUTID, RELATIONSHIP_TYPE, CONTACT_PRIORITY) VALUES ($parent2ID, $scoutID, $parent2relationship, $parent2contact)");
    echo json_encode(['success' => true]);
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

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form">
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
    <div class="scoutBackground"></div>
    <script src="addScout.js"></script>
</body>
</html>

