<?php

namespace TaffoVelikoff\HotCoffee\Events;

use TaffoVelikoff\HotCoffee\InfoPage;
use Illuminate\Queue\SerializesModels;

class InfoPageUpdated
{
    use SerializesModels;

    public $page;

    /**
     * Create a new event instance.
     *
     * @param  \TaffoVelikoff\HotCoffee\InfoPage  $page
     * @return void
     */
    public function __construct(InfoPage $page)
    {
        $this->page = $page;
    }
}