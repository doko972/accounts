<?php

function getHtmlProduct(array $product): string
{
    return '<tr>'
    . '<td width="50" class="ps-3">'
    . '</td>'
    . '<td>'
    . '<time datetime="' . $product['date_transaction'] 
    . '" class="d-block fst-italic fw-light">'
    . $product['date_transaction'] . '</time>'
    . $product['name']
    . '</td>'
    . '<td class="text-end">'
    . '<span class="rounded-pill text-nowrap bg-warning-subtle px-2">'
    . $product['amount'] . '€'
    . '</span>'
    . '</td>'
    . '<td class="text-end text-nowrap">'
    . '<a href="edit.php?id_transaction=' . $product['id_transaction'] 
    . '" class="btn btn-outline-primary btn-sm rounded-circle">'
    . '<i class="bi bi-pencil"></i>'
    . '</a>'
    . '<form action="delete.php" method="post" style="display:inline;">'
    . '<input type="hidden" name="action" value="delete">'
    . '<input type="hidden" name="id_transaction" value="' . $product['id_transaction'] . '">'
    . '<input type="hidden" name="token" value="' . $_SESSION['token'] . '">'
    . '<button type="submit" class="btn btn-outline-danger btn-sm rounded-circle">'
    . '<i class="bi bi-trash"></i>'
    . '</button>'
    . '</form>'
    . '</td>'
    . '</tr>';
}


