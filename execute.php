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
$text = trim($text);
$text = strtolower($text);
header("Content-Type: application/json");
$response = '';
if(strpos($text, "/start") === 0 || $text=="benvenuto Maurizio")
{
	$response = "$firstname guarda che roba!";
}
elseif($text=="puttane")
{
	$response = "ma chi non è mai andato a puttane!?";
}
elseif($text=="porca troia")
{
	$response = "ma chi non è mai andato a puttane!?";
}
elseif($text=="porca puttana")
{
	$response = "ma chi non è mai andato a puttane!?";
}
elseif($text=="porca mignotta")
{
	$response = "ma chi non è mai andato a puttane!?";
}
elseif($text=="ciao maurizio")
{
	$response = "ciao mauro vedi di salutarmi la prossima volta, sei un villano!";
}
elseif($text=="ciao")
{
	$response = "$firstname, guarda che roba!";
}
elseif($text=="soldi")
{
	$response = "i soldi che avete voi!";
}
elseif($text=="lega")
{
	$response = "Giuro che non sono leghista!";
}
elseif($text=="leghista")
{
	$response = "Giuro che non sono leghista!";
}
elseif($text=="salvini")
{
	$response = "Giuro che non sono leghista!";
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
