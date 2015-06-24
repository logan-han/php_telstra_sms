<?php

require 'restclient.php';

function get_auth_token($consumer_key,$consumer_secret)
{
  $api = new RestClient;
  $result = $api->post("https://staging.api.telstra.com/v1/oauth/token", array('client_id' => $consumer_key, 'client_secret' => $consumer_secret, 'grant_type' => 'client_credentials', 'scope' => 'SMS'));
  $response_json = (array) $result->decode_response();
  $auth_token = $response_json['access_token'];
  return $auth_token;
}

function send_sms($auth_token,$to_num,$msg_body)
{
  $api = new RestClient(array('headers' => array('authorization' => "Bearer $auth_token")));
  $result = $api->post("https://staging.api.telstra.com/v1/sms/messages", "{\"to\":\"".$to_num."\", \"body\":\"".$msg_body."\"}", array('Content-Type' => 'application/json'));
  return (array) $result->decode_response();
}

?>
