<?php
namespace App\Module\AboutMe\Infrastructure;

use IvanUskov\ImageSpider\ImageSpider;

use App\Module\AboutMe\App\ImageProviderInterface;

class ImageProvider implements ImageProviderInterface
{
    private const IMAGES_AMOUNT = 5;

    public function getImageUrls(string $keyword): array
    {
        $urls = ImageSpider::find(urlencode($keyword));
        return $this->randomizeAndLimit($urls);
    }
    private function randomizeAndLimit(array $urls): array
    {
        shuffle($urls);
        return array_slice($urls, 0, self::IMAGES_AMOUNT);
    }
}
