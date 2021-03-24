<?php
namespace App\Module;

use IvanUskov\ImageSpider\ImageSpider;

class GoogleImagesProvider implements ImagesProviderInterface
{
    public static function getImagesURLsByKeyword(string $keyword, int $amount): array
    {
        $urls = ImageSpider::find(urlencode($keyword));
        return self::randomizeAndLimit($urls, $amount);
    }

    private static function randomizeAndLimit(array $urls, int $amount): array
    {
        shuffle($urls);
        return array_slice($urls, 0, $amount);
    }
}
