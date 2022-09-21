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

class MonthlyWinnerController extends Controller
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
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('admin.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        if (request()->ajax()) {
            $monthlyWinners = Response::join('users', 'responses.user_id', '=', 'users.id')
                ->select(
                    'responses.id',
                    'responses.user_id',
                    'responses.date',
                    \DB::raw('(CASE WHEN responses.total_correct > 20 THEN 20 ELSE responses.total_correct END) AS total_correct'),
                    \DB::raw('(CASE WHEN responses.total_correct > 20 THEN 20 ELSE responses.total_correct END) AS total_correct_final'),
                    \DB::raw('(CASE WHEN responses.total_answer > 20 THEN 20 ELSE responses.total_answer END) AS total_answer'),
                    'responses.total_time',
                    DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS username"),
                )
                ->whereBetween('date', ['2020-05-01', '2020-05-31'])
                ->orderByRaw("total_correct_final DESC, responses.total_time ASC")
                ->get();

            $winnersArrayMonthly = [];
            $winnersArrayMonthlyUser = [];

            $j = 1;
            foreach ($monthlyWinners as $winner) {
                if (!in_array($winner->user_id, $winnersArrayMonthlyUser) && $j <= 3) {
                    $winnersArrayMonthlyUser[] = $winner->user_id;
                    $winnersArrayMonthly[] = $winner;
                    $j++;
                }
            }
            $monthlyWinners = $winnersArrayMonthly;

            $datatable = DataTables::of($monthlyWinners)
                ->addIndexColumn()
                ->editColumn('name', function ($row) {
                    return $row->first_name . ' ' . $row->last_name;
                });
            $rawColumns = ['action', 'name'];
            return $datatable->rawColumns($rawColumns)
                ->make(true);
        }

        return view('backend.pages.winners.monthly-winners');
    }
}
