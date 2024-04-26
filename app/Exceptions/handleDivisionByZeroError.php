<?php

namespace App\Exceptions;

use Exception;
use DivisionByZeroError;

class handleDivisionByZeroError extends Exception
{
    protected function handleDivisionByZeroError(DivisionByZeroError $e)
{
    // Sesuaikan respons dengan kebutuhan aplikasi Anda
    return response()->json(['error' => 'Pembagian oleh nol terdeteksi.'], 500);
}
}
