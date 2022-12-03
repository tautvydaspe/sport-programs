<?php

namespace App\Http\Controllers;
use App\Models\Treneris;
use Illuminate\Http\Request;

class TrenerisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Treneris::all();

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
            'vardas' => 'required',
            'pavarde' => 'required',
            'specializacija' => 'required',
            'issilavinimas' => 'required',
        ]);

        $newTrainer = new Treneris;
        $newTrainer->vardas = $request->get("vardas");
        $newTrainer->pavarde = $request->get("pavarde");
        $newTrainer->specializacija = $request->get("specializacija");
        $newTrainer->issilavinimas = $request->get("issilavinimas");

        $newTrainer->save();

        return $newTrainer;
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
        $existingTrainer = Treneris::find( $id );

        if( $existingTrainer ) {
            $existingTrainer->vardas = $request->get("vardas");
            $existingTrainer->pavarde = $request->get("pavarde");
            $existingTrainer->specializacija = $request->get("specializacija");
            $existingTrainer->issilavinimas = $request->get("issilavinimas");
            $existingTrainer->save();
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
        $existingTrainer = Treneris::find($id);

        if ($existingTrainer) {
            $existingTrainer->delete();
            return "Trainer successfully deleted.";
        }
        return "Trainer not found";
    }
}
