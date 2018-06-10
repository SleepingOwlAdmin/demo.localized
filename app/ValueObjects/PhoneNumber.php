<?php

namespace App\ValueObjects;

class PhoneNumber
{
    const PHONE_REGEX = '/\+?[^\d]{0,7}([0-9]{1})?[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{2})[^\d]{0,7}(\d{2})/';

    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $formatted;

    /**
     * @param string $number
     */
    public function __construct(string $number)
    {
        if (!$this->isValid($number)) {
            throw new \InvalidArgumentException(trans('validation.phone_number'));
        }

        $this->number = $number;
        $this->formatted = preg_replace(static::PHONE_REGEX, '$1$2$3$4$5', $number);
    }

    /**
     * @param string $number
     *
     * @return bool
     */
    protected function isValid(string $number): bool
    {
        return preg_match(static::PHONE_REGEX, $number) === 1;
    }

    /**
     * @return string
     */
    public function formatted(): string
    {
        return $this->formatted;
    }

    /**
     * @return string
     */
    public function prettyFormatted(): string
    {
        return preg_replace(static::PHONE_REGEX, '+7 ($2) $3-$4$5', $this->number);
    }

    public function __toString()
    {
        return $this->formatted();
    }
}