<?php

namespace App\Imports;
ini_set('max_execution_time', 1200);

use App\Scholar;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithValidation;

class ScholarsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue, WithValidation
{
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
        $Scholar = Scholar::where('id', $row['int_id'])->exists();
        if (!$Scholar) {
            return new Scholar([
                'id' => $row['INT_ID'] ?? $row['int_id'],
                'nameScholar' => $row['NOM_BEC'] ?? $row['nom_bec'] ?? null,
                'firstSurname' => $row['AP1'] ?? $row['ap1'] ?? null,
                'secondSurname' => $row['AP2'] ?? $row['ap2'] ?? null,
                'gender' => $row['GENERO'] ?? $row['genero'] ?? null,
                'birthDate' => $row['FEC_NAC'] ?? $row['fec_nac'] ?? $row['FECHA_NACIMIENTO'] ?? $row['fecha_nacimiento'] ?? null,
                'curp' =>  $row['CURP'] ?? $row['curp'] ?? null,
                'level' =>  $this->level,
            ]); 
        } 
    }

    public function rules(): array
    {
        return [
             'nom_bec' => function($attribute, $value, $onFailure) {
                  if ($value == '') {
                       $value = null;
                  }
              },
              'ap1' => function($attribute, $value, $onFailure) {
                if ($value == '') {
                     $value = null;
                }
            },
            'ap2' => function($attribute, $value, $onFailure) {
                if ($value == '') {
                     $value = null;
                }
            },
            'genero' => function($attribute, $value, $onFailure) {
                if ($value == '') {
                     $value = null;
                }
            },
            'fec_nac' => function($attribute, $value, $onFailure) {
                if ($value == [0-9] || $value == "") {
                     $value = null;
                }
            },
            'curp' => function($attribute, $value, $onFailure) {
                if ($value == "") {
                     $value = null;
                }
            },
                
        ];
    }
    
    public function batchSize(): int
    {
        return 300;
    }

    public function chunkSize(): int
    {
        return 300;
    }
}
