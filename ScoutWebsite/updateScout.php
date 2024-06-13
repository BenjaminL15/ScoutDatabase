<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new SQLite3('DatabaseCreator.db');

    $scoutId = $_POST['editScoutId'];
    $firstName = $_POST['editFirstName'];
    $lastName = $_POST['editLastName'];
    $rank = $_POST['editRank'];
    $birthday = $_POST['editBirthday'];

    $stmt = $db->prepare("UPDATE SCOUTS SET FIRSTNAME = :firstName, LASTNAME = :lastName, RANKID = :rank, SCOUT_BIRTHDAY = :birthday WHERE SCOUTID = :scoutId");
    $stmt->bindValue(':firstName', $firstName, SQLITE3_TEXT);
    $stmt->bindValue(':lastName', $lastName, SQLITE3_TEXT);
    $stmt->bindValue(':rank', $rank, SQLITE3_INTEGER); 
    $stmt->bindValue(':birthday', $birthday, SQLITE3_TEXT);
    $stmt->bindValue(':scoutId', $scoutId, SQLITE3_INTEGER);
    $stmt->execute();

    header('Location: viewScout.php');
    exit();
}
?>
