<?php

namespace TaffoVelikoff\HotCoffee\Events;

use Illuminate\Queue\SerializesModels;

class AdminLogin
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = auth()->user();
    }
}