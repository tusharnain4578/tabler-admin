<?php

namespace App\Services;
use Illuminate\Http\JsonResponse;

class ResponseService extends Service
{
    public function json(
        bool $success,
        ?string $message = null,
        mixed $data = null,
        ?array $toast = null,
        ?string $redirectTo = null
    ): JsonResponse {
        $responseArray = array_filter(get_defined_vars(), fn($val) => !is_null($val));
        return response()->json($responseArray);
    }



    public function errors(array $errors): JsonResponse
    {
        return response()->json(['errors' => $errors])->setStatusCode(422);
    }
}