<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NewYorkTimesResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this['headline']['main'],
            'description' => $this['abstract'],
            'url' => $this['web_url'],
            'author' => $this['byline']['original'],
            'source' => $this['source'] ?? null,
            'publishedAt' => $this['pub_date'],
        ];
    }
}
