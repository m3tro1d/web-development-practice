<?php
namespace App\Module\AboutMe\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use IvanUskov\ImageSpider\ImageSpider;

use App\Module\AboutMe\App\ImageProviderInterface;
use App\Entity\SavedUrl;

class ImageProvider implements ImageProviderInterface
{
    private const IMAGES_AMOUNT = 5;
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getImageUrls(string $keyword): array
    {
        if ($this->thereAreSavedImages($keyword))
        {
            $urls = $this->getSavedImages($keyword);
        }
        else
        {
            $urls = $this->getNewImages($keyword);
            $this->saveImages($keyword, $urls);
        }
        return $urls;
    }

    private function thereAreSavedImages(string $keyword): bool
    {
        $repository = $this->entityManager->getRepository(SavedUrl::class);
        $result = $repository->findBy([
            'keyword' => $keyword,
        ]);
        return !empty($result);
    }

    private function getSavedImages(string $keyword): array
    {
        $repository = $this->entityManager->getRepository(SavedUrl::class);
        $savedUrls = $repository->findBy([
            'keyword' => $keyword,
        ]);
        $urls = [];
        foreach ($savedUrls as $savedUrl)
        {
            $urls[] = $savedUrl->getUrl();
        }
        return $urls;
    }

    private function getNewImages(string $keyword): array
    {
        $urls = ImageSpider::find(urlencode($keyword));
        return $this->randomizeAndLimit($urls);
    }

    private function randomizeAndLimit(array $urls): array
    {
        shuffle($urls);
        return array_slice($urls, 0, self::IMAGES_AMOUNT);
    }

    private function saveImages(string $keyword, array $urls): void
    {
        foreach ($urls as $url)
        {
            $savedUrl = new SavedUrl();
            $savedUrl->setKeyword($keyword);
            $savedUrl->setUrl($url);
            $this->entityManager->persist($savedUrl);
        }
        $this->entityManager->flush();
    }
}
