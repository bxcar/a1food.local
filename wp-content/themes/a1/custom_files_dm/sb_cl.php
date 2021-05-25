<?php
require_once("../../../../wp-load.php");

//This is a test file, production file is sberbank_callback.php

$test_field = get_field('test_field','option');

if(isset($_GET['orderNumber'])) {
    if (strpos($_GET['orderNumber'], '_') !== false) {
        $orderId = substr($_GET['orderNumber'], 0, strpos($_GET['orderNumber'], "_"));
    } else {
        $orderId = $_GET['orderNumber'];
    }

    $inf = "\r\n" . '| mdOrder: '. $_GET['mdOrder'] . ', orderNumber: ' . $orderId . ', checksum: ' . $_GET['checksum'] . ', operation: ' . $_GET['operation'] . ', status: ' . $_GET['status'];

    $test_field .= $inf;
    update_field('test_field', $test_field, 'option');
} else {
    $test_field .= ' | else case';
    update_field('test_field', $test_field, 'option');
}

if(isset($_GET['orderNumber'])
    && (($_GET['operation'] == 'deposited') || ($_GET['operation'] == 'approved'))
    && ($_GET['status'] == '1')) {
    echo  $orderId;
}
