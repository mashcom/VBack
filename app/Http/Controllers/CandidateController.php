<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\Party;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = Candidate::with('election','party','portfolio')->get();
        return view("candidate.index",["candidates"=>$candidates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parties = Party::all();
        $portfolios = Portfolio::all();
        $elections = Election::all();
        return view("candidate.create",compact("parties","portfolios","elections"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $national_id = strtoupper(trim($request->national_id));
        $request->national_id = strtoupper(preg_replace("^\\s^", "", $national_id));
        $request->validate([
            'national_id' => 'required|string|max:255|unique:candidates,national_id',
            'name' => 'required|string|max:100',
            'portfolio_id' => 'required',
            'election_id' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg|max:4048',
        ]);

        try{
            $imageName = sha1(time()) . '.' . $request->image->getClientOriginalExtension();
            $path = public_path('images/' . $imageName);
            $img = Image::make($request->image->getRealPath());
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($path);
        }catch (\Exception $ex){
            dd($ex->getMessage());
            return back()->withErrors("Error processing image. Please try again!");
        }

        $candidate = new Candidate();
        $candidate->name = $request->name;
        $candidate->national_id = $request->national_id;
        $candidate->portfolio_id = $request->portfolio_id;
        $candidate->party_id = $request->party_id;
        $candidate->election_id = $request->election_id;
        if ($request->image != null) {
            $candidate->image = $imageName;
        }

        if($candidate->save()){
            return back()->with("success","Candidate added successfully");
        }

        return back()->withErrors("Candidate could not be added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        //
    }
}
