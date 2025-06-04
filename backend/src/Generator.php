<?php

namespace App;

use App\Cache\ImageCache;
use App\Repository\ImageSizesRepository;
use GdImage;
use RuntimeException;

final readonly class Generator
{

    public const string IMAGES_DIR = "/var/www/php/gallery";

    public const array IMAGE_EXTENSIONS = ['jpg', 'jpeg', 'gif', 'png'];

    public function __construct(
        private ImageSizesRepository $imageSizesRepository,
        private ImageCache $imageCache,
    ) {
    }

    public function getImage(string $name, string $size): string
    {
        $imageSize = $this->imageSizesRepository->findImageSizeByTitle($size);

        if (null === $imageSize) {
            throw new RuntimeException("По $size не найдены размеры для картинки");
        }

        $cacheKey = $name . $imageSize->width . $imageSize->height;
        if ($this->imageCache->has($cacheKey)) {
            return $this->imageCache->get($cacheKey);
        }

        $originalImage = $this->loadImageByName($name);

        if (null === $originalImage) {
            throw new RuntimeException("Изображение не найдено");
        }

        $resizedImage = $this->resizeImage($originalImage, $imageSize->width, $imageSize->height);
        imagedestroy($originalImage);

        $this->imageCache->set($cacheKey, $resizedImage);

        return $this->imageToString($resizedImage);
    }

    private function loadImageByName(string $name): ?GdImage
    {
        $name = basename($name);
        // проверяем на существование по каждому разрешенному расширению
        foreach (self::IMAGE_EXTENSIONS as $extension) {
            $filePath = self::IMAGES_DIR . "/" . $name . '.' . $extension;
            if (file_exists($filePath)) {
                return match ($extension) {
                    'jpg', 'jpeg' => imagecreatefromjpeg($filePath),
                    'png' => imagecreatefrompng($filePath),
                    'gif' => imagecreatefromgif($filePath),
                    default => null
                };
            }
        }
        return null;
    }

    private function resizeImage(GdImage $image, $maxWidth, $maxHeight): GdImage
    {
        $originalWidth = imagesx($image);
        $originalHeight = imagesy($image);

        $ratio = min($maxWidth / $originalWidth, $maxHeight / $originalHeight);
        $newWidth = (int)round($originalWidth * $ratio);
        $newHeight = (int)round($originalHeight * $ratio);

        $resized = imagecreatetruecolor($newWidth, $newHeight);
        imagealphablending($resized, false);
        imagesavealpha($resized, true);

        imagecopyresampled(
            $resized,
            $image,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            $originalWidth,
            $originalHeight
        );

        return $resized;
    }

    private function imageToString(GdImage $image): string
    {
        ob_start();
        imagejpeg($image, null, 90);
        $imageString = ob_get_contents();
        ob_end_clean();
        imagedestroy($image);
        return $imageString;
    }

}
