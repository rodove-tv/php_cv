<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>logout</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/logout.css" />
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="contener">
            <form method="post">
                <button type="submit" name="logout" class="disconnect_button">Disconnect</button>
            </form>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>
