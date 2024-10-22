# PHP Application CV with Docker

This project aims to explore the PHP language. It involves setting up a website for user management (login and logout). Each user can have one or more resumes associated with their account and also has the ability to add projects.

## How to launch the project?
Clone the repository https://github.com/rodove-tv/php_cv.git.
Add the app/public/setup.php file

<?php
$db = new SQLite3('users.db');
$sql = "
[Add your database here.]
";
$db->exec($sql);
?>

Next, run the command:
*cd app/public/
$php setup.php

Go to the Docker file and enter:
$docker compose up --build -d

Finally, go to 127.0.0.1 URL

And enjoy your experience.

## Features of each page

### Index
Home page.

### CV
Main page that allows the user to edit their CV and also preview it.

### Login
Allows the user to log in and log out for now.

### Profile
Allows the user to view their personal information (with the ability to edit it).

## Tasks in the project.

- [x] GitHub
- [x] Add ALL page
