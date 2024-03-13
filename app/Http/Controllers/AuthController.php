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
use Illuminate\Support\Facades\Storage;
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
        $user = User::with('userAnswers.question')->find($id);
        $userOnly = User::find($id);

        $userData = [
            'user' => $user->toArray(),
            'user_answers' => $user->userAnswers->map(function ($userAnswer) {
                return [
                    'question_name' => $userAnswer->question->question_name,
                    'answer' => $userAnswer->answer
                ];
            })->toArray()
        ];

        $userObject = [
            'user' => $userOnly,
            'user_answers' => $userData['user_answers']
        ];


        if (!$user) {
            return new JsonResponse([
                'error' => 'Usuario no encontrado'
            ], 404);
        }
        return new JsonResponse($userObject);
    }

    public function store(Request $request)
    {
        $userFirstname = $request->input('firstname');
        $userLastname = $request->input('lastname');
        $userEmail = $request->input('email');
        $userPhone = $request->input('phone');
        $userPassword = $request->input('password');
        $userCountry = $request->input('country');
        $userRole = $request->input('role');
        $userImage = $request->file('image');

        $user = User::create([
            'firstname' => $userFirstname,
            'lastname' => $userLastname,
            'email' => $userEmail,
            'phone' => $userPhone,
            'password' => $userPassword,
            'country' => $userCountry,
            'role' => $userRole,
            'image' => $userImage
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
            'role' => $request->input('role', $user->role),
            'image' => $request->file('image') ?? $user->image,
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
            'country' => $user->country,
            'role' => $user->role,
            'image' => $user->image,
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
                'role' => 'required|string|min:1',
                'image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
                'questions' => 'required|array',
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
                'image' => $request->file('image') ?? null,
            ]);

            $questions = $request->input('questions');

            if (!empty($questions)) {
                foreach ($questions as $question) {
                    UserAnswer::create([
                        'id_user' => $user->id,
                        'id_question' => $question['id'],
                        'answer' => $question['answer'],
                    ]);
                }
            }

            $contenidoCorreo = "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Registro Exitoso</title>
        </head>
        <body>
            <h1>¡Hola, $user->firstname!</h1>
            <p>Tu registro en nuestro sitio ha sido exitoso. ¡Bienvenido!</p>
        </body>
        </html>
    ";

            Mail::raw($contenidoCorreo, function ($message) use ($user) {
                $message->to($user->email)->subject('Registro Exitoso');
            });

            DB::commit();
            return new JsonResponse(["message" => "Usuario creado correctamente"]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return new JsonResponse(["error" => $th->getMessage()], 500);
        }
    }
}
