<?php

$db = new SQLite3('DatabaseCreator.db');

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'login') {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM LOGIN WHERE USERNAME=:username AND PASSWRD=:password";
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':password', $password, SQLITE3_TEXT);

        $result = $stmt->execute();

        if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            header("Location: welcomePage.php");
            exit;
        } else {
            $error_message = "Incorrect username or password.";
        }
    } elseif (isset($_POST['action']) && $_POST['action'] == 'reset_password') {
        $reset_username = $_POST["reset_username"];
        $new_password = $_POST["new_password"];

        $check_sql = "SELECT COUNT(*) AS count FROM LOGIN WHERE USERNAME=:username";
        $check_stmt = $db->prepare($check_sql);
        $check_stmt->bindValue(':username', $reset_username, SQLITE3_TEXT);
        $check_result = $check_stmt->execute();
        $row = $check_result->fetchArray(SQLITE3_ASSOC);

        if ($row['count'] > 0) {
            $sql = "UPDATE LOGIN SET PASSWRD=:password WHERE USERNAME=:username";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':username', $reset_username, SQLITE3_TEXT);
            $stmt->bindValue(':password', $new_password, SQLITE3_TEXT);

            $result = $stmt->execute();

            if ($result) {
                header("Location: welcomePage.php");
                exit;
            } else {
                $error_message = "Error updating password.";
            }
        } else {
            $error_message = "Username does not exist.";
        }
    }
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scout Database</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <h1>Scout Database</h1>
        <h2>Troop 0140</h2>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="action" value="login">
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="forgot">
                <a href="#" onclick="openPopup()">Forgot Password?</a>
            </div>
    
            <button type="submit" class="login">Login</button>
    
            <div class="register">
                <p><a href="register.php">Register</a> for Scouts!</p>
            </div>
    
            <?php if(isset($error_message) && !empty($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
        </form>
        <div id="forgotPasswordPopup" class="popup">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="popup-content">
                <input type="hidden" name="action" value="reset_password">
                <span onclick="closePopup()" class="close">&times;</span>
                <h2>Reset Password</h2>
                <div class="input-box">
                    <input type="text" name="reset_username" placeholder="Username" required>
                </div>
                <div class="input-box">
                    <input type="password" name="new_password" placeholder="New Password" required>
                </div>
                <button type="submit" class="login">Reset Password</button>
                <?php if(isset($error_message) && !empty($error_message)): ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="HomeBackground"></div>
    <script src="js/homePage.js"></script>
</body>
</html>
