<?php

namespace TaffoVelikoff\HotCoffee\Traits;

use File;
use Image;
use Storage;

trait HasCroppieAttachment
{
	/**
	* Attach from croppie's base64
	*
	*/
	public function croppieAttach($imgData, $attGroup = 'default', $resize = null)
	{
		@list($type, $imgData) = explode(';', $imgData);
		@list(, $imgData) = explode(',', $imgData); 

		if($imgData != ""){ // storing image in storage/app/public Folder 

			// check for existing
			if($this->attachmentsGroup($attGroup)->isEmpty() == false) {
				foreach($this->attachmentsGroup($attGroup) as $att){
					$att->delete();
				}
			}

			// open an image file
			$img = Image::make(base64_decode($imgData));

			// resize image instance
			if(isset($resize)) {
				$img->resize($resize[0], $resize[1]);
			}

			// save image in desired format
			$filename = '../storage/app/public/'.str_random(32).'_'.time().'.jpg';
			$img->save($filename);

			// attach it
			$this->attach($img->dirname.'/'.$img->basename, ['group' => $attGroup]);

			// destroy it
			File::delete($filename);

		}
	}
}