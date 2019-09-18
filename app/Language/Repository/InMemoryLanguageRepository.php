<?php

namespace App\Language\Repository;

use App\Language\Contract\Language;

/**
 * Class InMemoryLanguageRepository
 */
class InMemoryLanguageRepository implements LanguageRepository
{
    /**
     * @param string $code
     *
     * @return Language|null
     */
    public function findLanguageByCode(string $code): ?Language
    {
        $language = new \App\Language\Entity\Language();
        $language->setId(1);
        $language->setCode($code);
        $language->setName('language for code ' . $code);

        return $language;
    }
}
