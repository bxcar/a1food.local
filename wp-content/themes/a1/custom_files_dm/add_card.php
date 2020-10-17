<?php
require_once("../../../../wp-load.php");

function count_digit($number) {
    return strlen($number);
}

if(!$_POST['card_number_1'] ||
    !$_POST['card_number_2'] ||
    !$_POST['card_number_3'] ||
    !$_POST['card_number_4'] ||
    !$_POST['term_value_month'] ||
    !$_POST['term_value_year'] ||
    !$_POST['card_holder_name'] ||
    !$_POST['cvv'] ||
    (count_digit($_POST['card_number_1']) != 4) ||
    (count_digit($_POST['card_number_2']) != 4) ||
    (count_digit($_POST['card_number_3']) != 4) ||
    (count_digit($_POST['card_number_4']) != 4) ||
    (count_digit($_POST['term_value_month']) != 2) ||
    ($_POST['term_value_month'] > 12 ) ||
    ($_POST['term_value_month'] <  1 ) ||
    (count_digit($_POST['term_value_year']) != 2) ||
    ($_POST['term_value_year'] < 20) ||
    (count_digit($_POST['cvv']) != 3)) {
    echo json_encode(
        [
            'data' => 'Ошибка: некоторые поля пустые либо заполнены неверно'
        ]
    );
    exit();
}

if(substr($_POST['card_number_1'], 0, 1) == 2) {
    $type = 'mir';
} else if(substr($_POST['card_number_1'], 0, 1) == 4) {
    $type = 'visa';
} else if(substr($_POST['card_number_1'], 0, 1) == 5) {
    $type = 'mc';
} else {
    $type = false;
}

if(!$type) {
    echo json_encode(
        [
            'data' => 'Ошибка: некорректный номер карты'
        ]
    );
    exit();
}

if(!$_POST['save_card']) {
    echo json_encode(
        [
            'data' => 'success'
        ]
    );
    exit();
}

$number = $_POST['card_number_1'].$_POST['card_number_2'].$_POST['card_number_3'].$_POST['card_number_4'];

if(get_field('user_cards_list_field', 'user_'.get_current_user_id())) {
    foreach (get_field('user_cards_list_field', 'user_'.get_current_user_id()) as $item) {
        if($item['number'] == $number) {
            echo json_encode(
                [
                    'data' => 'success'
                ]
            );
            exit();
        }
    }
}

$row = array(
    'number' => $number,
    'month'   => $_POST['term_value_month'],
    'year'  => $_POST['term_value_year'],
    'name'  => $_POST['card_holder_name'],
    'cvv'  => $_POST['cvv'],
    'type'  => $type
);

add_row('user_cards_list_field', $row, 'user_'.get_current_user_id());


echo json_encode(
    [
        'data' => 'success'
    ]
);
