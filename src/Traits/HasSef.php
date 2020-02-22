<?php

namespace TaffoVelikoff\HotCoffee\Traits;

use TaffoVelikoff\HotCoffee\Sef;

trait HasSef
{

	/**
     * Get the custom url (SEF)
     */
    public function sef() {
        return $this->morphOne(\TaffoVelikoff\HotCoffee\Sef::class, 'model');
    }

	/**
	* Save custom url
	*
	*/
	public function saveSef($keyword) {

		(!$this->sef) ? $sef = new Sef : $sef = $this->sef;

		$class = get_class($this);
		$sef->keyword = $keyword;
		$sef->model_id = $this->id;
		$sef->model_type = $class;
		$sef->save();
	}

	/**
	* Keyword
	*
	*/
	public function keyword() {
		if($this->sef)
			return $this->sef->keyword;
		
		return null;
	}

	/**
	 * Full URL
	 */
	public function sefUrl() {
		return url($this->sef->keyword);
	}

}