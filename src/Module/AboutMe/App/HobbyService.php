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

    /**
     * @return []Hobby
     */
    public function getHobbies(): array
    {
        $hobbies = [];
        $hobbyMap = $this->configuration->getHobbyMap();

        foreach ($hobbyMap as $hobbyName)
        {
            $images = $this->imageRepository->getImages($hobbyName);
            if (empty($images))
            {
                $this->updateHobbies($hobbyName);
                $images = $this->imageRepository->getImages($hobbyName);
            }
            $hobbies[] = new Hobby($hobbyName, $images);
        }

        return $hobbies;
    }

    public function updateHobbies(string $keyword): void
    {
        if ($keyword === '')
        {
            $this->imageRepository->deleteImages();
            $hobbyMap = $this->configuration->getHobbyMap();
            foreach ($hobbyMap as $hobbyName)
            {
                $images = $this->imageProvider->getImageUrls($hobbyName);
                $this->imageRepository->addImages($hobbyName, $images);
            }
        }
        else
        {
            $this->imageRepository->deleteImages($keyword);
            $images = $this->imageProvider->getImageUrls($keyword);
            $this->imageRepository->addImages($keyword, $images);
        }
    }
}
