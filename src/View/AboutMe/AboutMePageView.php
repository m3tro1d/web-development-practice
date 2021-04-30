<?php
namespace App\View\AboutMe;

class AboutMePageView
{
    private array $hobbies;

    public function __construct(array $hobbies)
    {
        $this->hobbies = $hobbies;
    }

    public function buildParams(): array
    {
        $hobbiesParam = [];
        foreach ($this->hobbies as $hobbie)
        {
            $hobbiesParam[$hobbie->getName()] = $hobbie->getImages();
        }
        return [ 'hobbies' => $hobbiesParam, ];
    }
}
