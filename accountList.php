<?php
session_start();

include 'includes/_config.php';
include 'includes/_functions.php';
include 'includes/_database.php';
include 'includes/_template.php';

generateToken();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <!-- <ul id="errorsList" class="errors"><?php echo getHtmlErrors($errors); ?></ul>
    <ul id="messagesList" class="messages"><?php echo getHtmlMessages($messages); ?></ul> -->
    <ul id="productList">
        <?php
        $query = $dbCo->query("SELECT name, amount, date_transaction FROM transaction ORDER BY id_transaction DESC;");
        while ($product = $query->fetch()) {
            echo getHtmlProduct($product);
        }
        ?>
    </ul>
</body>
</html>