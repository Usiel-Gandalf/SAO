<?php

namespace App\Imports;

ini_set('max_execution_time', 4800);

use App\Basic;
use App\Locality;
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



class BasicsImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation,  WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;
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
        if (Locality::where('id', '=', $row['claveofi'])->exists()) {
            
            Basic::firstOrCreate(
                ['fol_form' => $row['FOL_FORM'] ?? $row['fol_form'] ?? $row['FOLIO_FORM'] ?? $row['folio_form']],
                [
                    'titular_id' => $row['FAM_ID'] ?? $row['fam_id'],
                    'locality_id' => $row['CLAVEOFI'] ?? $row['claveofi'],
                    'consignment' =>  $row['REMESA'] ?? $row['remesa'],
                    'bimester' =>  $this->bimester,
                    'year' =>  $this->year,
                    'status' =>  $this->status,
                    'type' =>  $this->type,
                ]
            );
        } else {
            Basic::firstOrCreate(
                ['fol_form' => $row['FOL_FORM'] ?? $row['fol_form'] ?? $row['FOLIO_FORM'] ?? $row['folio_form']],
                [
                    'titular_id' => $row['FAM_ID'] ?? $row['fam_id'],
                    'locality_id' => null,
                    'consignment' =>  $row['REMESA'] ?? $row['remesa'],
                    'bimester' =>  $this->bimester,
                    'year' =>  $this->year,
                    'status' =>  $this->status,
                    'type' =>  $this->type,
                ]
            );
        }
    }

    public function rules(): array
    {
        return [
            'fam_id' => 'required|integer',
            'claveofi' => 'integer',
            'remesa' => 'required|string',
            '*.fol_form' => 'required|integer|unique:basics,fol_form',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
