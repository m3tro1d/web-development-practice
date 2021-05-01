<?php
namespace App\Module\AboutMe\Model;

class Hobby
{
    private string $keyword;
    private string $name;
    private array $images;

    public function __construct(string $keyword, string $name, array $images)
    {
        $this->keyword = $keyword;
        $this->name = $name;
        $this->images = $images;
    }

    public function getKeyword(): string
    {
        return $this->keyword;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getImages(): array
    {
        return $this->images;
    }
}
