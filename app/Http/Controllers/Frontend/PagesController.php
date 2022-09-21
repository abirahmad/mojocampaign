<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Response;
use App\Models\Winner;
use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ranking()
    {
        $date = date('Y-m-d');

        // List of previous winners
        $previousWinners = Winner::select('id', 'user_id')->get();
        $previousWinnersArray = [];
        foreach ($previousWinners as $previousWinner) {
            $previousWinnersArray[] = $previousWinner->user_id;
        }

        $dailyWinners = Response::join('users', 'responses.user_id', '=', 'users.id')
            ->select(
                'responses.id',
                'responses.user_id',
                'responses.date',
                \DB::raw('(CASE WHEN responses.total_correct > 20 THEN 20 ELSE responses.total_correct END) AS total_correct'),
                \DB::raw('(CASE WHEN responses.total_correct > 20 THEN 20 ELSE responses.total_correct END) AS total_correct_final'),
                \DB::raw('(CASE WHEN responses.total_answer > 20 THEN 20 ELSE responses.total_answer END) AS total_answer'),
                'responses.total_time',
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS username")
            )
            ->where('date', '=', $date)
            ->orderByRaw("total_correct_final DESC, responses.total_time ASC")
            ->get();

        $winnersArray = [];
        $winnersArrayUser = [];

        $i = 1;
        foreach ($dailyWinners as $winner) {
            if (!in_array($winner->user_id, $winnersArrayUser) && !in_array($winner->user_id, $previousWinnersArray) && $i <= 10) {
                $winnersArrayUser[] = $winner->user_id;
                $winnersArray[] = $winner;
                $i++;
            }
        }
        $dailyWinners = $winnersArray;


        $monthlyWinners = Response::join('users', 'responses.user_id', '=', 'users.id')
            ->select(
                'responses.id',
                'responses.user_id',
                'responses.date',
                \DB::raw('(CASE WHEN responses.total_correct > 20 THEN 20 ELSE responses.total_correct END) AS total_correct'),
                \DB::raw('(CASE WHEN responses.total_correct > 20 THEN 20 ELSE responses.total_correct END) AS total_correct_final'),
                \DB::raw('(CASE WHEN responses.total_answer > 20 THEN 20 ELSE responses.total_answer END) AS total_answer'),
                'responses.total_time',
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS username")
            )
            ->whereBetween('date', ['2020-05-01', '2020-05-31'])
            ->orderByRaw("total_correct_final DESC, responses.total_time ASC")
            ->get();

        $winnersArrayMonthly = [];
        $winnersArrayMonthlyUser = [];

        $j = 1;
        foreach ($monthlyWinners as $winner) {
            /*	       
            if($winner->total_correct > 20){
	        	$winner->total_correct = 20;
	        }
	        if($winner->total_answer > 20){
	        	$winner->total_answer= 20;
	        }
	        */
            if (!in_array($winner->user_id, $winnersArrayMonthlyUser) && $j <= 3) {
                $winnersArrayMonthlyUser[] = $winner->user_id;
                $winnersArrayMonthly[] = $winner;
                $j++;
            }
        }
        $monthlyWinners = $winnersArrayMonthly;

        $showDate = Carbon::now()->format('d M Y');
        return view('frontend.pages.ranking', compact('showDate', 'dailyWinners', 'monthlyWinners'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function result($response_id)
    {
        $response = Response::find($response_id);
        if ($response->total_correct > 20) {
            $response->total_correct = 20;
            $response->save();
        }
        if ($response->total_answer > 20) {
            $response->total_answer = 20;
            $response->save();
        }
        return view('frontend.pages.result', compact('response'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function history($user_id)
    {
        if (!Auth::check()) {
            session()->flash('sticky_error', 'Please login first to see your all results !!');
            session()->put('redirect_url', route('user.quizes.index'));
            return redirect('/login');
        }

        $histories = Response::whereUserId($user_id)->get();

        $username = User::select('first_name', 'last_name')
            ->whereId($user_id)
            ->first();

        return view('frontend.pages.history', compact('histories', 'username'));
    }
}
