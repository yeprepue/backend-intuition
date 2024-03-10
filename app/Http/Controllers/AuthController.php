<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationEmail;
use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


    public function index()
    {
        $users = User::all();
        return new JsonResponse($users);
    }
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return new JsonResponse([
                'error' => 'Usuario no encontrado'
            ], 404);
        }
        return new JsonResponse($user);
    }

    public function  store(Request $request)
    {
        $userFirstname = $request->input('firstname');
        $userLastname = $request->input('lastname');
        $userEmail = $request->input('email');
        $userPhone = $request->input('phone');
        $userPassword = $request->input('password');
        $userCountry = $request->input('country');
        $userRole = $request->input('role');

        $user = User::create([
            'firstname' => $userFirstname,
            'lastname' => $userLastname,
            'email' => $userEmail,
            'phone' => $userPhone,
            'password' => $userPassword,
            'country' => $userCountry,
            'role' => $userRole
        ]);
        return new JsonResponse($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return new JsonResponse(['error' => 'Usuario no encontrado'], 404);
        }

        $user->update([
            'firstname' => $request->input('firstname', $user->firstname),
            'lastname' => $request->input('lastname', $user->lastname),
            'email' => $request->input('email', $user->email),
            'phone' => $request->input('phone', $user->phone),
            'password' => $request->input('password', $user->password),
            'country' => $request->input('country', $user->country),
            'role' => $request->input('role', $user->role)
        ]);

        return new JsonResponse(['message' => 'Usuario actualizado correctamente']);
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!Auth::attempt($credentials)) {
            return new JsonResponse(['error' => 'Credenciales incorrectas'], 401);
        }

        $user = Auth::user();
        $token = Auth::login($user);

        $response =  [
            'id' => $user->id,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'email' => $user->email,
            'role' => $user->role,
            'token' => $token
        ];

        return new JsonResponse($response);
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
        try {
            DB::beginTransaction();
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
            DB::commit();
            $activationLink = url('/activate/' . $user->activation_token);
            Mail::to($user->email)->send(new RegistrationEmail($user, $activationLink));


            return new JsonResponse(["message" => "Usuario creado correctamente"]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return new JsonResponse(["error" => $th]);
        }
    }
}
