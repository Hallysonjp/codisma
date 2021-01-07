<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create User
     *
     * @param [string] name
     * @param [string] email
     * @param [string] password
     * @param [string] password_confirmation
     * @param [string] messaage
     *
     */
    public function signup(Request $request)
    {

        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|string|email|unique:users',
            'password'  => 'required|string|confirmed'
        ]);

        $user = new User([
            'name' => $request->name,
            'age' => $request->age,
            'birthdate' => $request->birthdate,
            'genre' => $request->genre,
            'naturalidade' => $request->naturalidade,
            'estado_civil' => $request->estado_civil,
            'profissao' => $request->profissao,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();

        return response()->json([
            'message' => 'Usuário criado com sucesso!'
        ], 201);
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */

    public function index()
    {
        return View('auth.login');
    }

    public function register()
    {
        return View('auth.register');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json(['success' => false, 'message' => 'E-mail e/ou senha inválidos.'], 401);

        return redirect('/matriculas/listar');
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        auth()->logout();
        Session()->flush();

        return redirect('/entrar');
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
