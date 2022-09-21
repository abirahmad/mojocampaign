<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\QuestionSet;
use App\Helpers\UploadHelper;
use App\Helpers\StringHelper;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use DB;

class QuestionSetController extends Controller
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
        if (is_null($this->user) || !$this->user->can('question_set.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        if (request()->ajax()) {
            $questionSets = QuestionSet::orderBy('id', 'desc')->select('id', 'title')->get();
            $datatable = Datatables::of($questionSets)
                ->addIndexColumn()
                ->addColumn(
                    'action',
                    function ($row) {
                        $html = '<div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                               <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="' . route('admin.question-set.edit', $row->id) . '">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                </div>
                            </div>       
                            ';
                        return $html;
                    }
                );
            $rawColumns = ['action', 'title'];
            return $datatable->rawColumns($rawColumns)->make(true);
        }

        return view('backend.pages.question-set.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('question_set.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        return view('backend.pages.question-set.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('question_set.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        $request->validate([
            'title'  => 'required|max:100'
        ]);

        try {
            DB::beginTransaction();

            $questionSet = new QuestionSet();
            $questionSet->title = $request->title;
            $questionSet->save();
            Track::newTrack($request->title, 'New question set created');
            DB::commit();
            session()->flash('success', 'New Question Set has been saved successfully !!');

            return redirect()->route('admin.question-set.index');
        } catch (\Exception $e) {
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
        if (is_null($this->user) || !$this->user->can('question_set.edit')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        $questionSet = QuestionSet::find($id);

        return view('backend.pages.question-set.edit')->with(compact('questionSet'));
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
        if (is_null($this->user) || !$this->user->can('question_set.edit')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        $request->validate([
            'title'  => 'required|max:100'
        ]);

        try {
            DB::beginTransaction();
            $questionSet = QuestionSet::find($id);
            $questionSet->title = $request->title;
            $questionSet->created_at = Carbon::now();
            $questionSet->updated_at = Carbon::now();
            $questionSet->save();

            Track::newTrack($request->title, 'Question set was updated');

            DB::commit();
            session()->flash('success', 'Question set has been updated successfully !!');

            return redirect()->route('admin.question-set.index');
        } catch (\Exception $e) {
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
        if (is_null($this->user) || !$this->user->can('question.delete')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        $questionSet = QuestionSet::find($id);
        $message = "Question Category Not found !!";
        $messageType = "error";
        if (!is_null($questionSet)) {


            $contact->delete();
            $message = 'Brnad Category has been deleted successfully !';
            $messageType = "success";
            session()->flash($messageType, $messageType);
        } else {
            session()->flash($messageType, $message);
        }

        return back();
    }
}
