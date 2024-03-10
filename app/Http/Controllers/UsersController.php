<?php

namespace App\Http\Controllers;


use App\Models\UserAnswer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index()
    {
        $userAnswer = UserAnswer::all();
        return new JsonResponse($userAnswer);
    }

    public function show(Request $request, $id)
    {
        $userAnswer = UserAnswer::find($id);

        if (!$userAnswer) {
            return new JsonResponse(['error' => 'Datos no encontrados'], 404);
        }

        return new JsonResponse($userAnswer);
    }



}
