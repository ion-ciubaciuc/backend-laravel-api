<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserSettingsRequest;

class UserSettingsController extends Controller
{
    public function update(UserSettingsRequest $request): JsonResponse
    {
        $request->user()->update([
            'personal_feed_settings' => [
                'sources' => $request->json('sources')
            ]
        ]);

        return response()->json();
    }
}
