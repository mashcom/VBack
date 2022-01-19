<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\Portfolio;
use App\Models\Vote;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elections = Election::all();
        return view("election.index", compact("elections"));
    }


    public function results()
    {
        $elections = Election::with("candidates.portfolio")->get();
        foreach ($elections as $election) {
            $portfolios = Portfolio::all();
            $election->portfolios = $portfolios;

            foreach ($election->portfolios as $portfolio) {
                $candidates = Candidate::with("party")->wherePortfolioId($portfolio->id)
                    ->whereElectionId($election->id)
                    ->get();
                foreach ($candidates as $candidate){
                    $votes = Vote::whereCandidateId($candidate->id)->whereElectionId($election->id)->count();
                    $candidate->votes = $votes;
                }
                $portfolio->candidates = $candidates;
            }
        }
       return view("election.results", compact("elections","portfolios"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:elections,name|string|max:100',
        ]);

        $election = new Election();
        $election->name = $request->name;
        if ($election->save()) {
            return back()->with("success", "Election added successfully");
        }

        return back()->withErrors("Election could not be added");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Election $election
     * @return \Illuminate\Http\Response
     */
    public function update_single(Request $request)
    {
        $elections = Election::all();
        foreach ($elections as $election){
            $election_save  = Election::find($election->id);
            $election_save->active=($request->id==$election->id)?1:0;
            $election_save->save();
        }
       return back()->with("success","Request successful");
    }


}
