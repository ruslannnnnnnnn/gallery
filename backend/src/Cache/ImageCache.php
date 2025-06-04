<?php

namespace App\Cache;

final class ImageCache
{
    public const string CACHE_DIR = "/var/www/php/cache";

    public function has(string $key): bool
    {
        return file_exists(self::CACHE_DIR . "/" . $key);
    }

    public function get(string $key): string
    {
        return file_get_contents(self::CACHE_DIR . "/" . $key);
    }

    public function set(string $key, $image): void
    {
        $path = self::CACHE_DIR . "/$key";
        imagejpeg($image, $path, 90);
    }

}
