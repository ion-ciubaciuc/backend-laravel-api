<?php

namespace App\Domain\NewsService;

use App\Http\Resources\NewYorkTimesResource;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class NewYorkTimesSource implements NewsSource
{
    private PendingRequest $request;

    private string $baseUrl;

    private array $queries = [];

    public function __construct()
    {
        $this->baseUrl = env('NEW_YORK_TIMES_API_URL');
        $this->request = Http::withQueryParameters([
            'api-key' => env('NEW_YORK_TIMES_API_KEY'),
        ]);
    }

    public function search(string $query): NewsSource
    {
        $this->queries['q'] = $query;

        return $this;
    }

    public function fromDate(Carbon $date): NewsSource
    {
        $this->queries['begin_date'] = $date->toIso8601String();

        return $this;
    }

    public function toDate(Carbon $date): NewsSource
    {
        $this->queries['end_date'] = $date->toIso8601String();

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
            ->collect('response.docs');

        return NewYorkTimesResource::collection($collection);
    }
}
