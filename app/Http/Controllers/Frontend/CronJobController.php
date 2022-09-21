<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Response;
use App\Models\Winner;
use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CronJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateWinner(Request $request)
    {
        if ($request->date) {
            $date = $request->date;
        } else {
            $date = date('Y-m-d', strtotime("-1 days"));
        }


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

        $winnersArrayUser = [];

        $i = 1;
        foreach ($dailyWinners as $winner) {
            if (!in_array($winner->user_id, $winnersArrayUser) && !in_array($winner->user_id, $previousWinnersArray) && $i <= 10) {
                $winnersArrayUser[] = $winner->user_id;

                $w = new Winner();
                $w->user_id = $winner->user_id;
                $w->type = 'daily';
                $w->date = $date;
                $w->total_answer = $winner->total_correct;
                $w->total_time = $winner->total_time;
                $w->created_at = Carbon::now();
                $w->updated_at = Carbon::now();
                $w->save();

                $i++;
            }
        }

        return redirect()->back();
    }
}
