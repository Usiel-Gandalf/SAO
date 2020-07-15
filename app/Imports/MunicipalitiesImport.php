<?php

namespace App\Imports;

use App\Municipality;
use App\Region;
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


class MunicipalitiesImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation,  WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Municipality::firstOrCreate(
            ['id' => $row['cve_mun'] ?? $row['CVE_MUN']],
            [
                'nameMunicipality' => $row['nom_mun'] ?? $row['NOM_MUN'],
                'region_id' =>  $row['cve_reg'] ?? $row['CVE_REG'],
            ]
        );
    }

    public function rules(): array
    {
        return [
            '*.cve_mun' => 'required|integer|unique:municipalities,id',
            '*.nom_mun' => 'required|string',
            '*.cve_reg' => 'required|integer|exists:regions,id',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'cve_mun.required' => 'La clave del municipio no puede estar vacio, verificar nuevamente',
            'cve_mun.integer' => 'la clave del municipio solo puede ser de tipo numerico, verificar el tipo de dato',
            'cve_mun.unique' => 'El municipio ya esta registrado, se omitio el registro para evitar duplicidad',
            'cve_reg.required' => 'La clave de la region no puede estar vacia, verificar nuevamente',
            'cve_reg.integer' => 'El numero de la localidad solo puede ser de tipo numerico, verificar el tipo de dato',
            'cve_reg.exists' => 'Region no encontrado(clave), primero debe de registrarla en la seccion de municipios e intentar nuevamente',
            'nom_mun.string' => 'El nombre del municipio solo puede ser de tipo texto(Letras y numeros), verificar el tipo de dato',
            'nom_mun.required' => 'El nombre del municipio no puede estar vacio, verificar nuevamente',
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
