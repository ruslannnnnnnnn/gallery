<?php

use App\Cache\ImageCache;
use App\Demo;
use App\Generator;
use App\Repository\Connection;
use App\Repository\ImageSizesRepository;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$path = parse_url($_SERVER['REQUEST_URI'])['path'];

// подобие роутера/контроллера
switch ($path) {
    case '/generator':
    {
        $generator = new Generator(
            new ImageSizesRepository(new Connection()),
            new ImageCache()
        );

        header("Content-Type: image/jpeg");
        $name = $_GET["name"];
        $size = $_GET["size"];

        try {
            echo $generator->getImage($name, $size);
        } catch (Throwable $e) {
            header("Content-Type: application/json");
            echo json_encode([
                'error' => "Не удалось получить изображение",
                'details' => $e->getMessage()
            ]);
        }

        break;
    }
    case '/demo':
    {
        echo Demo::render();

        break;
    }
    default:
    {
        header("Status: 404 Not Found");
        echo "404 Not Found";
    }
}
