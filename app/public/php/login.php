<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: logout.php');
    exit();
}

$errorMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbPath = '../users.db';
    $db = new SQLite3($dbPath);

    if (!$db) {
        error_log("Failed to connect to the database: " . $db->lastErrorMsg());
        echo "Failed to connect to the database.";
        exit();
    }
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Validation du formulaire
    if (!empty($email) && !empty($password)) {
            // Préparer et exécuter la requête SQL
            $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
            $stmt->bindValue(':email', $email, SQLITE3_TEXT);
            $stmt->bindValue(':password', $password, SQLITE3_TEXT);
            $result = $stmt->execute();

            if ($result) {
                $user = $result->fetchArray(SQLITE3_ASSOC);
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    header('Location: cv.php');
                    exit;
                } else {
                    $errorMessage = 'Les informations envoyées ne permettent pas de vous identifier.';
                }
            } else {
                $errorMessage = 'Erreur lors de l\'exécution de la requête.';
            }
    } else {
        $errorMessage = 'Veuillez remplir tous les champs.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../../public/css/login.css" />
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>

            <a href="register.php" class="register-link ">
                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                    <path fill="#669c35" d="M15 14c-2.67 0-8 1.33-8 4v2h16v-2c0-2.67-5.33-4-8-4m-9-4V7H4v3H1v2h3v3h2v-3h3v-2m6 2a4 4 0 0 0 4-4a4 4 0 0 0-4-4a4 4 0 0 0-4 4a4 4 0 0 0 4 4" />
                </svg>
                <span>Register</span>
            </a>
       
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>


