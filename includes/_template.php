<?php

function getHtmlProduct(array $product): string
{
    // . ' <a href="index.php?action=edit_product&id=' . $product['id'] . '">🖋️</a> '
    // . ' <a href="delete.php?action=delete&type=product&id=' . $product['id'] . '&token=' . $_SESSION['token'] . '">🗑️</a>';
    return '<tbody>'
        . '<tr>'
        . '<td width="50" class="ps-3">'
        . '</td>'
        . '<td>'
        . '<time datetime="2023-07-10" class="d-block fst-italic fw-light">' . $product['date_transaction'] . '</time>'
        . $product['name']
        . '</td>'
        . '<td class="text-end">'
        . '<span class="rounded-pill text-nowrap bg-warning-subtle px-2">'
        . $product['amount'] . '€'
        . '</span>'
        . '</td>'
        . '<td class="text-end text-nowrap">'
        . '<a href="#" class="btn btn-outline-primary btn-sm rounded-circle">'
        . '<i class="bi bi-pencil"></i>'
        . '</a>'
        . '<a href="#" class="btn btn-outline-danger btn-sm rounded-circle">'
        . '<i class="bi bi-trash"></i>'
        . '</a>'
        . '</td>'
        . '</tr>'
        . '</tbody>';
}

