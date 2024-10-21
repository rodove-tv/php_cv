<?php
// cv.php

// Démarrer la session pour accéder aux variables de session
session_start();

// Vérifier si les informations personnelles et les préférences de style sont définies dans la session
$nom = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Nom par défaut';
$prenom = isset($_SESSION['prenom']) ? $_SESSION['prenom'] : 'Prénom par défaut';
$paragraphe = isset($_SESSION['paragraphe']) ? $_SESSION['paragraphe'] : 'Paragraphe par défaut';
$couleurTexte = isset($_SESSION['couleurTexte']) ? $_SESSION['couleurTexte'] : '#000000';
$couleurFond = isset($_SESSION['couleurFond']) ? $_SESSION['couleurFond'] : '#FFFFFF';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV</title>
    <style>
        body {
            background-color: <?php echo htmlspecialchars($couleurFond); ?>;
            color: <?php echo htmlspecialchars($couleurTexte); ?>;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div id="contain_cv">
        <h1>CV de <?php echo htmlspecialchars($prenom) . ' ' . htmlspecialchars($nom); ?></h1>
        <p><?php echo nl2br(htmlspecialchars($paragraphe)); ?></p>
        <a href="edit_cv.php">Modifier le CV</a>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>