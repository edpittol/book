<?php

namespace App\Adapter;

use App\Data\Volume;

class VolumeAdapter
{
    public function fromGoogleClientItem(array $item): Volume
    {
        return new Volume(
            $item['id'],
            $item['volumeInfo']['title'],
            $item['volumeInfo']['authors'],
            $item['volumeInfo']['description']
        );
    }
}
