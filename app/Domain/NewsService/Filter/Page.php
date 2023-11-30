<?php

namespace App\Domain\NewsService\Filter;

use App\Domain\NewsService\NewsSource;
use Closure;

class Page extends Query
{
    public function handle(NewsSource $api, Closure $next): NewsSource
    {
        $page = $this->request->get('page', 1);

        if (is_numeric($page) && $page >= 1) {
            $api->page($page);
        }

        return $next($api);
    }
}
