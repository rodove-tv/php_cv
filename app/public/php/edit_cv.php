<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit CV</title>
    <style>
        #cv-preview {
            width: 50%;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 20px;
            background-color: white;
        }
        .color-picker {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .color-picker input {
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div id="cv-preview">
            <?php
            $dom = new DOMDocument();
            $dom->loadHTMLFile('cv.php');
            $containCv = $dom->getElementById('contain_cv');
            if ($containCv) {
                echo $dom->saveHTML($containCv);
            } else {
                echo "Content not found.";
            }
            ?>
    </div>
    <form action="edit_cv.php" method="post" class="color-picker">
        <label for="bg-color">Background Color: </label>
        <input type="color" id="bg-color" name="bg-color" value="#ffffff">
        <button type="submit">Save</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bg-color'])) {
        $bgColor = $_POST['bg-color'];
        echo "<script>
                document.getElementById('cv-preview').style.backgroundColor = '$bgColor';
              </script>";
    }
    ?> 

    <script>
        document.getElementById('bg-color').addEventListener('input', function() {
            document.getElementById('cv-preview').style.backgroundColor = this.value;
        });
    </script>
    <?php include 'footer.php'; ?>
</body>
</html>