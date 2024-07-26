<?php
session_start();

include 'includes/_config.php';
include 'includes/_functions.php';
include 'includes/_database.php';

if (!isset($_POST['action']) || $_POST['action'] !== 'edit') {
    addError('no_action');
    redirectTo('index.php');
}

try {
    preventCSRF();
} catch (Exception $e) {
    addError('csrf');
    redirectTo('index.php');
}

stripTagsArray($_POST);

$id_transaction = intval($_POST['id_transaction']);
$name = trim($_POST['name']);
$amount = trim($_POST['amount']);
$date_transaction = trim($_POST['date_transaction']);
$id_category = trim($_POST['id_category']);

$update = $dbCo->prepare("UPDATE transaction SET name = :name, amount = :amount, date_transaction = :date_transaction, id_category = :id_category WHERE id_transaction = :id_transaction");

$isUpdateOk = $update->execute([
    'name' => $name,
    'amount' => $amount,
    'date_transaction' => $date_transaction,
    'id_category' => $id_category ?: null,
    'id_transaction' => $id_transaction
]);

if ($isUpdateOk) {
    addMessage('update_ok');
} else {
    addError('update_ko');
}

redirectTo('index.php');
