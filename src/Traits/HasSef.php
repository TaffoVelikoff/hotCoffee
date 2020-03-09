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
		$sef = Sef::create(['keyword' => $keyword]);
		$this->sync($sef);
		$sef->save();
	}

	/**
	* Update custom url
	*
	*/
	public function updateSef($keyword) {
		$this->sef->keyword = $keyword;
		$this->sef->save();
	}

	/**
	* Keyword
	*
	*/
	public function sefKeyword() {
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