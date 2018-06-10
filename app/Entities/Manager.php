<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;

class Manager
{
    use Notifiable;

    /**
     * @var string
     */
    public $email;

    /**
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->email;
    }
}