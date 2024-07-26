<?php
session_start();

include 'includes/_config.php';
include 'includes/_functions.php';
include 'includes/_database.php';

if (!isset($_REQUEST['action'])) {
    redirectTo('index.php');
}

preventCSRF();

stripTagsArray($_REQUEST);

$name = trim($_REQUEST['name']);
$amount = trim($_REQUEST['amount']);
$date_transaction = trim($_REQUEST['date_transaction']);
$id_category = trim($_REQUEST['id_category']);

if (
    isset($_REQUEST['action'], $_REQUEST['type']) && $_REQUEST['action'] === 'create'
    && $_REQUEST['type'] === 'transaction' && $_SERVER['REQUEST_METHOD'] === 'POST'
) {
    $insert = $dbCo->prepare("INSERT INTO transaction (name, amount, date_transaction, id_category) 
            VALUES (:name, :amount, :date_transaction, :id_category)");

    $isInsertOk = $insert->execute([
        'name' => $name,
        'amount' => $amount,
        'date_transaction' => $date_transaction,
        'id_category' => $id_category ?: null
    ]);

    if ($isInsertOk) {
        addMessage('insert_ok');
    } else {
        addError('insert_ko');
    }
} else if (
    isset($_REQUEST['action'], $_REQUEST['type']) && $_REQUEST['action'] === 'modify'
    && $_REQUEST['type'] === 'transaction' && $_SERVER['REQUEST_METHOD'] === 'POST'
) {

    $insert = $dbCo->prepare("UPDATE transaction 
    SET name = :name, amount = :amount, date_transaction = :date_transaction, id_category = :id_category   
    WHERE id_transaction  = :id_transaction ;");

    $isInsertOk = $insert->execute([
        'name' => $name,
        'amount' => $amount,
        'date_transaction' => $date_transaction,
        'id_category' => $id_category ?: null
    ]);

    if ($isUpdateOk && $insert->rowCount() === 1) {
        addMessage('update_ok');
    } else {
        addError('update_ko');
    }
}
redirectTo('index.php');
?>