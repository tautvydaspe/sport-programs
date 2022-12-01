<?php

namespace App\Http\Controllers;

use App\Models\Atsiliepimas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AtsiliepimasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'atsiliepimas' => 'required|max:500',
            'pradinis_kuno_svoris_kg' => 'required',
            'dabartinis_kuno_svoris_kg' => 'required',
            'programos_tikslas' => 'required',
        ]);

        $newReview = new Atsiliepimas;
        $newReview->atsiliepimas = $request->get("atsiliepimas");
        $newReview->pradinis_kuno_svoris_kg = $request->get("pradinis_kuno_svoris_kg");
        $newReview->dabartinis_kuno_svoris_kg = $request->get("dabartinis_kuno_svoris_kg");
        $newReview->programos_tikslas = $request->get("programos_tikslas");
        $newReview->programa_id = $request->get("programa_id");
        $newReview->fk_vartotojasid_vartotojas  = Auth::guard('sanctum')->user()->id;

        $newReview->save();

        return $newReview;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
