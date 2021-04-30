<?php
namespace App\View\AboutMe;

class AboutMePageView
{
    private array $hobbies;

    public function __construct(array $hobbies) // array of App\Module\AboutMe\Model\Hobbie;
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
