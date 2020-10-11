<?php
require_once("../../../../wp-load.php");

if(!$_POST['save_card']) {
    echo json_encode(
        [
            'data' => 'card save field is not checked'
        ]
    );
    exit();
}

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
    (count_digit($_POST['term_value_year']) != 2) ||
    (count_digit($_POST['cvv']) != 3)) {
    echo json_encode(
        [
            'data' => 'some fields are empty or wrong'
        ]
    );
    exit();
}

$number = $_POST['card_number_1'].$_POST['card_number_2'].$_POST['card_number_3'].$_POST['card_number_4'];

if(substr($_POST['card_number_1'], 0, 1) == 2) {
    $type = 'mir';
} else if(substr($_POST['card_number_1'], 0, 1) == 4) {
    $type = 'visa';
} else if(substr($_POST['card_number_1'], 0, 1) == 5) {
    $type = 'mastercard';
} else {
    $type = false;
}

if(!$type) {
    echo json_encode(
        [
            'data' => 'wrong card type'
        ]
    );
    exit();
}

$row = array(
    'number' => $number,
    'month'   => $_POST['term_value_month'],
    'year'  => $_POST['term_value_year'],
    'name'  => $_POST['card_holder_name'],
    'cvv'  => $_POST['cvv'],
    'type'  => $type
);

//add_row('user_cards_list_field', $row, 'user_'.get_current_user_id());


echo json_encode(
    [
        'data' => $row
    ]
);
