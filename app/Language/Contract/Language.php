<?php

namespace App\Language\Contract;

interface Language
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getCode(): string;

    /**
     * @return string
     */
    public function getName(): string;
}
