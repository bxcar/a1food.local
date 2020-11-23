<?php
require_once("../../../../wp-load.php");

/*$data = '{
    "queue": "Feedback",
    "type": "rabotaSOtzyvom",
    "summary": "Отзыв на заказ #3333333345-62",
    "assignee": "1130000045778264",
    "project": "A1EDA",
    "components": "★★★★ – 4",
    "tags": "3333333345",
    "description": "Текстовое описание тест \r\n \r\n Ссылка на загруженный покупателем файл: a1eda.ru/wp-content/uploads/2020/11/popup.png"
}';*/



if(!empty($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    $data = array();
    $data['queue'] = 'Feedback';
    $data['type'] = 'rabotaSOtzyvom';
    $data['assignee'] = '1130000045778264';
    $data['project'] = 'A1EDA';

    $user_phone = get_field('user_phone_field', 'user_' . get_current_user_id());
    $user_phone = preg_replace('/[^0-9]/', '', $user_phone);
    $user_phone = substr($user_phone, 1);
    $order_number = $user_phone . '-' . get_field('order_number_for_current_customer', $order_id);

    $data['summary'] = 'Отзыв на заказ #'.$order_number;
    $data['tags'] = "$user_phone";


    if(!empty($_POST['stars'])) {
        update_field('client_feedback_stars', $_POST['stars'], $order_id);

        if($_POST['stars'] == 1) {
            $data['components'] = '★ – 1';
        } else if($_POST['stars'] == 2) {
            $data['components'] = '★★ – 2';
        } else if($_POST['stars'] == 3) {
            $data['components'] = '★★★ – 3';
        } else if($_POST['stars'] == 4) {
            $data['components'] = '★★★★ – 4';
        } else if($_POST['stars'] == 5) {
            $data['components'] = '★★★★★ – 5';
        }

    }

    if(!empty($_POST['feedback'])) {
        update_field('client_feedback_text', $_POST['feedback'], $order_id);
        $data['description'] = $_POST['feedback'];
    }

    if(!empty($_FILES['file']['name'])) {
        if(!empty(md_support_save($order_id))) {
            $file = get_field('client_feedback_file', $order_id);
            $file = str_replace("https://", "",$file);
            $data['description'] .= " \r\n \r\n Ссылка на загруженный покупателем файл: $file";
        }
    }

    $data =  json_encode($data);

    if(!empty($_POST['stars'])) {
        $curl = curl_init('https://api.tracker.yandex.net/v2/issues/');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: OAuth AgAEA7qjRwL_AAa2-6H6eWinZUXYqWS2_Nn2Nx4',
            'X-Org-ID: 4156707',
            'Cache-Control: no-cache',
            'Content-Type:application/json'
        ));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt( $curl, CURLOPT_POSTFIELDS, $data );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $response = json_decode($response);
        curl_close($curl);

        echo json_encode(
            [
                'success' => 'true'
            ]
        );
    } else {
        echo json_encode(
            [
                'success' => 'false'
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


