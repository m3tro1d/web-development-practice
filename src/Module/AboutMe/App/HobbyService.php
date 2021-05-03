<?php
namespace App\Module\AboutMe\App;

use App\Module\AboutMe\Model\Hobby;

class HobbyService
{
    private ImageProviderInterface $imageProvider;
    private HobbyConfigurationInterface $configuration;
    private ImageRepositoryInterface $imageRepository;

    public function __construct(
        ImageProviderInterface $imageProvider,
        HobbyConfigurationInterface $configuration,
        ImageRepositoryInterface $imageRepository
    )
    {
        $this->imageProvider = $imageProvider;
        $this->configuration = $configuration;
        $this->imageRepository = $imageRepository;
    }

    public function getHobbies(): array
    {
        $hobbies = [];
        $hobbyMap = $this->configuration->getHobbyMap();

        foreach ($hobbyMap as $hobbyName)
        {
            if ($this->imageRepository->thereAreCachedImages($hobbyName))
            {
                $images = $this->imageRepository->getCachedImages($hobbyName);
            }
            else
            {
                $images = $this->imageProvider->getImageUrls($hobbyName);
                $this->imageRepository->cacheImages($hobbyName, $images);
            }
            $hobbies[] = new Hobby($hobbyName, $hobbyName, $images);
        }

        return $hobbies;
    }

    public function updateHobbies(): void
    {
        $this->imageRepository->pruneImageCache();
    }
}
