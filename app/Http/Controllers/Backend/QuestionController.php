<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Track;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\QuestionSet;
use App\Helpers\UploadHelper;
use App\Helpers\StringHelper;
use App\Models\QuestionImage;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
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
        if (is_null($this->user) || !$this->user->can('question.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        if (request()->ajax()) {
            $questions = Question::orderBy('id', 'asc')
                ->select(
                    'questions.id as id',
                    'questions.title as title'
                )
                ->get();

            $datatable = Datatables::of($questions)
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
                                    <a class="dropdown-item" href="' . route('admin.questions.edit', $row->id) . '">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="#deleteModal' . $row->id . '"
                                        data-toggle="modal"><i class="fa fa-trash"></i> Delete
                                    </a>
                                </div>
                            </div>
                            <div class="modal fade delete-modal" id=deleteModal' . $row->id . '  tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete ?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        All answers related to this question will be deleted too. Please
                                        be sure
                                        first to delete.
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <form action="' . action('Backend\QuestionController@destroy', [$row->id]) . '" method="post">' . $csrf . '
                                        <button type="submit" class="btn btn-outline-success"><i
                                                class="fa fa-check"></i> Confirm Delete</button>
                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i
                                                class="fa fa-times"></i> Close</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>      
                            ';
                        return $html;
                    }
                )
                ->addColumn(
                    'options',
                    function ($row) {
                        $question = Question::find($row->id);
                        $html = "<ol>";
                        foreach ($question->options as $option) {
                            if ($option->is_correct) {
                                $html .= '<li><strong style="color: green">' . $option->value . ' (Correct)</strong></li>';
                            } else {
                                $html .= '<li>' . $option->value . '</li>';
                            }
                        }
                        $html .= "</ol>";
                        return $html;
                    }
                );
            $rawColumns = ['action', 'title', 'options'];
            return $datatable->rawColumns($rawColumns)
                ->make(true);
        }


        return view('backend.pages.questions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('question.view')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        $questionSet = QuestionSet::orderBy('id', 'desc')->get();

        return view('backend.pages.questions.create', compact('questionSet'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('question.create')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        $request->validate([
            'title'  => 'required|max:100',
            'question_set_id'  => 'required',
            'first_answer'  => 'required|max:100',
            'second_answer'  => 'required|max:100',
            'third_answer'  => 'required|max:100',
            'fourth_answer'  => 'required|max:100',
            'first_point'  => 'required|max:100',
            'second_point'  => 'required|max:100',
            'third_point'  => 'required|max:100',
            'fourth_point'  => 'required|max:100',
            'is_correct'  => 'required'
        ]);

        try {
            DB::beginTransaction();
            $question = new Question();
            $question->title = $request->title;
            $question->question_set_id = $request->question_set_id;
            $question->status = 1;
            $question->created_at = Carbon::now();
            $question->updated_at = Carbon::now();
            $question->save();

            if ($question->save()) {
                // Store First Answer
                $questionOption = new QuestionOption();
                $questionOption->question_id = $question->id;
                $questionOption->value = $request->first_answer;
                $questionOption->is_correct = $request->is_correct === "first_answer" ? 1 : 0;
                $questionOption->value = $request->first_point;
                $questionOption->created_at = Carbon::now();
                $questionOption->updated_at = Carbon::now();
                $questionOption->save();

                // Store Second Answer
                $questionOption = new QuestionOption();
                $questionOption->question_id = $question->id;
                $questionOption->value = $request->second_answer;
                $questionOption->is_correct = $request->is_correct === "second_answer" ? 1 : 0;
                $questionOption->points = $request->second_point;
                $questionOption->created_at = Carbon::now();
                $questionOption->updated_at = Carbon::now();
                $questionOption->save();

                // Store Third Answer
                $questionOption = new QuestionOption();
                $questionOption->question_id = $question->id;
                $questionOption->value = $request->third_answer;
                $questionOption->is_correct = $request->is_correct === "third_answer" ? 1 : 0;
                $questionOption->points = $request->third_point;
                $questionOption->created_at = Carbon::now();
                $questionOption->updated_at = Carbon::now();
                $questionOption->save();

                // Store Fourth Answer
                $questionOption = new QuestionOption();
                $questionOption->question_id = $question->id;
                $questionOption->value = $request->fourth_answer;
                $questionOption->is_correct = $request->is_correct === "fourth_answer" ? 1 : 0;
                $questionOption->points = $request->fourth_point;
                $questionOption->created_at = Carbon::now();
                $questionOption->updated_at = Carbon::now();
                $questionOption->save();
            }

            Track::newTrack($request->title, 'New question created');

            DB::commit();
            session()->flash('success', 'New Question has been saved successfully !!');

            return redirect()->route('admin.questions.index');
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
        if (is_null($this->user) || !$this->user->can('question.edit')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        $questionSet = QuestionSet::orderBy('id', 'desc')->get();
        $questions = Question::find($id);
        $questionOptions = QuestionOption::whereQuestionId($id)->get();

        $questions->first_answer = $questionOptions[0]->value;
        $questions->second_answer = $questionOptions[1]->value;
        $questions->third_answer = $questionOptions[2]->value;
        $questions->fourth_answer = $questionOptions[3]->value;

        $questions->first_check = $questionOptions[0]->is_correct === 1 ? true : false;
        $questions->second_check = $questionOptions[1]->is_correct === 1 ? true : false;
        $questions->third_check = $questionOptions[2]->is_correct === 1 ? true : false;
        $questions->fourth_check = $questionOptions[3]->is_correct === 1 ? true : false;

        return view('backend.pages.questions.edit', compact('questionSet', 'questions'));
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

        if (is_null($this->user) || !$this->user->can('question.edit')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        $request->validate([
            'title'  => 'required|max:100',
            'question_set_id'  => 'required',
            'first_answer'  => 'required|max:100',
            'second_answer'  => 'required|max:100',
            'third_answer'  => 'required|max:100',
            'fourth_answer'  => 'required|max:100',
            'is_correct'  => 'required'
        ]);

        try {
            DB::beginTransaction();
            $question = Question::find($id);
            if (is_null($question)) {
                return redirect()->name('admin.questions.index');
            }

            $question->title = $request->title;
            $question->question_set_id = $request->question_set_id;
            $question->status = 1;
            $question->created_at = Carbon::now();
            $question->updated_at = Carbon::now();
            $question->save();

            if ($question->save()) {

                $questionOptions = QuestionOption::whereQuestionId($id)->get();
                $firstId = $questionOptions[0]->id;
                $secondId = $questionOptions[1]->id;
                $thirdId = $questionOptions[2]->id;
                $fourthId = $questionOptions[3]->id;

                // Update First Answer
                $questionOption = QuestionOption::find($firstId);
                $questionOption->question_id = $id;
                $questionOption->value = $request->first_answer;
                $questionOption->is_correct = $request->is_correct === "first_answer" ? 1 : 0;
                $questionOption->created_at = Carbon::now();
                $questionOption->updated_at = Carbon::now();
                $questionOption->save();

                // Update Second Answer
                $questionOption = QuestionOption::find($secondId);
                $questionOption->question_id = $id;
                $questionOption->value = $request->second_answer;
                $questionOption->is_correct = $request->is_correct === "second_answer" ? 1 : 0;
                $questionOption->created_at = Carbon::now();
                $questionOption->updated_at = Carbon::now();
                $questionOption->save();

                // Update Third Answer
                $questionOption = QuestionOption::find($thirdId);
                $questionOption->question_id = $id;
                $questionOption->value = $request->third_answer;
                $questionOption->is_correct = $request->is_correct === "third_answer" ? 1 : 0;
                $questionOption->created_at = Carbon::now();
                $questionOption->updated_at = Carbon::now();
                $questionOption->save();

                // Update Fourth Answer
                $questionOption = QuestionOption::find($fourthId);
                $questionOption->question_id = $id;
                $questionOption->value = $request->fourth_answer;
                $questionOption->is_correct = $request->is_correct === "fourth_answer" ? 1 : 0;
                $questionOption->created_at = Carbon::now();
                $questionOption->updated_at = Carbon::now();
                $questionOption->save();
            }

            Track::newTrack($request->title, 'Question updated');

            DB::commit();
            session()->flash('success', 'Question has been updated successfully !!');

            return redirect()->route('admin.questions.index');
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

        $question = Question::find($id);
        $message = "Question Not found !!";
        $messageType = "error";
        if (!is_null($question)) {

            // Delete question options
            DB::table('question_options')->where('question_id', $id)->delete();

            // Delete question
            $question->delete();
            $message = 'Question has been deleted successfully !';
            $messageType = "success";
            session()->flash($messageType, $messageType);
        } else {
            session()->flash($messageType, $message);
        }

        return back();
    }
}
