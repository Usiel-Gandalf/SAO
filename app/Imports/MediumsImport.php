<?php

namespace App\Imports;
ini_set('max_execution_time', 4800);

use App\Medium;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;

class MediumsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue
{
    private $status;
    private $bimester;
    private $year;

    public function __construct($status, $bimester, $year)
    {
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
            Medium::firstOrCreate(
                ['fol_form' => $row['FOL_FORM'] ?? $row['fol_form']],
                [
                    'scholar_id' => $row['INT_ID'] ?? $row['int_id'] ?? null,
                    'school_id' => $row['CVE_ESC'] ?? $row['cve_esc'] ?? null,
                    'consignment' =>  $row['REMESA'] ?? $row['remesa'] ?? $row['IMPRESION'] ?? $row['impresion'] ?? null,
                    'bimester' =>  $this->bimester ?? null,
                    'year' =>  $this->year ?? null,
                    'status' =>  $this->status ?? null,
                ]
            );
        } else {
            Medium::where('fol_form', $row['FOL_FORM'] ?? $row['fol_form'])
                ->where('scholar_id', $row['INT_ID'] ?? $row['int_id'])
                ->where('consignment', $row['REMESA'] ?? $row['remesa'] ?? $row['IMPRESION'] ?? $row['impresion'])
                ->update(['status' => $this->status]);
        }
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
