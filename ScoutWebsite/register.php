<?php
$db = new SQLite3('DatabaseCreator.db');

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (strlen($password) < 8) {
        $errorMessage = "Password must be at least 8 characters long.";
    } elseif ($password !== $confirm_password) {
        $errorMessage = "Passwords do not match.";
    } else {
        $stmt = $db->prepare("SELECT COUNT(*) AS count FROM LOGIN WHERE USERNAME = :username");
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $result = $stmt->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC);

        if ($row['count'] > 0) {
            $errorMessage = "Username already exists. Choose a different username!";
        } else {
            $stmt = $db->prepare("INSERT INTO LOGIN (USERNAME, PASSWRD) VALUES (:username, :password)");
            $stmt->bindValue(':username', $username, SQLITE3_TEXT);
            $stmt->bindValue(':password', $password, SQLITE3_TEXT); 
            $stmt->execute();

            $successMessage = "Account created successfully!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scout Database - Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <form method="post" action="">
            <h1>Scout Database</h1>
            <h2>Register for Troop 0140</h2>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="input-box">
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>
            <button type="submit" name="register" class="login">Register</button>
            <div class="accountMade">
                <p>Already have an account? <a href="home.php">Login here</a></p>
            </div>
            <?php if (!empty($errorMessage)) : ?>
                <p class="error-message"><?php echo htmlspecialchars($errorMessage); ?></p>
            <?php elseif (isset($successMessage)) : ?>
                <p class="success-message"><?php echo htmlspecialchars($successMessage); ?></p>
            <?php endif; ?>
        </form>
    </div>
    <div class="HomeBackground"></div>
</body>
</html>
