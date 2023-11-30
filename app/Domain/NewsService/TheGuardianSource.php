<?php

namespace App\Domain\NewsService;

use App\Http\Resources\TheGuardianResource;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class TheGuardianSource implements NewsSource
{
    private PendingRequest $request;

    private string $baseUrl;

    private array $queries = [];

    public function __construct()
    {
        $this->baseUrl = env('THE_GUARDIAN_API_URL');
        $this->request = Http::withQueryParameters([
            'api-key' => env('THE_GUARDIAN_API_KEY'),
            'show-tags' => 'contributor',
        ]);
    }

    public function search(string $query): NewsSource
    {
        $this->queries['q'] = $query;

        return $this;
    }

    public function fromDate(Carbon $date): NewsSource
    {
        $this->queries['from-date'] = $date->toIso8601String();

        return $this;
    }

    public function toDate(Carbon $date): NewsSource
    {
        $this->queries['to-date'] = $date->toIso8601String();

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
            ->collect('response.results');

        return TheGuardianResource::collection($collection);
    }
}
