<?php
require_once 'smpp/smppclient.class.php';
require_once 'smpp/gsmencoder.class.php';
require_once 'smpp/sockettransport.class.php';

$code = $_POST['code'];
$phone = $_POST['phone'];

// Construct transport and client
$transport = new SocketTransport(array('smpp.smsaero.ru'),2775);
$transport->setRecvTimeout(10000);
$smpp = new SmppClient($transport);

// Activate binary hex-output of server interaction
$smpp->debug = true;
$transport->debug = true;

// Open the connection
$transport->open();
$smpp->bindTransmitter("a1eda","a1eda");

// Optional connection specific overrides
//SmppClient::$sms_null_terminate_octetstrings = false;
//SmppClient::$csms_method = SmppClient::CSMS_PAYLOAD;
//SmppClient::$sms_registered_delivery_flag = SMPP::REG_DELIVERY_SMSC_BOTH;

// Prepare message
$message = 'Ваш код подтверждения регистрации: ' . $code;
$encodedMessage = $message;
//$encodedMessage = GsmEncoder::utf8_to_gsm0338($message);
$from = new SmppAddress('А1 EDA',SMPP::TON_ALPHANUMERIC);
$to = new SmppAddress($phone,SMPP::TON_INTERNATIONAL,SMPP::NPI_E164);

// Send
$smpp->sendSMS($from,$to,$encodedMessage, $tags, 2);

// Close connection
$smpp->close();

echo json_encode(
    [
        'success' => 'true',
    ]
);


