<?php
session_start();

include 'includes/_config.php';
include 'includes/_functions.php';
include 'includes/_database.php';

if (!isset($_POST['action']) || $_POST['action'] !== 'delete') {
    redirectTo('index.php');
}

stripTagsArray($_POST);
preventCSRF();

$id_transaction = trim($_POST['id_transaction']);

if (!is_numeric($id_transaction)) {
    addError('user_delete_ko');
    redirectTo('index.php');
}

$query = $dbCo->prepare("DELETE FROM transaction WHERE id_transaction = :id_transaction");
$isDeleteOk = $query->execute(['id_transaction' => intval($id_transaction)]);

if ($isDeleteOk) {
    addMessage('user_delete_ok');
} else {
    addError('user_delete_ko');
}

redirectTo('index.php');
?>