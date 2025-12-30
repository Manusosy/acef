<?php
$ip = gethostbyname('translate.googleapis.com');
$url = 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=es&dt=t&q=' . urlencode('Hello World');
$options = [
    'http' => [
        'header' => "Host: translate.googleapis.com\r\nUser-Agent: Mozilla/5.0\r\n",
        'timeout' => 20,
        'ignore_errors' => true
    ],
    'ssl' => ['verify_peer' => false, 'verify_peer_name' => false]
];
$out = "IP: $ip\nURL: $url\n";
$res = file_get_contents($url, false, stream_context_create($options));
$out .= "RES: " . var_export($res, true) . "\n";
if (!$res) {
    $err = error_get_last();
    $out .= "ERROR: " . var_export($err, true) . "\n";
}
file_put_contents('debug.log', $out);
echo "Result in debug.log\n";