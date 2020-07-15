<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Medium;
use App\School;

class MediumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mediums = Medium::where('school_id', null)->paginate(5);

        $mediumsBim1 = Medium::where('bimester', 1)->where('reissue', null)->get();
        $mediumsBim2 = Medium::where('bimester', 2)->where('reissue', null)->get();
        $mediumsBim3 = Medium::where('bimester', 3)->where('reissue', null)->get();
        $mediumsBim4 = Medium::where('bimester', 4)->where('reissue', null)->get();
        $mediumsBim5 = Medium::where('bimester', 5)->where('reissue', null)->get();

        $reissueBim1 = Medium::where('reissue', 1)->where('bimester', 1)->get();
        $reissueBim2 = Medium::where('reissue', 1)->where('bimester', 2)->get();
        $reissueBim3 = Medium::where('reissue', 1)->where('bimester', 3)->get();
        $reissueBim4 = Medium::where('reissue', 1)->where('bimester', 4)->get();
        $reissueBim5 = Medium::where('reissue', 1)->where('bimester', 5)->get();

        return view('user.mediums.index', compact(
            'mediums',
            'mediumsBim1',
            'mediumsBim2',
            'mediumsBim3',
            'mediumsBim4',
            'mediumsBim5',
            'reissueBim1',
            'reissueBim2',
            'reissueBim3',
            'reissueBim4',
            'reissueBim5'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all();
        return view('user.mediums.create', compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $request->validate([
            'scholar_id' => 'required|integer',
            'school_id' => 'required|string',
            'consignment' => 'required|string',
            'fol_form' => 'required|integer',
            'bimester' => 'required|integer',
            'year' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $medium = new Medium();
        $medium->scholar_id = $request->scholar_id;
        $medium->school_id = $request->school_id;
        $medium->consignment = $request->consignment;
        $medium->fol_form = $request->fol_form;
        $medium->bimester = $request->bimester;
        $medium->year = $request->year;
        $medium->status = $request->status;
        $medium->save();

        return redirect()->action('MediumController@index')->with('saveMedium', 'Nuevo registro de educacion media superior agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schools = School::all();
        $medium = Medium::findOrfail($id);
        return view('user.mediums.edit', compact('medium', 'schools'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'scholar_id' => 'required|integer',
            'school_id' => 'required|string',
            'consignment' => 'required|string',
            'fol_form' => 'required|integer',
            'bimester' => 'required|integer',
            'year' => 'required|integer',
            'status' => 'required|integer',
        ]);

        Medium::where('id', $id)->update($data);
        return redirect()->action('MediumController@index')->with('updateMedium', 'Informacion de educacion media superior actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Medium::destroy($id);
        return redirect()->action('MediumController@index')->with('deleteMedium', 'Registro eliminado correctamente');
    }

    public function mediumPdf()
    {
        $mediumsBim1 = Medium::where('bimester', 1)->where('reissue', null)->get();
        $mediumsBim2 = Medium::where('bimester', 2)->where('reissue', null)->get();
        $mediumsBim3 = Medium::where('bimester', 3)->where('reissue', null)->get();
        $mediumsBim4 = Medium::where('bimester', 4)->where('reissue', null)->get();
        $mediumsBim5 = Medium::where('bimester', 5)->where('reissue', null)->get();

        $reissueBim1 = Medium::where('reissue', 1)->where('bimester', 1)->get();
        $reissueBim2 = Medium::where('reissue', 1)->where('bimester', 2)->get();
        $reissueBim3 = Medium::where('reissue', 1)->where('bimester', 3)->get();
        $reissueBim4 = Medium::where('reissue', 1)->where('bimester', 4)->get();
        $reissueBim5 = Medium::where('reissue', 1)->where('bimester', 5)->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('user.mediums.mediumPdf', compact(
            'mediumsBim1',
            'mediumsBim2',
            'mediumsBim3',
            'mediumsBim4',
            'mediumsBim5',
            'reissueBim1',
            'reissueBim2',
            'reissueBim3',
            'reissueBim4',
            'reissueBim5'
        ));
        return $pdf->stream();
    }
}
