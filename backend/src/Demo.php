<?php

namespace App;

final class Demo
{

    public static function render(): string
    {
        return <<<'HTML'

            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>demo</title>
            </head>

            <body>

                <ul id="lightGallery" class="gallery">
                  <li data-title="cat 1" data-src="/generator?name=cat1&size=big"> <a href="#"> <img src="/generator?name=cat1&size=min" /> </a> </li>
                  <li data-title="cat 2" data-src="/generator?name=cat2&size=big"> <a href="#"> <img src="/generator?name=cat2&size=min" /> </a> </li>
                  <li data-title="cat 3" data-src="/generator?name=cat3&size=big"> <a href="#"> <img src="/generator?name=cat3&size=min" /> </a> </li>
                  <li data-title="cat 4" data-src="/generator?name=cat4&size=big"> <a href="#"> <img src="/generator?name=cat4&size=min" /> </a> </li>
                  <li data-title="cat 5" data-src="/generator?name=cat5&size=big"> <a href="#"> <img src="/generator?name=cat5&size=min" /> </a> </li>
                  <li data-title="cat 6" data-src="/generator?name=cat6&size=big"> <a href="#"> <img src="/generator?name=cat6&size=min" /> </a> </li>
                  <li data-title="cat 7" data-src="/generator?name=cat7&size=big"> <a href="#"> <img src="/generator?name=cat7&size=min" /> </a> </li>
                  <li data-title="cat 8" data-src="/generator?name=cat8&size=big"> <a href="#"> <img src="/generator?name=cat8&size=min" /> </a> </li>
                  <li data-title="cat 9" data-src="/generator?name=cat9&size=big"> <a href="#"> <img src="/generator?name=cat9&size=min" /> </a> </li>
                  <li data-title="cat 10" data-src="/generator?name=cat10&size=big"> <a href="#"> <img src="/generator?name=cat10&size=min" /> </a> </li>
                </ul>

                <link rel="stylesheet"  href="/static/css/lightgallery.min.css" />
                <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                <script src="/static/js/lightgallery-all.min.js"></script>

                <script>
                    $(document).ready(function() {
                        console.log(123);
                      $("#lightGallery").lightGallery();
                    });
                </script>
                
                <style>
                    .gallery {
                        list-style-type: none;
                        display: flex;
                        flex-wrap: wrap;
                    }
                </style>

            </body>

            </html>

        HTML;
    }

}
