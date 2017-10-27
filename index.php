<html lang="en">
<head>
  <meta charset="utf-8">
  <title>WEB SMS</title>
  <link rel="stylesheet" href="//oss.maxcdn.com/libs/pure/0.3.0/pure-min.css">
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Raleway:200">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
  <script type="text/javascript">
$(function() {
    $("#Submit").click(function(e) {
        e.preventDefault();
        var to_num = $("#to_num").val();
        var msg_body = $("#msg_body").val();
        var dataString = 'to_num='+ to_num + '& msg_body=' + msg_body;

        if(to_num=='' || msg_body=='')
        {
            $('.success').fadeOut(200).hide();
            $('.error').fadeIn(200).show();
        }
        else
        {
            $.ajax({
                type: "POST",
                url: "send_sms.php",
                data: dataString,
                success: function(){
                    $('.success').fadeIn(200).show();
                    $('.error').fadeOut(200).hide();
                }
            });
        }
        return false;
    });
});
</script>
</head>

<body>

<form class="pure-form pure-form-stacked" action="send_sms.php" method="POST">
    <fieldset>
        <legend>WEB SMS - Australian number only</legend>
        <input type="text" class="pure-input-1-2" placeholder="To" id="to_num" name="to_num">
        <textarea class="pure-input-1-2" placeholder="Message" id="msg_body" name="msg_body"></textarea>
    </fieldset>

    <button id="Submit" class="pure-button pure-input-1-2 pure-button-primary">Send</button>
</$form>
<p>
   <span class="error" style="display:none">Please fill all fields</span>
   <span class="success" style="display:none">SMS Sent</span>
</p>

<?php
require 'func.php';
require 'config.php';

$auth_token = get_auth_token($consumer_key,$consumer_secret);

$result = provision_number($auth_token,$notify_url);
echo "Number Provisioned: ".$result['destinationAddress']."<br>\n";
echo file_get_contents( "sms.txt" );
?>

</body>

</html>