<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Http\Request;
use App\User;
use App\Models\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Role;
use Yajra\DataTables\Facades\DataTables;

class ResponseController extends Controller
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
            $responses = Response::orderBy('id', 'desc')
                ->join('users', 'responses.user_id', '=', 'users.id')
                ->select(
                    'responses.id',
                    'responses.date',
                    'responses.user_id',
                    'responses.total_answer',
                    'responses.total_correct',
                    'responses.total_time',
                    DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS username")
                )
                ->get();

            $datatable = DataTables::of($responses)
                ->addIndexColumn()
                ->editColumn('name', function ($row) {
                    return $row->first_name . ' ' . $row->last_name;
                });
            $rawColumns = ['action', 'name'];
            return $datatable->rawColumns($rawColumns)
                ->make(true);
        }

        return view('backend.pages.responses.index');
    }
}
