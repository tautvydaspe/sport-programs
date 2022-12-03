<?php

namespace App\Http\Controllers;

use App\Models\PagrindinisProgramosTikslas;
use Illuminate\Http\Request;

class PagrindinisProgramosTikslasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PagrindinisProgramosTikslas::all();

//        $program = Programa::find(1);
//        $program->treneriai;

        //return Programa::orderBy('kaina', 'DESC')->get();
        return $data;
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
        $validatedData = $request->validate([
            'tikslas' => ['required', 'max:100', 'min:2'],
        ]);

        $newGoal = new PagrindinisProgramosTikslas;
        $newGoal->tikslas = $request->get("tikslas");

        $newGoal->save();

        return $newGoal;
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
        $validatedData = $request->validate([
            'tikslas' => ['required', 'max:100', 'min:2'],
        ]);

        $existingGoal = PagrindinisProgramosTikslas::find( $id );

        if( $existingGoal ) {
            $existingGoal->tikslas = $request->get("tikslas");
            $existingGoal->save();
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
        $existingGoal = PagrindinisProgramosTikslas::find($id);

        if ($existingGoal) {
            $existingGoal->delete();
            return "Goal successfully deleted.";
        }
        return "Goal not found";
    }
}
