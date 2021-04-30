<?php
namespace App\Module\AboutMe\App;

use App\Module\AboutMe\Infrastructure\ImageProvider;
use App\Module\AboutMe\Infrastructure\ConstHobbieConfiguration;
use App\Module\AboutMe\Model\Hobbie;

class HobbieService
{
    private ImageProviderInterface $imageProvider;
    private HobbieConfigurationInterface $configuration;

    public function __construct(ImageProviderInterface $imageProvider, HobbieConfigurationInterface $configuration)
    {
        $this->imageProvider = $imageProvider;
        $this->configuration = $configuration;
    }

    public function getHobbies(): array
    {
        $hobbies = [];
        $hobbieMap = $this->configuration->getHobbieMap();

        foreach ($hobbieMap as $hobbieName)
        {
            $images = $this->imageProvider->getImageUrls($hobbieName);
            $hobbies[] = new Hobbie($hobbieName, $hobbieName, $images);
        }

        return $hobbies;
    }
}
