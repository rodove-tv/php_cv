<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My CV</title>
    <link rel="stylesheet" href="../css/contact.css"/>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'menu.php'; ?>
    <form>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"/>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"/>
        <label for="message">Message:</label>
        <textarea id="message" name="message"></textarea>
        <button type="submit">Send</button>
    </form>
    <?php include 'footer.php'; ?>
</body>
</html>