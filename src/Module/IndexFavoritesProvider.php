<?php
namespace App\Module;

use IvanUskov\ImageSpider\ImageSpider;

class IndexFavoritesProvider
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
    public function getURLsByQueries(string ...$queries): array
    {
        $result = [];
        foreach ($queries as $index => $query)
        {
            $result[$query] = $this->getURLsForQuery($query);
        }
        return $result;
    }

    /**
     * Gets the random image URLs and limits them according to the $amountPerQuery
     */
    private function getURLsForQuery(string $query): array
    {
        $urls = ImageSpider::find($this->normalizeQuery($query));
        return array_slice($urls, $this->randomOffset($urls), $this->amountPerQuery);
    }

    /**
     * Returns a ready-to-process query
     */
    private function normalizeQuery(string $query): string
    {
        return str_replace(' ', '+', $query);
    }

    /**
     * Returns a random array offset number according to the $amountPerQuery
     */
    private function randomOffset(array $arr): int
    {
        return rand(0, count($arr) - $this->amountPerQuery - 1);
    }
}
