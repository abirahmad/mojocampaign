<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Track;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Blog;
use App\Helpers\UploadHelper;
use App\Helpers\StringHelper;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use DB;

class BlogsController extends Controller
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
        if (is_null($this->user) || !$this->user->can('blogs.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        if (request()->ajax()) {
            $blogs = Blog::orderBy('id', 'desc')
                ->select(
                    'id',
                    'title',
                    'slug',
                    'description',
                    'image'

                )
                ->get();

            // dd($pages);
            $datatable = Datatables::of($blogs)
                ->addColumn(
                    'action',
                    function ($row) {
                        $csrf = "" . csrf_field() . "";
                        // $method = "".method('delete')."";
                        $html = '<div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                               <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="' . route('admin.blogs.edit', $row->id) . '">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    
                                    <a class="dropdown-item" href="' . action('Backend\QuestionSetController@show', [$row->id]) . '">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                </div>
                            </div>       
                            ';
                        return $html;
                    }
                )
                ->editColumn('image', function ($row) {
                    $url = url("public/assets/backend/images/blogs/" . $row->image);
                    return '<a class="dropdown-item" href="#showModal' . $row->id . '" data-toggle="modal"><img class="report-min-img" src="' . $url . '"></a>

                      <div class="modal fade delete-modal" id="showModal' . $row->id . '" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">' . $row->title . '-Image</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img class="modal-max-img" src="' . $url . '">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i
                                                class="fa fa-times"></i> Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                })
                ->editColumn('description', function ($row) {
                    return  $row->description;
                });
            $rawColumns = ['action', 'image', 'description'];
            return $datatable->rawColumns($rawColumns)
                ->make(true);
        }


        return view('backend.pages.blogs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('blogs.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        return view('backend.pages.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('blogs.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        $request->validate([
            'title'  => 'required|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            DB::beginTransaction();
            $blogs = new Blog();
            $blogs->title = $request->title;
            if (is_null($request->slug)) {
                $blogs->slug = StringHelper::createSlug($request->title, 'Page', 'slug', '');
            } else {
                $blogs->slug = $request->slug;
            }

            if (!is_null($request->image)) {
                $blogs->image = UploadHelper::upload('image', $request->image, $request->title . '-' . time(), 'public/assets/backend/images/blogs');
            }
            $blogs->description = $request->description;
            $blogs->created_at = Carbon::now();
            $blogs->updated_at = Carbon::now();
            $blogs->save();

            Track::newTrack($request->title, 'New Blog created');

            DB::commit();
            session()->flash('success', 'New Blog post has been saved successfully !!');

            return redirect()->route('admin.questions.index');
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
        if (is_null($this->user) || !$this->user->can('blogs.edit')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        $blogs = Blog::find($id);

        return view('backend.pages.blogs.edit')->with(compact('blogs'));
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
        if (is_null($this->user) || !$this->user->can('blogs.edit')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        $request->validate([
            'title'  => 'required|max:100',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            DB::beginTransaction();
            $blogs = BLog::find($id);
            $blogs->title = $request->title;
            $blogs->slug = StringHelper::createSlug($request->title, 'Page', 'slug', '');

            if (!is_null($request->image)) {
                $blogs->image = UploadHelper::upload('image', $request->image, $request->title . '-' . time(), 'public/assets/backend/images/blogs');
            }
            $blogs->description = $request->description;
            $blogs->created_at = Carbon::now();
            $blogs->updated_at = Carbon::now();
            $blogs->save();

            Track::newTrack($request->title, 'blog was updated');

            DB::commit();
            session()->flash('success', 'Blog post has been updated successfully !!');

            return redirect()->route('admin.questions.index');
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
