<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use Illuminate\Http\Request;

class VoterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voters = Voter::all();
        return view("voter.index", ["voters" => $voters]);

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $national_id = strtoupper(trim($request->national_id));
        $request->national_id = strtoupper(preg_replace("^\\s^", "", $national_id));
        $request->validate([
            'national_id' => array(
                'required',
                'unique:voters,national_id',
                'regex: [^\\d{2}-?\\d{6,7}-?[A-Za-z]{1}-?\\d{2}$]',
            ),
            'name' => 'required|string|max:100',
            'regnum' => 'required|string|unique:voters,regnum',
        ]);

        $voter = new Voter();
        $voter->national_id = $request->national_id;
        $voter->name = $request->name;
        $voter->regnum = $request->regnum;
        if ($voter->save()) {
            return back()->with("success", "Voter added successfully");
        }

        return back()->withErrors("Voter could not be added");

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Voter $voter
     * @return \Illuminate\Http\Response
     */
    public function show(Voter $voter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Voter $voter
     * @return \Illuminate\Http\Response
     */
    public function edit(Voter $voter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Voter $voter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voter $voter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Voter $voter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voter $voter)
    {
        //
    }
}
