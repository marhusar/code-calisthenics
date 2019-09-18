<?php

namespace App\Cache\Repository;

use App\Cache\Handler\CachePoolHandler;
use App\Language\Repository\LanguageRepository;
use App\Language\Contract\Language;

class CachedLanguageRepository implements LanguageRepository
{
    /** @var LanguageRepository */
    private $languageRepository;

    /** @var CachePoolHandler */
    private $cachePoolHandler;

    /** @var string */
    private $cacheTimeToLive;

    /**
     * @param LanguageRepository $languageRepository
     * @param CachePoolHandler   $cachePoolHandler
     * @param string             $cacheTimeToLive
     */
    public function __construct(
        LanguageRepository $languageRepository,
        CachePoolHandler $cachePoolHandler,
        string $cacheTimeToLive
    ) {
        $this->languageRepository = $languageRepository;
        $this->cachePoolHandler   = $cachePoolHandler;
        $this->cacheTimeToLive    = $cacheTimeToLive;
    }

    /**
     * @param string $languageCode
     *
     * @throws \Exception
     * @return Language|null
     */
    public function findLanguageByCode(string $languageCode): ?Language
    {
        $key  = 'language_code.' . $languageCode;
        $item = $this->cachePoolHandler->getItemByKey($key);

        if ($item->isHit() === false) {
            $language       = $this->languageRepository->findLanguageByCode($languageCode);
            $expirationDate = $this->cachePoolHandler->cacheTimeToLive($this->cacheTimeToLive);

            if ($language === null) {
                return $language;
            }

            $this->cachePoolHandler->cacheItem($key, $language, $expirationDate);

            return $language;
        }

        return $item->get();
    }
}
