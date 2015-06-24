<?php

require 'func.php';
require 'config.php';

$auth_token = get_auth_token($consumer_key,$consumer_secret);

$result = send_sms($auth_token,$_POST['to_num'],$_POST['msg_body']);
echo "Message ID:".$result['messageId'];
?>
