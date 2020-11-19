<?php
require_once("../../../../wp-load.php");

if(!empty($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    if(!empty($_POST['stars'])) {
        update_field('client_feedback_stars', $_POST['stars'], $order_id);
    }

    if(!empty($_POST['feedback'])) {
        update_field('client_feedback_text', $_POST['feedback'], $order_id);
    }

    if(!empty($_FILES['file']['name'])) {

        md_support_save($order_id);

    } else {
        echo json_encode(
            [
                'success' => 'true'
            ]
        );
    }


} else {
    echo json_encode(
        [
            'success' => 'false'
        ]
    );
}


