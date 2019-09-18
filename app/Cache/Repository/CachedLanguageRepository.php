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

    /**
     * @param LanguageRepository $languageRepository
     * @param CachePoolHandler   $cachePoolHandler
     */
    public function __construct(LanguageRepository $languageRepository, CachePoolHandler $cachePoolHandler)
    {
        $this->languageRepository = $languageRepository;
        $this->cachePoolHandler   = $cachePoolHandler;
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
            $expirationDate = $this->cachePoolHandler->cacheTimeToLive('+24 hours');

            if ($language === null) {
                return $language;
            }

            $this->cachePoolHandler->cacheItem($key, $language, $expirationDate);

            return $language;
        }

        return $item->get();
    }
}
