<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Track;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// use DB;
// use Illuminate\Support\Facades\DB as FacadesDB;

class RoleController extends Controller
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

        if (is_null($this->user) || !$this->user->can('permission.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        if (request()->ajax()) {
            $roles = DB::table('roles')->select('id', 'name')->get();

            // dd($pages);
            $datatable = Datatables::of($roles)
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
                                    <a class="dropdown-item" href="' . route('admin.roles.edit', $row->id) . '">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                </div>
                            </div>
                            ';
                        return $html;
                    }
                );
            $rawColumns = ['action'];
            return $datatable->rawColumns($rawColumns)
                ->make(true);
        }



        return view('backend.pages.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('permission.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        return view('backend.pages.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (is_null($this->user) || !$this->user->can('permission.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $request->validate([
            'name'  => 'required|max:100',
        ]);


        try {
            $role_name = $request->input('name');
            $permissions = $request->input('permissions');
            $role = Role::create([
                'name' => $role_name,
            ]);

            if (!empty($permissions)) {
                $role->syncPermissions($permissions);
            }
            Track::newTrack('New Role Created', 'New role created');

            session()->flash('success', 'New Role has been saved successfully !!');

            return redirect()->route('admin.roles.index');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('permission.edit')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        $role = Role::find($id);
        $permissions = DB::table('role_has_permissions')
            ->leftjoin('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where('role_id', $role->id)
            ->select('permissions.name')
            ->get();
        $role_permissions = [];
        foreach ($permissions as $role_perm) {
            $role_permissions[] = $role_perm->name;
        }
        return view('backend.pages.roles.edit', compact('role', 'role_permissions'));
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
        if (is_null($this->user) || !$this->user->can('permission.edit')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $request->validate([
            'name'  => 'required|max:100',
        ]);


        try {
            $role_name = $request->input('name');
            $permissions = $request->input('permissions');
            $role = Role::findOrFail($id);
            $role->name = $role_name;
            $role->save();

            if (!empty($permissions)) {
                $role->syncPermissions($permissions);
            }
            Track::newTrack('Role Updated', 'role updated');

            session()->flash('success', 'Role has been saved successfully !!');

            return redirect()->route('admin.roles.index');
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
