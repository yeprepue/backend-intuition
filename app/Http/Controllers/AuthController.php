<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {

            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }
        return response()->json(compact('token'));
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['messege' => 'logout']);
    }

    public function refresh()
    {
        $token = JWTAuth::refresh();
        return response()->json(compact('token'));
    }

    public function user()
    {
        $user = Auth::user();
        return response()->json(compact('user'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'role' => 'required|string|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'country' => $request->input('country'),
            'role' => $request->input('role'),
            'password' => bcrypt($request->input('password')),
        ]);

        $questions = $request->input('questions');

        foreach ($questions as $question) {
            UserAnswer::create([
                'id_user' => $user->id,
                'id_question' => $question['id'],
                'answer' => $question['answer'],
            ]);
        }

        $token = Auth::login($user);
        return response()->json(['token' => $token, 'user' => $user]);
    }
}
