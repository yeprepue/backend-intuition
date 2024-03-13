<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
    public function index()
    {
        $userAnswers = UserAnswer::all();
        return new JsonResponse($userAnswers);
    }

    public function show($id)
    {
        $userAnswer = UserAnswer::find($id);

        if (!$userAnswer) {
            return new JsonResponse(['error' => 'Datos no encontrados'], 404);
        }

        return new JsonResponse($userAnswer);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|exists:users,id',
            'id_question' => 'required|exists:questions,id',
            'answer' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $userAnswer = UserAnswer::create($validator->validated());

        return new JsonResponse($userAnswer, 201);
    }

    public function update(Request $request, $id)
    {
        $userAnswer = UserAnswer::find($id);

        if (!$userAnswer) {
            return new JsonResponse(['error' => 'Respuesta de usuario no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'answer' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $userAnswer->update($validator->validated());

        return new JsonResponse(['message' => 'Respuesta de usuario actualizada correctamente']);
    }
}
