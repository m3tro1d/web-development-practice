<?php
declare(strict_types=1);

namespace App\Module\AboutMe\Model;

class Hobby
{
    private string $keyword;
    private array $images;

    public function __construct(string $keyword, array $images)
    {
        $this->keyword = $keyword;
        $this->images = $images;
    }

    public function getKeyword(): string
    {
        return $this->keyword;
    }

    public function getImages(): array
    {
        return $this->images;
    }
}
