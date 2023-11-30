<?php

namespace App\Domain\NewsService\Filter;

use App\Domain\NewsService\NewsSource;
use Closure;
use Illuminate\Http\Request;

abstract class Query
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    abstract public function handle(NewsSource $api, Closure $next): NewsSource;
}
