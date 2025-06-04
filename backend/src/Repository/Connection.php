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
        try {
            $this->pdo = new PDO('mysql:host=mysql_db;dbname=qualix', 'app_user', 'password2');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            throw $e;
        }
    }

    public function query(string $sql, array $params = []): array
    {
        try {
            $stm = $this->pdo->prepare($sql, $params);

            if ($stm->execute($params)) {
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            }
            throw new RuntimeException($sql);
        } catch (Throwable $e) {
            echo "Не удалось выполнить запрос: " . $e->getMessage();
            die();
        }
    }

}
