<?php
$access_token = 'vtAgCB4We1aF2g8EYeoANajE7gjxfnlQCZzEyMIegvDfaTVtts0WgBE40CNPS+M5JmnLElxRGAy500R1W5a+fOelT7scb4Fow5z+/vxRDZSlO+oWflbwwcmx+Rr92E/T+rA/suUFMYiHrBwYlJdUSQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;