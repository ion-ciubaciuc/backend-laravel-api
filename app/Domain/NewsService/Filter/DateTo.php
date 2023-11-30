<?php

namespace App\Domain\NewsService\Filter;

use App\Domain\NewsService\NewsSource;
use Carbon\Exceptions\InvalidFormatException;
use Closure;
use Illuminate\Support\Carbon;

class DateTo extends Query
{
    public function handle(NewsSource $api, Closure $next): NewsSource
    {
        if ($date = $this->request->get('date_to')) {
            try {
                $date = Carbon::parse($date);
                $api->toDate($date);
            } catch (InvalidFormatException $e) {
            }
        }

        return $next($api);
    }
}
