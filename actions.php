<?php

// SELECT `id_transaction`, `name`, `amount`, `date_transaction`, `id_category` FROM `transaction` WHERE 1
session_start();

include 'includes/_config.php';
include 'includes/_functions.php';
include 'includes/_database.php';

preventCSRF();