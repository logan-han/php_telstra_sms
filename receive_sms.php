<?php

require 'func.php';
require 'config.php';

$message = json_decode(file_get_contents('php://input'), true);
$current = file_get_contents("sms.txt");

foreach($message as $key => $value)
{
  $append .= "$key: $value<br>\n";
}
file_put_contents("sms.txt", $append);
?>
