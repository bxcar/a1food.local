<?php
require_once("../../../../wp-load.php");

// Create a stream
/*$opts = array(
    'http'=>array(
        'method'=>"GET /v2/myself",
        'header'=> "Authorization: OAuth AgAEA7qjRwL_AAa2-6H6eWinZUXYqWS2_Nn2Nx4\r\n" .
            "X-Org-ID: 4156707\r\n"
    )
);

$context = stream_context_create($opts);

// Open the file using the HTTP headers set above
$file = file_get_contents('https://api.tracker.yandex.net', false, $context);

print_r($file);*/

//$response = curl_getinfo( $ch );
// convert response
//$output = json_decode($response);
// handle error; error output
/*if(curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {

    var_dump($output);
}*/


// make request
/*$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.tracker.yandex.net/v2/myself");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: OAuth AgAEA7qjRwL_AAa2-6H6eWinZUXYqWS2_Nn2Nx4',
    'X-Org-ID: 4156707'
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$content = curl_exec( $ch );
$data = json_decode($content );
curl_close($ch);

print_r($data);*/

$data = '{
    "queue": "Feedback",
    "type": "rabotaSOtzyvom",
    "summary": "Отзыв на заказ #3333333345-62",
    "assignee": "1130000045778264",
    "project": "A1EDA",
    "components": "★★★★ – 4",
    "tags": "3333333345",
    "description": "Текстовое описание тест \r\n \r\n Ссылка на загруженный покупателем файл: a1eda.ru/wp-content/uploads/2020/11/popup.png"
}';
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

print_r($response);



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
    /*echo json_encode(
        [
            'success' => 'false'
        ]
    );*/
}


