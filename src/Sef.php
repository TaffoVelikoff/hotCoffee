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
     * Get the owning model.
     */
    public function model()
    {
        return $this->morphTo('model');
    }
}
