<?php

namespace App\Repository;

use App\Model\ImageSize;
use Throwable;

final class ImageSizesRepository
{

    public function __construct(
        private Connection $connection
    ) {
    }

    /**
     * Получить размеры для картинок по коду размера
     * @throws Throwable
     */
    public function findImageSizeByTitle(string $title): ?ImageSize
    {
        $queryResult = $this->connection->query("
            SELECT * FROM image_sizes WHERE title = :title
        ", ['title' => $title]);

        if (!count($queryResult) > 0) {
            return null;
        }

        $row = reset($queryResult);
        return new ImageSize(
            $row['title'],
            $row['width'],
            $row['height'],
        );
    }

}
