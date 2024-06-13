<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new SQLite3('DatabaseCreator.db');

    $volunteerId = $_POST['editVolunteerId'];
    $firstName = $_POST['editFirstName'];
    $lastName = $_POST['editLastName'];
    $phone = $_POST['editPhone'];
    $address = $_POST['editAddress'];
    $state = $_POST['editState'];
    $zip = $_POST['editZIP'];

    $stmt = $db->prepare("UPDATE ADULT_VOLUNTEERS SET AVFNAME = :firstName, AVLNAME = :lastName, AVPHONE = :phone, AVADDRESS = :address, AVSTATE = :state, AVZIP = :zip WHERE ADULT_VOLID = :volunteerId");
    $stmt->bindValue(':firstName', $firstName, SQLITE3_TEXT);
    $stmt->bindValue(':lastName', $lastName, SQLITE3_TEXT);
    $stmt->bindValue(':phone', $phone, SQLITE3_TEXT);
    $stmt->bindValue(':address', $address, SQLITE3_TEXT);
    $stmt->bindValue(':state', $state, SQLITE3_TEXT);
    $stmt->bindValue(':zip', $zip, SQLITE3_TEXT);
    $stmt->bindValue(':volunteerId', $volunteerId, SQLITE3_INTEGER);
    $stmt->execute();

    header('Location: volunteer.php');
    exit();
}
