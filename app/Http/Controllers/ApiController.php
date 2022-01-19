<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Portfolio;
use App\Models\Vote;
use App\Models\Voter;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        $ballots = Portfolio::with("candidates", "candidates.party")->get();
        foreach($ballots as $ballot){
            $vote= Vote::whereVoterId($_GET["voter_id"])->wherePortfolioId($ballot->id)->first();
            $ballot->voted  = (empty($vote)) ? false : $vote->candidate_id;
        }
        return response()->json(["success" => TRUE, "data" => $ballots]);
    }

    public function verify_id(Request $request)
    {
        $data = $request->scan;
        $scan = explode("\r\n", $data);
        if(count($scan)<3){
            return response()->json(["success" => FALSE, "message" => "ID Card could not be processed, please try again!"]);

        }
        $processed_national_id = "";
        try {
            $national_id = explode(":", $scan[0]);
            $processed_national_id = trim(str_replace("CIT M", "", $national_id[1]));
            $processed_national_id = trim(str_replace("-", "", $processed_national_id));
            $processed_national_id = trim(str_replace(" ", "", $processed_national_id));

        } catch (Exception $ex) {
            return response()->json(["success" => FALSE, "message" => "ID Card could not be processed, please try again!"]);
        }
        try{
        $voter = Voter::whereNationalId($processed_national_id)->first();
        } catch (QueryException $ex) {
            return response()->json(["success" => FALSE, "message" => "Server could not be reached. DB Error!"]);
        }
        if (!empty($voter)) {
            return response()->json(["success" => TRUE, "data" => $voter]);
        }
        return response()->json(["success" => FALSE, "message" => "You are not in the voters roll!"]);
    }

    public function vote(Request $request)
    {
        $election = Election::whereActive(1)->first();
        //dd($election);
        $check = Vote::whereVoterId($request->voter_id)
            ->whereElectionId($election->id)
            ->wherePortfolioId($request->portfolio_id)
            ->first();

        if (!empty($check)) {
            return response()->json(["success" => FALSE, "message" => "You have already voted on this category!"]);

        }
        $vote = new Vote();
        $vote->candidate_id = $request->candidate_id;
        $vote->voter_id = $request->voter_id;
        $vote->election_id = $election->id;
        $vote->portfolio_id = $request->portfolio_id;

        if ($vote->save()) {
            return response()->json(["success" => TRUE, "data" => $vote]);
        }
        return response()->json(["success" => FALSE, "message" => "Vote could not be accepted, make sure you have not already voted"]);
    }
}
