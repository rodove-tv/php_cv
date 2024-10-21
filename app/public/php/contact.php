<?php
$mailSen = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $subject = "demande d'aide de la part de " . $_POST["name"] . " " . $_POST["email"]; 
    $headers = "From: enzo.martinez.travail@gmail.com";

    
    if (strlen($_POST["message"]) > 1) {
        if (mail("enzo.martinez.travail@gmail.com", $subject, $_POST["message"], $headers)) {
            $mailSen = "Message envoyé avec succès.";
        } else {
            $mailSen = "Erreur lors de l'envoi du message.";
        }
    } else {
        $mailSen = "Veuillez entrer un message.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My CV</title>
    <link rel="stylesheet" href="../css/contact.css"/>
</head>
<body>
    <div class="container">
        <?php include 'header.php'; ?>
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" require/>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" require/>
            <label for="message">Message:</label>
            <textarea id="message" name="message" require></textarea>
            <button type="submit">Send</button>
        </form>
        <div id="popup" class="popup">
            <div class="popup-content">
                <span class="close">&times;</span>
                <h2>success</h2>
                <p><?= htmlspecialchars($mailSen) ?></p>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
    <script>
                    // Sélection des éléments
        const popup = document.getElementById('popup');
        const openPopupButton = document.getElementById('openPopup');
        const closePopupButton = document.querySelector('.close');
        const container = document.querySelector('.container');

        // Ouvrir le pop-up et flouter l'arrière-plan
        openPopupButton.addEventListener('click', () => {
        popup.style.display = 'flex'; // Affiche le pop-up
        container.classList.add('active-blur'); // Floute l'arrière-plan
        });

        // Fermer le pop-up et enlever le flou
        closePopupButton.addEventListener('click', () => {
        popup.style.display = 'none'; // Cache le pop-up
        container.classList.remove('active-blur'); // Retire le flou
        });

        // Fermer le pop-up si on clique en dehors du contenu
        window.addEventListener('click', (e) => {
        if (e.target === popup) {
            popup.style.display = 'none';
            container.classList.remove('active-blur');
        }
        });
    </script>
</body>
</html>