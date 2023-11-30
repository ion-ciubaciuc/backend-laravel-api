<?php

namespace App\Domain\NewsService;

class NewsSourceFactory
{
    const NEW_YORK_TIMES = 'new-york-times';

    const NEWS_API_ORG = 'news-api-org';

    const THE_GUARDIAN = 'the-guardian';

    /**
     * @throws UnsupportedNewsSourceException
     */
    public function make(string $sourceId): NewsSource
    {
        $sourceClass = match ($sourceId) {
            self::NEW_YORK_TIMES => NewYorkTimesSource::class,
            self::NEWS_API_ORG => NewsApiOrgSource::class,
            self::THE_GUARDIAN => TheGuardianSource::class,
            default => throw new UnsupportedNewsSourceException(
                "Unsupported news source: $sourceId"
            ),
        };

        return new $sourceClass();
    }
}
