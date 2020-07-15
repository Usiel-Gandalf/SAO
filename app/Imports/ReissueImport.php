<?php

namespace App\Imports;

use App\Medium;
use App\School;
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

class ReissueImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation,  WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;

    private $bimester;
    private $year;
    private $status;

    public function __construct($bimester, $status, $year)
    {
        $this->bimester = $bimester;
        $this->year = $year;
        $this->status = $status;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Medium::firstOrCreate(
            ['fol_form' => $row['FOL_FORM'] ?? $row['fol_form']],
            [
                'scholar_id' => $row['INT_ID'] ?? $row['int_id'],
                'school_id' => $row['CVE_ESC'] ?? $row['cve_esc'],
                'consignment' => $row['REMESA'] ?? $row['remesa'] ?? $row['IMPRESION'] ?? $row['impresion'],
                'bimester' => $this->bimester,
                'year' => $this->year,
                'status' => $this->status,
                'reissue' => 1,
            ]
        );
    }

    public function rules(): array
    {
        return [
            '*.fol_form' => 'required|integer|unique:media,fol_form',
            '*.int_id' => 'required|integer',
            '*.cve_esc' => 'required|string|exists:schools,id',
            '*.impresion' => 'required|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'fol_form.unique' => 'EL folio de formato ya esta registrado, se omitio el registro para evitar duplicidad',
            'fol_form.integer' => 'El folio de formato solo puede ser de tipo numerico, verificar el tipo de dato',
            'fol_form.required' => 'El folio de formato no puede estar vacio, verificar nuevamente',
            'int_id.required' => 'la clave del becario no puede estar vacio, verificar nuevamente',
            'int_id.integer' => 'la clave del becario solo puede ser de tipo numerico, verificar el tipo de dato',
            'cve_esc.required' => 'la clave de la escuela no puede estar vacia, verificar nuevamente',
            'cve_esc.string' => 'la clave de la escuela solo puede ser de tipo letras y numeros, verificar el tipo de dato',
            'cve_esc.exists' => 'Escuela no encontrada(clave), primero debe de registrarla en la seccion de escuelas e intentar nuevamente',
            'impresion.required' => 'la remesa no puede estar vacia, verificar nuevamente',
            'impresion.string' => 'la remesa solo puede ser de tipo letras y numeros, verificar el tipo de dato',
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
