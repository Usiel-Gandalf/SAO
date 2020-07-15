<?php

namespace App\Imports;

ini_set('max_execution_time', 1200);

use App\Locality;
use App\Municipality;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Exception;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;

class LocalitiesImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation,  WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
            Locality::firstOrCreate(
                ['id' => $row['CLAVEOFI'] ?? $row['claveofi']],
                [
                    'keyLocality' => $row['CVE_LOC'] ?? $row['cve_loc'],
                    'nameLocality' => $row['NOM_LOC'] ?? $row['nom_loc'],
                    'municipality_id' =>  $row['CVE_MUN'] ?? $row['cve_mun'],
                ]
            );
    }

    public function rules(): array
    {
        return [
            '*.claveofi' => 'required|integer|unique:localities,id',
            '*.cve_mun' => 'required|integer|exists:municipalities,id',
            '*.cve_loc' => 'required|integer',
            '*.nom_loc' => 'required|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'claveofi.required' => 'la clave de la localidad no puede estar vacia, verificar nuevamente',
            'claveofi.integer' => 'la clave de la escuela solo puede ser de tipo numerico, verificar el tipo de dato',
            'claveofi.unique' => 'La localidad ya esta registrada, se omitio el registro para evitar duplicidad',
            'cve_mun.required' => 'La clave del municipio no puede estar vacio, verificar nuevamente',
            'cve_mun.integer' => 'la clave del municipio solo puede ser de tipo numerico, verificar el tipo de dato',
            'cve_mun.exists' => 'Municipio no encontrado(clave), primero debe de registrarla en la seccion de municipios e intentar nuevamente',
            'cve_loc.required' => 'El numero de la localidad no puede estar vacio, verificar nuevamente',
            'cve_loc.integer' => 'El numero de la localidad solo puede ser de tipo numerico, verificar el tipo de dato',
            'nom_loc.string' => 'El nombre de la localidad solo puede ser de tipo texto(Letras y numeros), verificar el tipo de dato',
            'nom_loc.required' => 'El nombre de la localidad no puede estar vacia, verificar nuevamente',
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
