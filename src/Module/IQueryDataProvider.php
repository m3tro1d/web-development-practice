<?php
namespace App\Module;

/**
 * Interface for providers with the following scheme:
 * 'Query' => [Data1, Data2, ...]
 */
interface IQueryDataProvider
{
    public function getDatasetsByQueries(string ...$queries): array;
}
