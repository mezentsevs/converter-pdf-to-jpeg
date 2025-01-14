<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\IndexSlideRequest;
use Illuminate\Http\JsonResponse;

class SlideController extends Controller
{
    public function index(IndexSlideRequest $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'slides' => session()->pull('slides'),
        ]);
    }
}
