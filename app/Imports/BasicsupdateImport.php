<?php

namespace App\Imports;

ini_set('max_execution_time', 4800);

use App\Basic;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;

class BasicsupdateImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation,  WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;
    private $status;

    public function __construct($status)
    {
        $this->status = $status;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Basic::where('fol_form', $row['FOL_FORM'] ?? $row['fol_form'])
            ->update(['status' => $this->status]);
    }

    public function rules(): array
    {
        return [
            '*.fol_form' => 'required|integer|exists:basics,fol_form',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.fol_form.required' => 'El folio de formato no puede estar vacio, verificar nuevamente',
            '*.fol_form.integer' => 'El folio de formato solo puede ser de tipo numerico, verificar el tipo de dato',
            '*.fol_form.exists' => 'Folio de formato no encontrado, primero debe de registrar para poder actualizar',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 700;
    }

    public function chunkSize(): int
    {
        return 700;
    }
}
