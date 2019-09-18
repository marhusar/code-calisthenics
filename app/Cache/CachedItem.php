<?php

namespace App\Cache;

class CachedItem
{
    /** @var mixed */
    private $item;

    /** @var \DateTime|null */
    private $expirationDate;

    /**
     * @param mixed          $item
     * @param \DateTime|null $expirationDate
     */
    public function __construct($item, \DateTime $expirationDate = null)
    {
        $this->item           = $item;
        $this->expirationDate = $expirationDate;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->item;
    }

    /**
     * @return \DateTime|null
     */
    public function getExpirationDate(): ?\DateTime
    {
        return $this->expirationDate;
    }

    /**
     * @throws \Exception
     * @return bool
     */
    public function isHit(): bool
    {
        $now = new \DateTime('now');

        if ($this->item !== null && $now <= $this->expirationDate) {
            return true;
        }

        return false;
    }
}
