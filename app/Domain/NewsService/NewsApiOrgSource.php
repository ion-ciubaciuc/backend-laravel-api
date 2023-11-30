<?php

namespace App\Domain\NewsService;

use App\Http\Resources\NewsApiOrgResource;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class NewsApiOrgSource implements NewsSource
{
    private PendingRequest $request;

    private string $baseUrl;

    private array $queries = [];

    private const PAGE_SIZE = 10;

    public function __construct()
    {
        $this->baseUrl = env('NEWS_API_ORG_API_URL');
        $this->request = Http::withQueryParameters([
            'apiKey' => env('NEWS_API_ORG_API_KEY'),
            'pageSize' => self::PAGE_SIZE,
        ]);
    }

    public function search(string $query): NewsSource
    {
        $this->queries['q'] = $query;

        return $this;
    }

    public function fromDate(Carbon $date): NewsSource
    {
        $this->queries['from'] = $date->toIso8601String();

        return $this;
    }

    public function toDate(Carbon $date): NewsSource
    {
        $this->queries['to'] = $date->toIso8601String();

        return $this;
    }

    public function page(int $page): NewsSource
    {
        $this->queries['page'] = $page;

        return $this;
    }

    public function get(): AnonymousResourceCollection
    {
        $collection = $this->request
            ->get($this->baseUrl, $this->queries)
            ->collect('articles');

        return NewsApiOrgResource::collection($collection);
    }
}
