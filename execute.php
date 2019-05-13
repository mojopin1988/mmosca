<?php
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if(!$update)
{
  exit;
}

$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";
$voice = isset($update['voice']) ? $update['voice'] : "";

$responses = array();
$responses['lega'] = array();
$responses['lega'][] = 'Giuro che non sono leghista!';

$text = trim($text);
$text = strtolower($text);
header("Content-Type: application/json");

$response = '';

if(strpos($text, "/start") === 0 || $text=="benvenuto Maurizio")
{
	$response = "Ciao $firstname, guarda che roba! ";
}	
elseif($text=="ciao Maurizio")
{
	$response = "sei un villano!";
}
else
{
	foreach($responses as $key => $value){
		if(strpos(strtolower($text), $key)){
			$response = $responses[$key][rand(0, sizeof($responses[$key]) - 1)];
			break;
		}
	}
}


$parameters = array('chat_id' => $chatId, "text" => $response);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);
