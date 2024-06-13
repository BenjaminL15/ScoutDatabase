<?php
$db = new SQLite3('DatabaseCreator.db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $volfirst = $_POST['vol_first'];
    $vollast = $_POST['vol_last'];
    $volphone = $_POST['vol_phone'];
    $voladdress = $_POST['vol_address'];
    $volstate = $_POST['vol_state'];
    $volzip = $_POST['vol_zip'];

    $db->exec("INSERT INTO ADULT_VOLUNTEERS(AVFNAME, AVLNAME, AVPHONE, AVADDRESS, AVSTATE, AVZIP) VALUES ($volfirst, $vollast, $volphone, $voladdress, $volstate, $volzip)");
    $volID = $db->lastInsertRowID();
    echo json_encode(['success' => true]);
    exit();
}


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
        <form action="#">
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
                    <button class="submitButton">
                        <span class="buttonText">Submit</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script src="addVolunteer.js"></script>
    <div class="volunteerBack"></div>
</body>
</html>
