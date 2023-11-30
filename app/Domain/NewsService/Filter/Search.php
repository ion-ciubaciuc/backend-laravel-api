<?php

namespace App\Domain\NewsService\Filter;

use App\Domain\NewsService\NewsSource;
use Closure;

class Search extends Query
{
    public function handle(NewsSource $api, Closure $next): NewsSource
    {
        $api->search($this->request->get('query') ?? '');

        return $next($api);
    }
}
