<?php
declare(strict_types=1);

namespace App\Module\AboutMe\Infrastructure;

use App\Module\AboutMe\App\ImageProviderInterface;
use IvanUskov\ImageSpider\ImageSpider;

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
