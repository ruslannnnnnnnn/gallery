<?php

use App\Repository\Connection;

require_once dirname(__DIR__) . '../../vendor/autoload.php';

try {
    $conn = new Connection();

    $conn->query(
        file_get_contents("/var/www/php/migration/migration1.sql")
    );
    echo "Миграции выполнены";
} catch (Throwable $e) {
    echo "Не удалось выполнить миграцию: " . $e->getMessage() . PHP_EOL;
}
