<?php
namespace App\Module\AboutMe\App;

interface ImageRepositoryInterface
{
    public function getImages(string $keyword): array;

    public function addImages(string $keyword, array $urls): void;

    public function deleteImages(string $keyword = ''): void;
}
