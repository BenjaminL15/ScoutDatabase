<?php
$db = new SQLite3('DatabaseCreator.db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $volfirst = $_POST['vol_first'];
    $vollast = $_POST['vol_last'];
    $volphone = $_POST['vol_phone'];
    $voladdress = $_POST['vol_address'];
    $volstate = $_POST['vol_state'];
    $volzip = $_POST['vol_zip'];

    $parentID = null;
    $counselorID = null;

    if (isset($_POST['vol_parent']) && $_POST['vol_parent'] === 'on') {
        $stmt = $db->prepare('SELECT PARENTID FROM PARENTS WHERE PARENT_FNAME = :volfirst AND PARENT_LNAME = :vollast');
        $stmt->bindValue(':volfirst', $volfirst, SQLITE3_TEXT);
        $stmt->bindValue(':vollast', $vollast, SQLITE3_TEXT);
        $result = $stmt->execute();
        $parent = $result->fetchArray(SQLITE3_ASSOC);

        if ($parent) {
            $parentID = $parent['PARENTID'];
        }
    }

    if (isset($_POST['vol_counselor']) && $_POST['vol_counselor'] === 'on') {
        $stmt = $db->prepare('SELECT COUNSELOR_ID FROM MERITBADGE_COUNSELOR WHERE COUNSELOR_FNAME = :volfirst AND COUNSELOR_LNAME = :vollast');
        $stmt->bindValue(':volfirst', $volfirst, SQLITE3_TEXT);
        $stmt->bindValue(':vollast', $vollast, SQLITE3_TEXT);
        $result = $stmt->execute();
        $counselor = $result->fetchArray(SQLITE3_ASSOC);

        if ($counselor) {
            $counselorID = $counselor['COUNSELOR_ID'];
        }
    }

    $stmt = $db->prepare('INSERT INTO ADULT_VOLUNTEERS (PARENTID, COUNSELOR_ID, AVFNAME, AVLNAME, AVPHONE, AVADDRESS, AVSTATE, AVZIP) 
                          VALUES (:parentID, :counselorID, :volfirst, :vollast, :volphone, :voladdress, :volstate, :volzip)');
    $stmt->bindValue(':parentID', $parentID, SQLITE3_INTEGER);
    $stmt->bindValue(':counselorID', $counselorID, SQLITE3_INTEGER);
    $stmt->bindValue(':volfirst', $volfirst, SQLITE3_TEXT);
    $stmt->bindValue(':vollast', $vollast, SQLITE3_TEXT);
    $stmt->bindValue(':volphone', $volphone, SQLITE3_TEXT);
    $stmt->bindValue(':voladdress', $voladdress, SQLITE3_TEXT);
    $stmt->bindValue(':volstate', $volstate, SQLITE3_TEXT);
    $stmt->bindValue(':volzip', $volzip, SQLITE3_TEXT);
    $stmt->execute();


    $response = ['success' => true];
    echo json_encode($response);
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Volunteer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>Volunteer Information</header>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form" id="volunteerForm">
            <div class="form first">
                <div class="details volunteer">
                    <span class="title">Volunteer Details</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>First Name</label>
                            <input type="text" placeholder="First name" name = "vol_first" required>
                        </div>
                        <div class="input-field">
                            <label>Last Name</label>
                            <input type="text" placeholder="Last name" name = "vol_last" required>
                        </div>
                        <div class="input-field">
                            <label>Phone Number</label>
                            <input type="tel" placeholder="Phone Number" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" name = "vol_phone" required>
                        </div>
                        <div class="input-field">
                            <label>Address</label>
                            <input type="text" placeholder="Address" name = "vol_address" required>
                        </div>
                        <div class="input-field">
                            <label>State</label>
                            <input type="text" placeholder="State" name = "vol_state" required>
                        </div>
                        <div class="input-field">
                            <label>Zip Code</label>
                            <input type="text" placeholder="Zip" name = "vol_zip" required>
                        </div>
                        <div class="input-field">
                            <label for="parent">Parent</label>
                            <input type="checkbox" id="parent" name = "vol_parent">
                        </div>
                        <div class="input-field">
                            <label for="counselor">Merit Badge Counselor</label>
                            <input type="checkbox" id="counselor" name = "vol_counselor">
                        </div>
                    </div>
                    <button type="submit" class="addButton">
                        <span class="buttonText">Submit</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="popup-overlay" id="popupOverlay"></div>
    <div class="popup" id="popup">
        <img src="check.png" alt="Success" class="checkmark-icon">
        <p>Volunteers have been successfully submitted!</p>
        <button class="close-btn" onclick="closePopup()">Return Home</button>
        <button class="refresh-btn" onclick="refreshPage()">Stay on Page</button>
    </div>
    <script src="js/addVolunteer.js"></script>
    <div class="volunteerBack"></div>
</body>
</html>
