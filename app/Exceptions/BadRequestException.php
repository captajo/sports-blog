<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BadRequestException extends Exception
{
    private $errorMessage;

    function __construct(string $message)
    {   
        $this->errorMessage = $message;
    }

    /**
     * Get the exception's context information.
     *
     * @return string
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json(['status' => 'failed', 'data' => $this->errorMessage]);
    }
}
