<?php

namespace App\Repository;

use PDO;
use PDOException;
use RuntimeException;
use Throwable;

final class Connection
{

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=mysql_db;dbname=qualix', 'app_user', 'password2');
    }

    public function query(string $sql, array $params = []): array
    {
        $stm = $this->pdo->prepare($sql, $params);

        if ($stm->execute($params)) {
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        }

        throw new RuntimeException($sql);
    }

}
