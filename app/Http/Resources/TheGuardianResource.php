<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;

class TheGuardianResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this['webTitle'],
            'description' => null,
            'url' => $this['webUrl'],
            'author' => Arr::join(Arr::map($this['tags'], fn ($item) => $item['webTitle']), ', ') ?: null,
            'source' => 'The Guardian',
            'publishedAt' => $this['webPublicationDate'],
        ];
    }
}
