<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Http\Request;
use App\User;
use App\Models\Winner;
use App\Models\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Role;
use Yajra\DataTables\Facades\DataTables;

class DailyWinnerController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('admin.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        if (isset($_GET['date'])) {
            $date = $_GET['date'];
        } else {
            $date = date('Y-m-d');
        }


        // if (request()->ajax()) {
        $dailyWinners = Winner::join('users', 'winners.user_id', '=', 'users.id')
            ->select(
                'winners.id',
                'winners.user_id',
                'winners.date',
                'users.phone_no',
                'users.location',
                \DB::raw('(CASE WHEN winners.total_answer > 20 THEN 20 ELSE winners.total_answer END) AS total_correct'),
                \DB::raw('(CASE WHEN winners.total_answer > 20 THEN 20 ELSE winners.total_answer END) AS total_correct_final'),
                \DB::raw('(CASE WHEN winners.total_answer > 20 THEN 20 ELSE winners.total_answer END) AS total_answer'),
                'winners.total_time',
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS username")
            )
            ->where('date', '=', $date)
            ->orderByRaw("total_correct_final DESC, winners.total_time ASC")
            ->get();

        return view('backend.pages.winners.daily-winners',  compact('dailyWinners'));
    }
}
