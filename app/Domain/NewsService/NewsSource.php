<?php

namespace App\Domain\NewsService;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Carbon;

interface NewsSource
{
    public function search(string $query): NewsSource;

    public function fromDate(Carbon $date): NewsSource;

    public function toDate(Carbon $date): NewsSource;

    public function page(int $page): NewsSource;

    public function get(): AnonymousResourceCollection;
}
