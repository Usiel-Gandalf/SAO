<?php

namespace App\Imports;
ini_set('max_execution_time', 4800);

use App\Basic;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithValidation;

class BasicsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue, WithValidation
{
    private $type;
    private $status;
    private $bimester;
    private $year;

    public function __construct($type, $status, $bimester, $year)
    {
        $this->type = $type;
        $this->status = $status;
        $this->bimester = $bimester;
        $this->year = $year;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($this->status == 0) {
            Basic::firstOrCreate(
                ['fol_form' => $row['FOL_FORM'] ?? $row['fol_form'] ?? $row['FOLIO_FORM'] ?? $row['folio_form']],
                [
                    'titular_id' => $row['FAM_ID'] ?? $row['fam_id'] ?? null,
                    'locality_id' => $row['CLAVEOFI'] ?? $row['claveofi'] ?? null,
                    'consignment' =>  $row['REMESA'] ?? $row['remesa'] ?? null,
                    'bimester' =>  $this->bimester ?? null,
                    'year' =>  $this->year ?? null,
                    'status' =>  $this->status ?? null,
                    'type' =>  $this->type ?? null,
                ]
            );

        } else {
             Basic::where('fol_form', $row['FOL_FORM'] ?? $row['fol_form'])
             ->where('titular_id', $row['FAM_ID'] ?? $row['fam_id'])
             ->where('consignment', $row['REMESA'] ?? $row['remesa'])
                ->update(['status' => $this->status]);
        }
    }

    public function rules(): array
    {
        return [
            'titular_id' => function ($attribute, $value, $onFailure) {
                if ($value == '') {
                    $value = null;
                }
            },
            'locality_id' => function ($attribute, $value, $onFailure) {
                if ($value == '') {
                    $value = null;
                }
            },
            'consignment' => function ($attribute, $value, $onFailure) {
                if ($value == '') {
                    $value = null;
                }
            },
            'fol_form' => function ($attribute, $value, $onFailure) {
                if ($value == '') {
                    $value = null;
                }
            },
            'bimester' => function ($attribute, $value, $onFailure) {
                if ($value == '') {
                    $value = null;
                }
            },
            'year' => function ($attribute, $value, $onFailure) {
                if ($value == '') {
                    $value = null;
                }
            },
            'status' => function ($attribute, $value, $onFailure) {
                if ($value == '') {
                    $value = null;
                }
            },
            'type' => function ($attribute, $value, $onFailure) {
                if ($value == '') {
                    $value = null;
                }
            },
        ];
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
