<?php

namespace App\Http\Action\Handler;

use App\Language\Contract\Language;
use App\Language\Repository\LanguageRepository;

class ShowLanguageHandler
{
    /** @var LanguageRepository */
    private $languageRepository;

    /**
     * @param LanguageRepository $languageRepository
     */
    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    /**
     * @param string $languageCode
     *
     * @return Language|null
     */
    public function show(string $languageCode): ?Language
    {
        return $this->languageRepository->findLanguageByCode($languageCode);
    }
}
