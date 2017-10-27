<?php

require 'restclient.php';

function get_auth_token($consumer_key,$consumer_secret)
{
  $api = new RestClient;
  $result = $api->post("https://sapi.telstra.com/v1/oauth/token", array('client_id' => $consumer_key, 'client_secret' => $consumer_secret, 'grant_type' => 'client_credentials', 'scope' => 'NSMS'));
  $response_json = (array) $result->decode_response();
  $auth_token = $response_json['access_token'];
  return $auth_token;
}

function send_sms($auth_token,$to_num,$msg_body)
{
  $api = new RestClient(array('headers' => array('authorization' => "Bearer $auth_token")));
  $msg_body = str_replace("\n"," ",$msg_body);
  $result = $api->post("https://tapi.telstra.com/v2/messages/sms", "{\"to\":\"".$to_num."\", \"body\":\"".$msg_body."\"}", array('Content-Type' => 'application/json'));
  return (array) $result->decode_response();
}

function provision_number($auth_token,$notify_url)
{
  $api = new RestClient(array('headers' => array('authorization' => "Bearer $auth_token")));
  $result = $api->post("https://tapi.telstra.com/v2/messages/provisioning/subscriptions", "{\"notifyURL\":\"".$notify_url."\"}", array('Content-Type' => 'application/json'));
  return (array) $result->decode_response();
}
?>
