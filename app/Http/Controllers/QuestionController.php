<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return new JsonResponse($questions);
    }

    public function show(Request $request, $id)
    {
        $question = Question::find($id);

        if (!$question) {
            return new JsonResponse(['error' => 'Pregunta no encontrada'], 404);
        }

        return new JsonResponse($question);
    }

    public function store(Request $request)
    {
        $questionName = $request->input('question_name');

        $question = Question::create([
            'question_name' => $questionName
        ]);

        return new JsonResponse($question);
    }

    public function update(Request $request, $id)
    {
        $questionName = $request->input('question_name');
        $question = Question::find($id);

        if (!$question) {
            return new JsonResponse(['error' => 'Pregunta no encontrada'], 404);
        }

        $question->update(['question_name' => $questionName]);

        return new JsonResponse($question);
    }
}
