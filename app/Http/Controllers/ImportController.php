<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RegionsImport;
use App\Imports\MunicipalitiesImport;
use App\Imports\LocalitiesImport;
use App\Imports\SchoolsImport;
use App\Imports\ScholarsImport;
use App\Imports\TitularsImport;
use App\Imports\BasicsImport;
use App\Imports\MediumsImport;
use App\Imports\HigersImport;

class ImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('onlyAdmin');
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
        } elseif ($level == 1) {
            $file = $request->file('universeInformation');
            Excel::queueImport(new TitularsImport, $file);
            return back()->with('titularAlert', 'Importacion de titulares con exito');
        } elseif ($level == 2 || $level == 3) {
            $file = $request->file('universeInformation');
            Excel::queueImport(new ScholarsImport($level), $file);
            return back()->with('scholarAlert', 'Importacion de alumnos exitoso');
        }
    }
    public function importRegion(Request $request)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'region' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('region');
        Excel::Import(new RegionsImport, $file);
        return back()->with('regionAlert', 'Importacion de regiones exitosa');
    }

    public function importMunicipality(Request $request)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'municipality' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('municipality');
        Excel::Import(new MunicipalitiesImport, $file);
        return back()->with('municipalityAlert', 'Importacion de municipios exitoso');
    }

    public function importLocality(Request $request)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'locality' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('locality');
        Excel::queueImport(new LocalitiesImport, $file);
        return back()->with('localityAlert', 'Importacion de localidades exitosa');
    }

    public function importSchool(Request $request)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'school' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('school');
        Excel::import(new SchoolsImport, $file);
        return back()->with('schoolAlert', 'Importacion de escuelas exitosa');
    }

    public function importBasic(Request $request)
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

        Excel::queueImport(new BasicsImport($type, $status, $bimester, $year), $file);
        return back()->with('basicAlert', 'Importacion de remesas de educacion basica fue exitosa');
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
}
