<?php

namespace TaffoVelikoff\HotCoffee;

class Attachment extends \Bnb\Laravel\Attachments\Attachment
{
    // ...
    public function thumbnail($dimentions = '500', $fit = null) {

        $thumbnailables = [
            'image/jpeg',
            'image/jpg',
            'image/png'
        ];

        if(!in_array($this->filetype, $thumbnailables)) return null;

        $dimentionsQuery = '';
		$fitQuery = '';

		(isset($dimentions)) ? $query = '?' : $query = '';

		if(isset($dimentions))
			(is_array($dimentions)) ? $dimentionsQuery = 'w='.$dimentions[0].'&h='.$dimentions[1] : $dimentionsQuery = 'w='.$dimentions.'&h='.$dimentions;

		if(isset($fit))
			$fitQuery = '&fit='.$fit;

		return url('img'.'/'.$this->filepath.$query.$dimentionsQuery.$fitQuery);
    }
}