<?php

namespace App\Imports;
ini_set('max_execution_time', 1200);

use App\Higer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;

class HigersImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue
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
            Higer::firstOrCreate(
                ['fol_form' => $row['FOL_FORM'] ?? $row['fol_form']],
                [
                    'scholar_id' => $row['INT_ID'] ?? $row['int_id'] ?? $row['INTID'] ?? $row['intid'],
                    'school_id' => $row['CVE_ESC'] ?? $row['cve_esc'],
                    'consignment' =>  $row['REMESA'] ?? $row['remesa'] ?? $row['IMPRESION'] ?? $row['impresion'],
                    'bimester' =>  $this->bimester ?? null,
                    'year' =>  $this->year ?? null,
                    'status' =>  $this->status ?? null,
                ]
            );
        } else {
            Higer::where('fol_form', $row['FOL_FORM'] ?? $row['fol_form'])
                ->where('scholar_id', $row['INT_ID'] ?? $row['int_id'] ?? $row['INTID'] ?? $row['intid'])
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
