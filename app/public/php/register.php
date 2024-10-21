<?php
/*if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dbPath = '../users.db';
    $db = new SQLite3($dbPath);


    if (!$db) {
        error_log("Failed to connect to the database: " . $db->lastErrorMsg());
        echo "Failed to connect to the database.";
        exit();
    }

    $username = $_POST['username'];
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirmePassword = $_POST['confirmePassword'];

    // Vérifier si l'email existe déjà dans la base de données
    $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();
    $existingUser = $result->fetchArray(SQLITE3_ASSOC);

    if ($existingUser) {
        $errorMessage = 'Email existant.';
    } else {
    if ($password != $confirmePassword) {
        $error = 'Les mots de passe ne correspondent pas.';
    } else {
        // Hacher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        // Continuer avec l'enregistrement de l'utilisateur
        $stmt = $db->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':password', $hashedPassword, SQLITE3_TEXT);
        $stmt->execute();
        $stmt->close();
        $db->close();
        header('Location: login.php');
        exit;
    }
    }
}*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dbPath = '../users.db';
    $db = new SQLite3($dbPath);


    if (!$db) {
        error_log("Failed to connect to the database: " . $db->lastErrorMsg());
        echo "Failed to connect to the database.";
        exit();
    }

    $username = $_POST['username'];
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmePassword'];


    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "All fields are required!";
    } elseif ($password !== $confirm_password) {
        echo "Passwords do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $db->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
       
        if (!$stmt) {
            error_log("Failed to prepare statement: " . $db->lastErrorMsg());
            echo "Failed to prepare statement.";
            exit();
        }

        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':password', $hashed_password, SQLITE3_TEXT);
        $result = $stmt->execute();
        if ($result) {
            echo "Registration successful!";
        } else {
            error_log("Failed to execute statement: " . $db->lastErrorMsg());
            echo "Registration failed!";
        }


        $stmt->close();
    }


    $db->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" type="text/css" href="../../public/css/register.css" />
</head>
<body>
    <?php include 'header.php'; ?>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <div class="register-container">
        <h2>Sign In</h2>
        <form action="" method="post">
            <input type="text" name="username" placeholder="User name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirmePassword" placeholder="Confirme Password" required>
            <input type="submit" value="Register">
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>