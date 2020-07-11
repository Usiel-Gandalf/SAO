<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports;
use App\Imports\RegionsImport;
use App\Imports\MunicipalitiesImport;
use App\Imports\LocalitiesImport;
use App\Imports\SchoolsImport;
use App\Imports\ScholarsImport;
use App\Imports\TitularsImport;
use App\Imports\BasicsImport;
use App\Imports\MediumsImport;
use App\Imports\HigersImport;
use Exception;

class ImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('onlyAdmin');
    }

    public function importRegion(Request $request)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'region' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('region');
        
        try {
            Excel::Import(new RegionsImport, $file);
        } catch (Exception $e) {
            return back()->withError($e->getMessage());
        }
        return back()->with('regionAlert', 'Importacion de regiones exitosa');
    }

    public function importMunicipality(Request $request)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'municipality' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('municipality');

        try {
            Excel::Import(new MunicipalitiesImport, $file);
            
        } catch (Exception $e) {
            return back()->withError($e->getMessage());
        }
        
        return back()->with('municipalityAlert', 'Importacion de municipios exitoso');
    }

    public function importLocality(Request $request)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'locality' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('locality');

        try {
            Excel::queueImport(new LocalitiesImport, $file);
        } catch (Exception $e) {
            return back()->withError($e->getMessage());
        }
        
        return back()->with('localityAlert', 'Importacion de localidades exitosa');
    }

    public function importSchool(Request $request)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'school' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('school');

        try {
            Excel::import(new SchoolsImport, $file);
        } catch (Exception $e) {
            return back()->withError($e->getMessage());
        }
        
        return back()->with('schoolAlert', 'Importacion de escuelas exitosa');
    }

    public function importBasic(Request $request)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'basicUniverse' => 'required|mimes:xlsx, xls',
            'type' => 'required',
            'bimester' => 'required',
            'year' => 'required',
        ]);

        $type = $request->input('type');
        $status = 0;
        $bimester = $request->input('bimester');
        $year = $request->input('year');
        $file = $request->file('basicUniverse');

        try {
            Excel::queueImport(new BasicsImport($type, $status, $bimester, $year), $file);
        } catch (Exception $e) {
            return back()->withError($e->getMessage());
        }

        if($type == 1){
            return back()->with('importBasicAlert', 'La importacion de CERMS de educacion basica fue exitosa');
        }elseif ($type == 2) {
            return back()->with('importBasicAlert', 'La importacion de Avisos de cobro de educacion basica fue exitosa');
        }
    }

    public function updateBasic(Request $request)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'basicUniverse' => 'required|mimes:xlsx, xls',
            'type' => 'required',
            'status' => 'required',
            'bimester' => 'required',
            'year' => 'required',
        ]);

        $type = $request->input('type');
        $status = $request->input('status');
        $bimester = $request->input('bimester');
        $year = $request->input('year');
        $file = $request->file('basicUniverse');

        try {
            Excel::queueImport(new BasicsImport($type, $status, $bimester, $year), $file);
        } catch (Exception $e) {
            return back()->withError($e->getMessage());
        }

        if($type == 1){
            return back()->with('updateBasicAlert', 'La importacion de CERMS de educacion basica fue exitosa');
        }elseif ($type == 2) {
            return back()->with('updateBasicAlert', 'La importacion de Avisos de cobro de educacion basica fue exitosa');
        }
    }

    public function importMedium(Request $request)
    {
        $request->validate([
            'mediumUniverse' => 'required|mimes:xlsx, xls',
            'status' => 'required',
            'bimester' => 'required',
            'year' => 'required',
        ]);

        $status = $request->input('status');
        $bimester = $request->input('bimester');
        $year = $request->input('year');
        $file = $request->file('mediumUniverse');

        Excel::queueImport(new MediumsImport($status, $bimester, $year), $file);
        return back()->with('mediumAlert', 'Importacion de informacion exitosa');
    }

    public function importHiger(Request $request)
    {
        $request->validate([
            'higerUniverse' => 'required|mimes:xlsx, xls',
            'status' => 'required',
            'bimester' => 'required',
            'year' => 'required',
        ]);

        $status = $request->input('status');
        $bimester = $request->input('bimester');
        $year = $request->input('year');
        $file = $request->file('higerUniverse');

        Excel::queueImport(new HigersImport($status, $bimester, $year), $file);
        return back()->with('higerAlert', 'Informacion procesada exitosamente');
    }

    public function importScholar(Request $request)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'universeInformation' => 'required|mimes:xlsx, xls',
            'level' => 'required',
        ]);

        $level = $request->level;

        if ($level == "null") {
            return back()->with('level', 'Seleccione un nivel educativo');
        } 
        elseif ($level == 1) {
            $file = $request->file('universeInformation');
            try {
                Excel::queueImport(new TitularsImport, $file);
            } catch (Exception $e) {
                return back()->withError($e->getMessage());
            }
            return back()->with('titularAlert', 'Importacion de titulares con exito');
        } 
        elseif ($level == 2 || $level == 3) {
            $file = $request->file('universeInformation');
            try {
                Excel::queueImport(new ScholarsImport($level), $file);
            } catch (Exception $e) {
                return back()->withError($e->getMessage());
            }
            return back()->with('scholarAlert', 'Importacion de alumnos exitoso');
        }
    }
}
