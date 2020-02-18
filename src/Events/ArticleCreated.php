<?php

namespace TaffoVelikoff\HotCoffee\Events;

use TaffoVelikoff\HotCoffee\Article;
use Illuminate\Queue\SerializesModels;

class ArticleCreated
{
    use SerializesModels;

    public $article;

    /**
     * Create a new event instance.
     *
     * @param  \TaffoVelikoff\HotCoffee\Article  $article
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }
}