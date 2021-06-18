<?php
declare(strict_types=1);

namespace App\View\AboutMe;

use App\Module\AboutMe\Model\Hobby;

class AboutMePageView
{
    /**
     * @var Hobby[]
     */
    private array $hobbies;

    /**
     * @param Hobby[] $hobbies
     */
    public function __construct(array $hobbies)
    {
        $this->hobbies = $hobbies;
    }

    public function buildParams(): array
    {
        $hobbiesParam = [];
        foreach ($this->hobbies as $hobby)
        {
            $hobbiesParam[$hobby->getKeyword()] = $hobby->getImages();
        }
        return [ 'hobbies' => $hobbiesParam ];
    }
}
