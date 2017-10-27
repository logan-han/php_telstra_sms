<?php

require 'func.php';
require 'config.php';

$message = json_decode(file_get_contents('php://input'), true);
$sms_file = realpath(dirname(__FILE__)).$sms_file;

foreach($message as $key => $value)
{
  $sms_data .= "$value|";
}
$sms_data .= "\r\n";
file_put_contents("sms.data",$sms_data, FILE_APPEND | LOCK_EX);
?>
