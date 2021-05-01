<?php
namespace App\Module\AboutMe\App;

use App\Module\AboutMe\Model\Hobby;

class HobbyService
{
    private ImageProviderInterface $imageProvider;
    private HobbyConfigurationInterface $configuration;

    public function __construct(ImageProviderInterface $imageProvider, HobbyConfigurationInterface $configuration)
    {
        $this->imageProvider = $imageProvider;
        $this->configuration = $configuration;
    }

    public function getHobbies(): array
    {
        $hobbies = [];
        $hobbyMap = $this->configuration->getHobbyMap();

        foreach ($hobbyMap as $hobbyName)
        {
            $images = $this->imageProvider->getImageUrls($hobbyName);
            $hobbies[] = new Hobby($hobbyName, $hobbyName, $images);
        }

        return $hobbies;
    }
}
