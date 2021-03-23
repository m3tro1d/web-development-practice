<?php
namespace App\Module;

use IvanUskov\ImageSpider\ImageSpider;

class IndexFavoritesProvider implements IQueryDataProvider
{
    private int $amountPerQuery;

    public function __construct(int $amountPerQuery)
    {
        $this->amountPerQuery = $amountPerQuery;
    }

    /**
     * Returns a dictionary with the following elements:
     * 'Query' => [ 'URL1', 'URL2', ... ]
     */
    public function getDatasetsByQueries(string ...$queries): array
    {
        $result = [];
        foreach ($queries as $index => $query)
        {
            $result[$query] = $this->getURLsForQuery($query);
        }
        return $result;
    }

    /**
     * Returns random image URLs
     */
    private function getURLsForQuery(string $query): array
    {
        $urls = ImageSpider::find(urlencode($query));
        return $this->randomizeAndLimit($urls);
    }

    /**
     * Shuffles the array and limits the result according to the $amountPerQuery
     */
    private function randomizeAndLimit(array $urls)
    {
        shuffle($urls);
        return array_slice($urls, 0, $this->amountPerQuery);
    }
}
