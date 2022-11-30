<?php

namespace App\Http\Controllers;

use App\Models\Atsiliepimas;
use Illuminate\Http\Request;
use App\Models\Programa;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *tr
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Programa::join('pagrindinis_programos_tikslas', 'pagrindinis_programos_tikslas.id_pagrindinis_programos_tikslas', '=', 'programa.fk_tikslas_id')
            ->get(['programa.id', 'programa.pavadinimas', 'programa.trukme_sav', 'programa.kaina', 'programa.programos_pagrindine_dirbama_raumenu_grupe', 'programa.nuotrauka', 'pagrindinis_programos_tikslas.tikslas']);

//        $program = Programa::find(1);
//        $program->treneriai;

        //return Programa::orderBy('kaina', 'DESC')->get();
        return $data;
    }

    /**
     * Get single program data.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function singleProgramIndex($id)
    {
//        $singleProgramData = Programa::find($id);
//        $tempId = intval($singleProgramData->id);
//        //$data = Programa::join('sudaro', 'sudaro.fk_programaid', '=', intval($tempId))
//            //->get();
//
//        $data = DB::table('programa')->get();

        $program = Programa::find($id);

        //return $program->treneriai;
        //return view('program-page')->with('program', $program);
        return $program;
    }

    /**
     * Get single program data.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function singleProgramTrainers($id)
    {
        $program = Programa::find($id);

        return $program->treneriai;
    }

    /**
     * Get single program data.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function singleProgramReviews($id)
    {
        $program = Programa::find($id);

        return $program->atsiliepimai;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newProgram = new Programa;
        //$newMainGoal = new PagrindinisProgramosTikslas;
        $newProgram->pavadinimas = $request->get("pavadinimas");
        $newProgram->trukme_sav = $request->get("trukme_sav");
        $newProgram->kaina = $request->get("kaina");
        $imageName = time().'.'.$request->nuotrauka->getClientOriginalExtension();
        $request->nuotrauka->move(public_path('images'), $imageName);
            $image = $request->file('image');
            $filename = time().'.'.$request->nuotrauka->getClientOriginalExtension();
            $newProgram->nuotrauka = $filename;
        $newProgram->fk_tikslas_id = $request->get("fk_tikslas_id");
        //$newMainGoal->tikslas = $request->pagrindinis_programos_tikslas["tikslas"];

        $newProgram->save();
        //$newMainGoal->save();

        return $newProgram;
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
        //
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
        $existingProgram = Programa::find( $id );

        if( $existingProgram ) {
            $existingProgram->pavadinimas =  $request->get('pavadinimas');
            $existingProgram->trukme_sav = $request->get('trukme_sav');
            $existingProgram->kaina = $request->get('kaina');
            $existingProgram->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingProgram = Programa::find($id);

        if ($existingProgram) {
            $existingProgram->delete();
            return "Item successfully deleted.";
        }
        return "Item not found";
    }
}
