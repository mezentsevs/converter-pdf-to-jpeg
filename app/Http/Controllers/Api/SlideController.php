<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\IndexSlideRequest;
use App\Jobs\DocumentConvertJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class SlideController extends Controller
{
    public function index(IndexSlideRequest $request): JsonResponse
    {
        $userId = $request->user()->id;
        $documentId = Cache::get('user_' . $userId . '_document_id');

        if (!$documentId) {
            return response()->json([
                'success' => false,
                'status' => 'not_found',
                'message' => __('documents.conversions.not_found'),
            ]);
        }

        $status = Cache::get(DocumentConvertJob::CACHE_PREFIX . $documentId);

        if (!$status) {
            Cache::forget('user_' . $userId . '_document_id');

            return response()->json([
                'success' => false,
                'status' => 'expired',
                'message' => __('documents.conversions.expired'),
            ]);
        }

        if ($status === 'processing' || $status === 'queued') {
            return response()->json([
                'success' => true,
                'status' => $status,
                'message' => __('documents.conversions.processing'),
            ]);
        }

        if ($status === 'error') {
            $error = Cache::get(DocumentConvertJob::CACHE_PREFIX . 'error_' . $documentId);
            Cache::forget('user_' . $userId . '_document_id');

            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => $error ?: __('documents.conversions.error'),
            ]);
        }

        if ($status === 'success') {
            $slides = Cache::get(DocumentConvertJob::CACHE_PREFIX . 'slides_' . $documentId);

            if ($slides) {
                Cache::forget('user_' . $userId . '_document_id');

                return response()->json([
                    'success' => true,
                    'status' => 'success',
                    'message' => __('documents.conversions.success'),
                    'document' => [
                        'id' => $documentId,
                    ],
                    'slides' => $slides,
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'status' => 'unknown',
            'message' => __('documents.conversions.unknown'),
        ]);
    }
}
