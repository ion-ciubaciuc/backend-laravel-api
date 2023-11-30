<?php

namespace App\Domain\NewsService;

use App\Domain\NewsService\Filter\DateFrom;
use App\Domain\NewsService\Filter\DateTo;
use App\Domain\NewsService\Filter\Page;
use App\Domain\NewsService\Filter\Search;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Arr;

class NewsService
{
    private Pipeline $pipeline;

    private NewsSourceFactory $factory;

    /**
     * @var NewsSource[]
     */
    private array $sources = [];

    public function __construct(Pipeline $pipeline, NewsSourceFactory $factory)
    {
        $this->pipeline = $pipeline;
        $this->factory = $factory;
    }

    public function getArticles(): array
    {
        return array_reduce($this->sources, function ($carry, $source) {
            return [...$carry, ...$this->prepareEndpoint($source)->get()];
        }, []);
    }

    /**
     * @param  string[]  $sources
     * @return $this
     */
    public function useSources(array $sources): self
    {
        $this->sources = Arr::map($sources, function (string $source) {
            return $this->factory->make($source);
        });

        return $this;
    }

    protected function prepareEndpoint(NewsSource $source): NewsSource
    {
        return $this->pipeline
            ->send($source)
            ->through([
                Search::class,
                DateFrom::class,
                DateTo::class,
                Page::class,
            ])
            ->thenReturn();
    }
}
