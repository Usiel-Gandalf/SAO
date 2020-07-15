<?php

namespace App\Imports;

ini_set('max_execution_time', 1200);

use App\Locality;
use App\School;
use Exception;
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

class SchoolsImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation,  WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
            School::firstOrCreate(
                ['id' => $row['CVE_ESC'] ?? $row['cve_esc']],
                [
                    'nameSchool' => $row['NOM_ESC'] ?? $row['nom_esc'],
                    'locality_id' =>  $row['CLAVEOFI'] ?? $row['claveofi'],
                ]
            );
    }

    public function rules(): array
    {
        return [
            '*.cve_esc' => 'required|string|unique:schools,id',
            '*.nom_esc' => 'required|string',
            '*.claveofi' => 'required|integer|exists:localities,id',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'cve_esc.unique' => 'La escuela ya esta registrada, se omitio el registro para evitar duplicidad',
            'cve_esc.string' => 'La clave de la escuela solo puede ser de tipo texto(Letras y numeros), verificar el tipo de dato',
            'cve_esc.required' => 'La clave de la escuela no puede estar vacia, verificar nuevamente',
            'claveofi.required' => 'la clave de la localidad no puede estar vacia, verificar nuevamente',
            'claveofi.integer' => 'la clave de la escuela solo puede ser de tipo numerico, verificar el tipo de dato',
            'claveofi.exists' => 'Localidad no encontrada(clave), primero debe de registrarla en la seccion de localidades e intentar nuevamente',
            'remesa.required' => 'la remesa no puede estar vacia, verificar nuevamente',
            'nom_esc.string' => 'la remesa solo puede ser de tipo texto(Letras y numeros), verificar el tipo de dato',
            'nom_esc.required' => 'El nombre de la escuela no puede estar vacia, verificar nuevamente',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
