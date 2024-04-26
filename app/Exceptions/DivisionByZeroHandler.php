<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class DivisionByZeroException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'message' => 'Terdapat pembagian dengan nol.',
            'status' => Response::HTTP_BAD_REQUEST,
        ]);
    }
}
