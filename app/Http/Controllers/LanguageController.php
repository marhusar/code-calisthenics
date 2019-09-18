<?php

namespace App\Http\Controllers;

use App\Http\Action\Handler\ShowLanguageHandler;
use Illuminate\View\View;

class LanguageController
{
    /** @var ShowLanguageHandler */
    private $showLanguageHandler;

    /**
     * @param ShowLanguageHandler $showLanguageHandler
     */
    public function __construct(ShowLanguageHandler $showLanguageHandler)
    {
        $this->showLanguageHandler = $showLanguageHandler;
    }

    /**
     * @param string $languageCode
     *
     * @return View
     */
    public function show(string $languageCode)
    {
        $language = $this->showLanguageHandler->show($languageCode);

        return \view('language.show', ['language' => $language]);
    }
}
