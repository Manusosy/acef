<?php
$content = <<<EOT
APP_NAME=ACEF
APP_ENV=local
APP_KEY=base64:qeW0dNmlV8SNnpKOrpYHJceSMyAuU=
APP_DEBUG=true
APP_URL=http://127.0.0.1:9090

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=sqlite
DB_DATABASE="C:/Users/ADMIN/Desktop/aceflaravel/ACEF/database/database.sqlite"

SESSION_DRIVER=file
FILESYSTEM_DISK=public
QUEUE_CONNECTION=sync

MAIL_MAILER=smtp
MAIL_HOST=mail.acef-ngo.org
MAIL_PORT=465
MAIL_USERNAME=noreply@acef-ngo.org
MAIL_PASSWORD=
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=noreply@acef-ngo.org
MAIL_FROM_NAME="\${APP_NAME}"

EOT;

file_put_contents('.env', $content);
echo "Env written.\n";
