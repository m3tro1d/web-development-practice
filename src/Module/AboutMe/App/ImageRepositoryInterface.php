<?php
namespace App\Module\AboutMe\App;

interface ImageRepositoryInterface
{
    public function thereAreCachedImages(string $keyword): bool;

    public function getCachedImages(string $keyword): array;

    public function cacheImages(string $keyword, array $urls): void;

    public function pruneImageCache(): void;
}
