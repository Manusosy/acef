<?php
$envPath = '.env';
$examplePath = '.env.example';

// Start fresh from example
$content = file_get_contents($examplePath);

// Define our specific overrides
$overrides = [
    'APP_NAME' => 'ACEF',
    'APP_URL' => 'http://127.0.0.1:9090',
    'DB_CONNECTION' => 'sqlite',
    'DB_DATABASE' => 'C:\Users\ADMIN\Desktop\aceflaravel\ACEF\database\database.sqlite',
    'MAIL_MAILER' => 'smtp',
    'MAIL_HOST' => 'mail.acef-ngo.org',
    'MAIL_PORT' => '465',
    'MAIL_USERNAME' => 'noreply@acef-ngo.org',
    'MAIL_FROM_ADDRESS' => 'noreply@acef-ngo.org',
    'MAIL_FROM_NAME' => 'ACEF',
    'MAIL_ENCRYPTION' => 'ssl',
];

foreach ($overrides as $key => $value) {
    if (preg_match("/^{$key}=/m", $content)) {
        $content = preg_replace("/^{$key}=.*/m", "{$key}=\"{$value}\"", $content);
    } else {
        $content .= "\n{$key}=\"{$value}\"";
    }
}

file_put_contents($envPath, $content);
echo "Env written successfully.\n";
