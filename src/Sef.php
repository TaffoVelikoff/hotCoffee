<?php

namespace TaffoVelikoff\HotCoffee;

use Illuminate\Database\Eloquent\Model;

class Sef extends Model
{

	/**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [''];

    /**
     * Get the owning sefable model.
     */
    public function sefable()
    {
        return $this->morphTo();
    }
}
