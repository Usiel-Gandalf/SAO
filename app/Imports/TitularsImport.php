<?php

namespace App\Imports;

ini_set('max_execution_time', 9600);

use App\Titular;
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

class TitularsImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation, WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Titular::firstOrCreate(
            ['id' => $row['FAM_ID'] ?? $row['fam_id']],
            [
                'nameTitular' => $row['NOM_TIT'] ?? $row['nom_tit'],
                'firstSurname' => $row['AP1'] ?? $row['ap1'],
                'secondSurname' => $row['AP2'] ?? $row['ap2'],
                'gender' => $row['GENERO'] ?? $row['genero'],
                'birthDate' => $row['FEC_NAC'] ?? $row['fec_nac'] ?? $row['FECHA_NACIMIENTO'] ?? $row['fecha_nacimiento'],
                'curp' =>  $row['CURP'] ?? $row['curp'],
            ]
        );
    }

    public function rules(): array
    {
        return [
            '*.fam_id' => 'required|integer|unique:titulars,id',
            '*.nom_tit' => 'required|string',
            '*.ap1' => 'required|string',
            '*.ap2' => 'required|string',
            '*.genero' => 'required|string',
            '*.fec_nac' => 'required|integer',
            '*.curp' => 'required|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'fam_id.unique' => 'La titular ya esta registrada, se omitio el registro para evitar duplicidad',
            'fam_id.integer' => 'La clave de titular(fam_id) solo puede ser de tipo numerico, verificar el tipo de dato',
            'fam_id.required' => 'La clave de la titular no puede estar vacia, verificar nuevamente',
            'nom_tit.required' => 'El nombre de la titular no puede estar vacio, verificar nuevamente',
            'nom_tit.string' => 'la clave de la titular solo puede ser de tipo texto, verificar el tipo de dato',
            'ap1.required' => 'El apellido paterno de la titular no puede estar vacio, verificar nuevamente',
            'ap1.string' => 'El apellido paterno de la titular solo puede ser de tipo texto, verificar el tipo de dato',
            'ap2.required' => 'El apellido materno de la titular no puede estar vacio, verificar nuevamente',
            'ap2.string' => 'El apellido materno de la titular solo puede ser de tipo texto, verificar el tipo de dato',
            'genero.required' => 'El genero de la titular no puede estar vacio, verificar nuevamente',
            'genero.string' => 'El genero de la titular solo puede ser de tipo texto(M-F), verificar el tipo de dato',
            'curp.required' => 'La curp de la titular no puede estar vacio, verificar nuevamente',
            'curp.string' => 'La curp de la titular solo puede ser de tipo texto, verificar el tipo de dato',
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
