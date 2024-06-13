<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['volunteerId'])) {
    $volunteerId = $_POST['volunteerId'];

    $db = new SQLite3('DatabaseCreator.db');
    if (!$db) {
        die('Failed to connect to database');
    }

    $db->exec('BEGIN');

    $stmt1 = $db->prepare('DELETE FROM ADULT_VOLUNTEERS WHERE ADULT_VOLID = :volunteerId');
    $stmt1->bindValue(':volunteerId', $volunteerId, SQLITE3_INTEGER);
    $result1 = $stmt1->execute();

    if ($result1) {
        $db->exec('COMMIT');
        echo 'Success';
    } else {
        $db->exec('ROLLBACK');
        echo 'Error';
    }
} else {
    echo 'Invalid request';
}
