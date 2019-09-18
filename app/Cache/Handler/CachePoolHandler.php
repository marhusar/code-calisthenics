<?php

namespace App\Cache\Handler;

use App\Cache\CachedItem;

/**
 * Class InMemoryCachePoolHandler
 */
interface CachePoolHandler
{
    /**
     * @param string         $key
     * @param mixed          $item
     * @param \DateTime|null $expiration
     */
    public function cacheItem(string $key, $item, \DateTime $expiration = null);

    /**
     * @param string $timeToLive
     *
     * @return \DateTime|null
     */
    public function cacheTimeToLive(string $timeToLive);

    /**
     * @param string $key
     *
     * @return CachedItem
     */
    public function getItemByKey(string $key): CachedItem;
}
