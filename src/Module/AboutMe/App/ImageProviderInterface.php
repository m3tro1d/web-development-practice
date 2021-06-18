<?php
declare(strict_types=1);

namespace App\Module\AboutMe\App;

interface ImageProviderInterface
{
    public function getImageUrls(string $keyword): array;
}
