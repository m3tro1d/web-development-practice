<?php
namespace App\Module;

/**
 * Interface for providers that return images URLs fetched by the keyword and 
 * limited by the specified amount
 */
interface ImagesProviderInterface
{
    public static function getImagesURLsByKeyword(string $keyword, int $amount): array;
}
