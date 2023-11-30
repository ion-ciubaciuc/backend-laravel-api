<?php

namespace App\Http\Controllers;

use App\Domain\NewsService\NewsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request, NewsService $service): JsonResponse
    {
        $sources = (array) $request->get('sources');
        $articles = $service->useSources($sources)->getArticles();

        return response()->json($articles);
    }
}
