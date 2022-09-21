<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Track;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Response;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Role;
use Yajra\DataTables\Facades\DataTables;

class QuizController extends Controller
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

        if (!Auth::check()) {
            session()->flash('sticky_error', 'Please login first to attend quiz !!');
            session()->put('redirect_url', route('user.quizes.index'));
            return redirect('/login');
        }

        // Check if session is null or not. 
        // if not null then returns only the questions which are not in the question_answers list
        $image=0;
        if (count(Question::select('id')->get()) === 0) {
            session()->flash('sticky_error', 'No questions has been added yet !');
            return redirect()->route('user.ranking');
        }

        if (session()->get('response_id') === null) {
            $question = Question::inRandomOrder()->first();
            $questionOptions = QuestionOption::whereQuestionId($question->id)->orderBy('id', 'asc')->get();
            $optionsInJson = response()->json($questionOptions);
            $image = asset('public/assets/img/bottle/1.webp');
        } else {
            $response = Response::find(session()->get('response_id'));
            if(!is_null($response)){
                $image = asset('public/assets/img/bottle/' . (count($response->correct_answers) + 1) . '.webp');
            }else{
                $image = asset('public/assets/img/bottle/' . (0+1) . '.webp');
            }
            

            if (is_null($response)) {
                $question = Question::inRandomOrder()->first();
                $questionOptions = QuestionOption::whereQuestionId($question->id)->orderBy('id', 'asc')->get();
                $optionsInJson = response()->json($questionOptions);
            } else {
                $answers = [];
                $total = 1;
                foreach ($response->answers as $answer) {
                    $answers[] = $answer->question_id;
                    $total++;
                }
                $question = Question::whereNotIn('id', $answers)->inRandomOrder()->first();
                if (is_null($question) || $total > 20) { // Max 20 questions
                    // Update response & redirect to result page
                    $response->status = 1;
                    $response->save();
                    session()->forget('response_id');
                    return redirect()->route('user.result', $response->id);
                } else {
                    $questionOptions = QuestionOption::whereQuestionId($question->id)->orderBy('id', 'asc')->get();
                    $optionsInJson = response()->json($questionOptions);
                }
            }
        }

        return view('frontend.pages.quizes.index', compact('question', 'questionOptions', 'optionsInJson', 'image'));
    }

    public function getRandomDataSets()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
