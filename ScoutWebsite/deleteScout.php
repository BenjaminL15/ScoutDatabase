<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['scoutId'])) {
    $scoutId = $_POST['scoutId'];

    $db = new SQLite3('DatabaseCreator.db');
    $db->exec('BEGIN'); 

    $stmt1 = $db->prepare('DELETE FROM SCOUT_PARENT WHERE SCOUTID = :scoutId');
    $stmt1->bindValue(':scoutId', $scoutId, SQLITE3_INTEGER);
    $result1 = $stmt1->execute();

    $stmt2 = $db->prepare('DELETE FROM PARENTS WHERE PARENTID NOT IN (SELECT PARENTID FROM SCOUT_PARENT)');
    $result2 = $stmt2->execute();

    $stmt3 = $db->prepare('DELETE FROM SCOUTS WHERE SCOUTID = :scoutId');
    $stmt3->bindValue(':scoutId', $scoutId, SQLITE3_INTEGER);
    $result3 = $stmt3->execute();

    if ($result1 && $result2 && $result3) {
        $db->exec('COMMIT'); 
        echo 'Success';
    } else {
        $db->exec('ROLLBACK'); 
        echo 'Error';
    }
} else {
    echo 'Invalid request';
}

