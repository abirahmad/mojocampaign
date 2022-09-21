<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Role;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
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
            $users = User::orderBy('id', 'desc')
                ->select(
                    'id',
                    'first_name',
                    'last_name',
                    'username',
                    'phone_no',
                    'email',

                )
                ->where('is_approved', 1)
                ->get();

            $datatable = DataTables::of($users)
                ->addIndexColumn()
                ->addColumn(
                    'action',
                    function ($row) {
                        $csrf = "" . csrf_field() . "";
                        $html = '<div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="' . route('admin.admins.edit', $row->id) . '">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                </div>
                            </div>
                            ';
                        return $html;
                    }
                )
                ->editColumn('name', function ($row) {
                    return $row->first_name . ' ' . $row->last_name;
                });
            $rawColumns = ['action', 'name'];
            return $datatable->rawColumns($rawColumns)
                ->make(true);
        }

        return view('backend.pages.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = DB::table('roles')->get();
        return view('backend.pages.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }


        $request->validate([
            'first_name'  => 'required|max:100',
            'username'  => 'required|max:100|unique:users,username',
            'email'  => 'required|max:100|unique:users,email',
            'password'  => 'required|max:100',
        ]);

        try {
            DB::beginTransaction();
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->username = $request->username;
            $user->phone_no = $request->phone_no;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->is_approved = $request->is_approved;
            $user->created_at = Carbon::now();
            $user->updated_at = Carbon::now();
            $user->assignRole($request->role);
            $user->save();


            Track::newTrack($user->username, 'New User was created');

            DB::commit();
            session()->flash('success', 'New User has been saved successfully !!');

            return redirect()->route('admin.admins.index');
        } catch (\Exception $e) {
            // session()->flash('db_error', 'Error On: '."File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            session()->flash('db_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        // dd($this->user->getRoleNames());
        $users = User::find($id);
        $roles = DB::table('roles')->get();
        // $roles_array = Role::get()->pluck('name', 'id');
        $userRole = $users->roles->first()->name;

        return view('backend.pages.admins.edit', compact('roles', 'users', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            return abort(403, 'You are not allowed to access this page !');
        }


        $request->validate([
            'first_name'  => 'required|max:100',
            'username'  => 'required|max:100',
            'email'  => 'required|max:100',
            'password'  => 'nullable|max:100',
        ]);

        try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->username = $request->username;
            $user->phone_no = $request->phone_no;
            $user->email = $request->email;
            if (!is_null($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->is_approved = $request->is_approved;
            $user->created_at = Carbon::now();
            $user->updated_at = Carbon::now();
            $user->roles()->detach();
            $user->assignRole($request->role);
            $user->save();

            Track::newTrack($user->username, 'User was Updated');

            DB::commit();
            session()->flash('success', 'User has been updated successfully !!');

            return redirect()->route('admin.admins.index');
        } catch (\Exception $e) {
            // session()->flash('db_error', 'Error On: '."File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            session()->flash('db_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
