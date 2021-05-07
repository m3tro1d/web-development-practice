<?php
namespace App\Module\AboutMe\App;

interface ImageRepositoryInterface
{
    public function getCachedImages(string $keyword): ?array;

    public function cacheImages(string $keyword, array $urls): void;

    public function pruneImageCache(string $keyword): void;
}
