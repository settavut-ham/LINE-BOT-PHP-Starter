<?php
$access_token = 'vtAgCB4We1aF2g8EYeoANajE7gjxfnlQCZzEyMIegvDfaTVtts0WgBE40CNPS+M5JmnLElxRGAy500R1W5a+fOelT7scb4Fow5z+/vxRDZSlO+oWflbwwcmx+Rr92E/T+rA/suUFMYiHrBwYlJdUSQdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			
			//find the intent
			
			$replyText = "";
			// switch($text){
			// 	case !strpos($text, 'rsi') :
			// 		$replyText = "user want RSI intent.";
			// 		break;
			// 	default:
			// 		$replyText = "user want others intent.";
			// }

			if (!strpos($text, 'rsi')){
				$replyText = "user want RSI intent.";
			}else {
				$replyText = "user want others intent.";
			}

			$messages = [
				'type' => 'text',
				'text' => $replyText . " with reply token of" . $replyToken
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "running";