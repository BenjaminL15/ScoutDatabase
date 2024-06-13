<?php

$db = new SQLite3('DatabaseCreator.db');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="forgot">
                <a href="#">Forgot Password?</a>
            </div>
    
            <button type="submit" class="login">Login</button>
    
            <div class="register">
                <p><a href="#">Register</a> for Scouts!</p>
            </div>
    
            <?php if(isset($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
        </form>
        
    </div>
    <div class="HomeBackground"></div>
</body>
</html>

