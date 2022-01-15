<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Vote;
use App\Models\Voter;
use Illuminate\Http\Request;
use PharIo\Version\Exception;

class ApiController extends Controller
{
    public function index()
    {
        $ballots = Portfolio::with("candidates", "candidates.party")->get();
        return response()->json(["success" => TRUE, "data" => $ballots]);
    }

    public function verify_id(Request $request)
    {
        $data = $request->scan;
        $scan = explode("\r\n", $data);
        $processed_national_id = "";
        try {
            $national_id = explode(":", $scan[0]);
            $processed_national_id = trim(str_replace("CIT M", "", $national_id[1]));
            $processed_national_id = trim(str_replace("-", "", $processed_national_id));
            $processed_national_id = trim(str_replace(" ", "", $processed_national_id));

        } catch (Exception $ex) {
            return response()->json(["success" => FALSE, "message" => "ID Card could not be processed, please try again!"]);
        }

        $voter = Voter::whereNationalId($processed_national_id)->first();
        if (!empty($voter)) {
            return response()->json(["success" => TRUE, "data" => $voter]);
        }
        return response()->json(["success" => FALSE, "message" => "You are not in the voters roll!"]);
    }

    public function vote(Request $request)
    {
        $check = Vote::whereVoterId($request->voter_id)
            ->whereElectionId($request->election_id)
            ->wherePortfolioId($request->portfolio_id)
            ->first();

        if (!empty($check)) {
            return response()->json(["success" => FALSE, "message" => "You have already voted on this category!"]);

        }
        $vote = new Vote();
        $vote->candidate_id = $request->candidate_id;
        $vote->voter_id = $request->voter_id;
        $vote->election_id = $request->election_id;
        $vote->portfolio_id = $request->portfolio_id;

        if ($vote->save()) {
            return response()->json(["success" => TRUE, "data" => $vote]);
        }
        return response()->json(["success" => FALSE, "message" => "Vote could not be accepted, make sure you have not already voted"]);
    }
}
