<?php

$lang = 'es';
$source = include 'resources/lang/en/legal.php';
$targetFile = "resources/lang/{$lang}/legal.php";
$target = file_exists($targetFile) ? include $targetFile : [];

function autoTranslate($text, $targetLang)
{
    if (is_numeric($text) || strlen($text) < 2)
        return $text;
    if (strlen($text) > 3000)
        return null;

    usleep(1000000); // 1s

    $url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=" . $targetLang . "&dt=t&q=" . urlencode($text);

    $options = [
        'http' => [
            'method' => 'GET',
            'header' => "User-Agent: Mozilla/5.0\r\n",
            'timeout' => 20,
            'ignore_errors' => true
        ],
        'ssl' => ['verify_peer' => false, 'verify_peer_name' => false]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if (!$response) {
        echo "Error: file_get_contents failed. ";
        print_r(error_get_last());
        if (isset($http_response_header)) {
            print_r($http_response_header);
        }
        return null;
    }

    $body = json_decode($response);
    if ($body === null) {
        echo "Error: json_decode failed. ";
        echo $response;
        return null;
    }

    if (isset($body[0])) {
        $full = "";
        foreach ($body[0] as $part) {
            if (isset($part[0]))
                $full .= $part[0];
        }
        return $full;
    }
    return null;
}

$count = 0;
function sync($source, $target, $lang)
{
    global $count;
    foreach ($source as $key => $value) {
        if ($count >= 5)
            break;
        if (is_array($value)) {
            $target[$key] = sync($value, $target[$key] ?? [], $lang);
        } else {
            if (!isset($target[$key]) || $target[$key] === $value) {
                echo "Translating: " . substr($value, 0, 30) . "...\n";
                $translated = autoTranslate($value, $lang);
                if ($translated) {
                    $target[$key] = $translated;
                    echo "Done.\n";
                    $count++;
                } else {
                    echo "Failed.\n";
                    // If one fails, maybe stop to avoid being blocked?
                    // No, let's continue for a few more.
                }
            }
        }
    }
    return $target;
}

$translated = sync($source, $target, $lang);

function pretty_export($data, $indent = "")
{
    if (is_array($data)) {
        $indexed = array_keys($data) === range(0, count($data) - 1);
        $r = [];
        foreach ($data as $key => $value) {
            $r[] = "$indent    " . ($indexed ? "" : pretty_export($key) . " => ") . pretty_export($value, "$indent    ");
        }
        return "[\n" . implode(",\n", $r) . ",\n" . $indent . "]";
    } elseif (is_numeric($data)) {
        return $data;
    } else {
        return "'" . addcslashes($data, "'\\") . "'";
    }
}

file_put_contents($targetFile, "<?php\n\nreturn " . pretty_export($translated) . ";\n");
echo "Saved to $targetFile\n";
