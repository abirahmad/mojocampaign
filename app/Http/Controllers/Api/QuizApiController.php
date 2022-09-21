<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\JsonResponse;
use App\Models\QuestionOption;
use App\Models\QustionAnswer;
use App\Models\Response;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class QuizApiController extends Controller
{
    /**
     * @OA\POST(
     *     path="/api/quiz/check-answer",
     *     tags={"QuestionOption"},
     *     summary="Check Quiz Answer",
     *     description="Check quiz answer and Gives the response",
     * @OA\Parameter(
     *          name="question_id",
     *          description="Question id, eg; 2",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * @OA\Parameter(
     *          name="answer_id",
     *          description="Answer id, eg; 3",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * operationId="sampleFunctionWithDoc",
     *      @OA\Response(
     *          response=200,
     *          description="Contact Stored Response"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function checkAnswer(Request $request)
    {
        $checkAnswer = QuestionOption::select('is_correct')->whereId($request->answer_id)->first();
        $user = User::find($request->user_id);
        if (!is_null($user)) {
            if (is_null($checkAnswer)) {
                $this->storeResponse($request, false);
                return response()->json(['status' => false, 'message' => 'Unsuccessfull', 'total_answer' => 1], 200);
            } else {
                $this->storeResponse($request, $checkAnswer->is_correct);
                if ($checkAnswer->is_correct === 0) {
                    return response()->json(['status' => false, 'message' => 'Unsuccessfull', 'total_answer' => 0], 200);
                }
            }


            // Get total correct from response table
            $response = Response::find(session()->get('response_id'));
            if (is_null($response)) {
                $image = asset('public/assets/img/bottle/1.webp');
            } else {
                $image = asset('public/assets/img/bottle/' . (count($response->correct_answers) + 1) . '.webp');
            }
            return response()->json(['status' => true, 'message' => 'Successfull', 'image' => $image, 'total_answer' => $response->total_answer, 'redirect_route' => route('user.result', $response->id)], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Not authenticated !!'], 200);
        }
    }


    /**
     * @OA\GET(
     *     path="/api/quiz/get-options/{id}",
     *     tags={"getOptions"},
     *     summary="Get options for an answer",
     *     description="Get options for an answer",
     * @OA\Parameter(
     *          name="id",
     *          description="Question id, eg; 2",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      )
     */
    public function getOptions($id)
    {
        $options = QuestionOption::select('id')->whereQuestionId($id)->get();
        return response()->json(['status' => true, 'options' => $options], 200);
    }


    /**
     * @OA\POST(
     *     path="/api/quiz/store-response",
     *     tags={"storeResponse"},
     *     summary="Store a response for question answer",
     *     description="Store a response for question answer",
     * @OA\Parameter(
     *          name="id",
     *          description="Question id, eg; 2",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * @OA\Parameter(
     *          name="isCorrect",
     *          description="True",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      )
     */
    public function storeResponse(Request $request, $isCorrect)
    {
        $user = User::find($request->user_id);

        if (!is_null($user)) {
            // If session response_id is null/empty then create a response and put response_id in session
            if (session()->get('response_id') == null) {
                $response = $this->storeQuizResponse($request, $user, $isCorrect);
                session()->put('response_id', $response->id);
            } else {
                // Update the response data
                $response = Response::find(session()->get('response_id'));
                if (is_null($response)) {
                    $response = $this->storeQuizResponse($request, $user, $isCorrect);
                    $response->save();
                }

                $response->increment('total_answer');
                if ($isCorrect) {
                    $response->increment('total_correct');
                }
                $response->total_time = $response->total_time + $request->time;
                $response->save();
            }

            // Store new answer response
            $this->storeQuestionAnswerMultipleData($response, $request, $isCorrect);

            return response()->json(['status' => true, 'message' => 'Successfull'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Not authenticated !!'], 200);
        }
    }

    public function storeQuizResponse($request, $user, $isCorrect)
    {
        $response = new Response();
        $response->user_id = $user->id;
        $response->total_answer = 1;
        $response->total_time = $request->time;
        if ($isCorrect) {
            $response->total_correct = 1;
        }
        $response->date = Carbon::now();
        $response->status = 0;
        $response->save();
        return $response;
    }

    public function storeQuestionAnswerMultipleData($response, $request, $isCorrect)
    {
        $questionAnswer = new QustionAnswer();
        $questionAnswer->response_id = $response->id;
        $questionAnswer->question_id = $request->question_id;
        $questionAnswer->question_option_id = $request->answer_id;
        $questionAnswer->is_correct = $isCorrect;
        $questionAnswer->total_time =  $request->time;
        $questionAnswer->date = Carbon::now();
        $questionAnswer->save();
    }
}
