<?php

namespace App\Language\Repository;

use App\Language\Contract\Language;

/**
 * Class InMemoryLanguageRepository
 */
interface LanguageRepository
{
    /**
     * @param string $code
     *
     * @return Language|null
     */
    public function findLanguageByCode(string $code): ?Language;
}
