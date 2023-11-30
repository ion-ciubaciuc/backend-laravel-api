<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsApiOrgResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this['title'],
            'description' => $this['description'],
            'url' => $this['url'],
            'author' => $this['author'],
            'source' => $this['source']['name'] ?? null,
            'publishedAt' => $this['publishedAt'],
        ];
    }
}
