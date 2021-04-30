<?php
namespace App\Module\AboutMe\App;

interface ImageProviderInterface
{
    public function getImageUrls(string $keyword): array;
}
