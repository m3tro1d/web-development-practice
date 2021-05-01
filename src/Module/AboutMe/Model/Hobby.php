<?php
namespace App\Module\AboutMe\Model;

class Hobby
{
    private string $keyword;
    private string $name;
    private array $images;

    function __construct(string $keyword, string $name, array $images)
    {
        $this->keyword = $keyword;
        $this->name = $name;
        $this->images = $images;
    }

    function getKeyword(): string
    {
        return $this->keyword;
    }

    function getName(): string
    {
        return $this->name;
    }

    function getImages(): array
    {
        return $this->images;
    }
}
