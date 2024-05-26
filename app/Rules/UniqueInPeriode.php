<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\AlternatifModel;

class UniqueInPeriode implements ValidationRule
{
    private $nama;
    private $notelp;
    private $divisi;
    private $periode;
    private $ignoreId;

    public function __construct($nama, $notelp, $divisi, $periode, $ignoreId = null)
    {
        $this->nama = $nama;
        $this->notelp = $notelp;
        $this->divisi = $divisi;
        $this->periode = $periode;
        $this->ignoreId = $ignoreId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if there's an existing record with the same nama, notelp, divisi, and periode
        $existingRecord = AlternatifModel::where('nama', $this->nama)
            ->where('notelp', $this->notelp)
            ->where('periode', $this->periode)
            ->first();

        if ($existingRecord) {
            // If the divisi is the same and both nama and notelp are the same, reject
            if ($existingRecord->divisi == $this->divisi && $existingRecord->nama == $this->nama && $existingRecord->notelp == $this->notelp) {
                $fail('Data dengan nama dan no telepon yang sama sudah terdaftar di divisi yang sama di periode ini');
            }

            // If the divisi is the same but nama or notelp is different, accept
            return;
        }

        // Check if there's an existing record with the same nama, notelp, and periode
        $existingRecordDifferentDivisi = AlternatifModel::where('nama', $this->nama)
            ->where('notelp', $this->notelp)
            ->where('periode', $this->periode)
            ->where('divisi', '!=', $this->divisi) // Different divisi
            ->exists();

        if ($existingRecordDifferentDivisi) {
            $fail('Data sudah terdaftar dengan divisi yang berbeda di periode ini');
        }
    }
}
