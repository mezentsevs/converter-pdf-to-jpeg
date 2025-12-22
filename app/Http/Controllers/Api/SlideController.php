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
                'message' => 'No document found',
            ]);
        }

        $status = Cache::get(DocumentConvertJob::CACHE_PREFIX . $documentId);

        if (!$status) {
            Cache::forget('user_' . $userId . '_document_id');

            return response()->json([
                'success' => false,
                'status' => 'expired',
                'message' => 'Document conversion expired',
            ]);
        }

        if ($status === 'processing' || $status === 'queued') {
            return response()->json([
                'success' => true,
                'status' => $status,
                'message' => 'Document is being processed',
            ]);
        }

        if ($status === 'error') {
            $error = Cache::get(DocumentConvertJob::CACHE_PREFIX . 'error_' . $documentId);
            Cache::forget('user_' . $userId . '_document_id');

            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => $error ?: 'Document conversion failed',
            ]);
        }

        if ($status === 'success') {
            $slides = Cache::get(DocumentConvertJob::CACHE_PREFIX . 'slides_' . $documentId);

            if ($slides) {
                Cache::forget('user_' . $userId . '_document_id');

                return response()->json([
                    'success' => true,
                    'status' => 'success',
                    'slides' => $slides,
                    'success_message' => __('documents.conversions.success'),
                    'document' => [
                        'id' => $documentId,
                    ],
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'status' => 'unknown',
            'message' => 'Unknown status',
        ]);
    }
}
