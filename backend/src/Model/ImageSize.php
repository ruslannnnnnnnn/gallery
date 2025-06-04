<?php

namespace App\Model;

final class ImageSize
{

    public function __construct(
        public string $title,
        public int $width,
        public int $height,
    ) {
    }

}
