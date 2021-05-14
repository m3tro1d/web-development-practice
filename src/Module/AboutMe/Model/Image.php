<?php
declare(strict_types=1);

namespace App\Module\AboutMe\Model;

class Image
{
    private int $id;
    private string $keyword;
    private string $url;

    public function __construct(string $keyword, string $url)
    {
        $this->keyword = $keyword;
        $this->url = $url;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getKeyword(): string
    {
        return $this->keyword;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
