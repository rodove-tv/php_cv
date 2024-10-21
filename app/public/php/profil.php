<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$dbPath = '../users.db';
$db = new SQLite3($dbPath);

if (!$db) {
    error_log("Failed to connect to the database: " . $db->lastErrorMsg());
    echo "Failed to connect to the database.";
    exit();
}

$query = $db->prepare("SELECT username, email FROM users WHERE id = :id");
$query->bindValue(':id', $user_id, SQLITE3_INTEGER);
$result = $query->execute();
if ($result) {
    $user = $result->fetchArray(SQLITE3_ASSOC);
    if ($user) {
        $username = $user['username'];
        $email = $user['email'];
    } else {
        header('Location: login.php');
        exit();
    }
} else {
    echo "Failed to execute query.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="../../public/css/profil.css" />
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="contener">
        <h1>Profil de <?= $username; ?></h1>
        <p>Email: <?= $email; ?></p>
        <img src="../../public/resource/imgClien/bob.jpg" alt="Photo de profil"/>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>