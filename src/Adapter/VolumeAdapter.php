<?php

declare(strict_types=1);

namespace App\Adapter;

use App\Data\Volume;

class VolumeAdapter
{
    /**
     * @param array{
     *     id: string,
     *     volumeInfo: array{
     *         title: string,
     *         authors: string[],
     *         description: string
     *     }
     * } $item
     */
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
