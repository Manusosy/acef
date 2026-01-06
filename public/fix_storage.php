<?php
// Upload this to public_html
// It assumes your app code is in a sibling folder named 'acef-app'

$target = __DIR__ . '/../acef-app/storage/app/public';
$link = __DIR__ . '/storage';

echo "<h2>Storage Link Fixer</h2>";
echo "<strong>Target (App):</strong> " . $target . "<br>";
echo "<strong>Link (Public):</strong> " . $link . "<br><br>";

if (!file_exists($target)) {
    echo "<span style='color:red'>Error: Target folder does not exist! Check if 'acef-app' folder is correct.</span>";
    exit;
}

if (file_exists($link)) {
    echo "<span style='color:orange'>Symlink already exists.</span>";
} else {
    try {
        symlink($target, $link);
        echo "<span style='color:green'>SUCCESS: Storage symlink created!</span>";
    } catch (\Throwable $e) {
        echo "<span style='color:red'>Error: " . $e->getMessage() . "</span>";
    }
}
