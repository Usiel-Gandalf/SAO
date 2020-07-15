<?php

namespace App\Imports;

ini_set('max_execution_time', 15000);

use App\Scholar;
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

class ScholarsImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation, WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;

    private $level;
    
    public function __construct($level)
    {
        $this->level = $level;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Scholar::firstOrCreate(
            ['id' => $row['INT_ID'] ?? $row['int_id']],
            [
                'nameScholar' => $row['NOM_BEC'] ?? $row['nom_bec'],
                'firstSurname' => $row['AP1'] ?? $row['ap1'],
                'secondSurname' => $row['AP2'] ?? $row['ap2'],
                'gender' => $row['GENERO'] ?? $row['genero'],
                'birthDate' => $row['FEC_NAC'] ?? $row['fec_nac'] ?? $row['FECHA_NACIMIENTO'] ?? $row['fecha_nacimiento'],
                'curp' =>  $row['CURP'] ?? $row['curp'],
                'level' =>  $this->level,
            ]
        );
    }

    public function rules(): array
    {
        return [
            '*.int_id' => 'required|integer|unique:scholars,id',
            '*.nom_bec' => 'required|string',
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
            'int_id.unique' => 'El becario ya esta registrado, se omitio el registro para evitar duplicidad',
            'int_id.integer' => 'La clave del becario(int_id) solo puede ser de tipo numerico, verificar el tipo de dato',
            'int_id.required' => 'La clave del becario no puede estar vacio, verificar nuevamente',
            'nom_bec.required' => 'El nombre del becario no puede estar vacio, verificar nuevamente',
            'nom_bec.string' => 'la clave del becario solo puede ser de tipo texto, verificar el tipo de dato',
            'ap1.required' => 'El apellido paterno del becario no puede estar vacio, verificar nuevamente',
            'ap1.string' => 'El apellido paterno del becario solo puede ser de tipo texto, verificar el tipo de dato',
            'ap2.required' => 'El apellido materno del becario no puede estar vacio, verificar nuevamente',
            'ap2.string' => 'El apellido materno del becario solo puede ser de tipo texto, verificar el tipo de dato',
            'genero.required' => 'El genero del becario no puede estar vacio, verificar nuevamente',
            'genero.string' => 'El genero del becario solo puede ser de tipo texto(M-F), verificar el tipo de dato',
            'curp.required' => 'La curp del becario no puede estar vacio, verificar nuevamente',
            'curp.string' => 'La curp del becario solo puede ser de tipo texto, verificar el tipo de dato',
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
