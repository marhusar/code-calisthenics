<?php

namespace App\Cache\Handler;

use App\Cache\CachedItem;
use Illuminate\Support\Collection;

/**
 * Class InMemoryCachePoolHandler
 */
class InMemoryCachePoolHandler implements CachePoolHandler
{
    /** @var Collection */
    private $cachedItems;

    /**
     * @param Collection $cachedItems
     */
    public function __construct(Collection $cachedItems = null)
    {
        if ($cachedItems === null) {
            $cachedItems = new Collection([]);
        }

        $this->cachedItems = $cachedItems;
    }

    /**
     * @param string    $key
     * @param mixed     $item
     * @param \DateTime $expiration
     */
    public function cacheItem(string $key, $item, \DateTime $expiration)
    {
        $this->cachedItems->put($key, new CachedItem($item, $expiration));
    }

    /**
     * @param string $timeToLive
     *
     * @return \DateTime|null
     */
    public function cacheTimeToLive(string $timeToLive)
    {
        try {
            $expirationDate = new \DateTime($timeToLive);
        } catch (\Exception $exception) {
            $expirationDate = null;
        }

        return $expirationDate;
    }

    /**
     * @param string $key
     *
     * @return CachedItem
     */
    public function getItemByKey(string $key): CachedItem
    {
        return $this->cachedItems->get($key, new CachedItem(null));
    }
}
