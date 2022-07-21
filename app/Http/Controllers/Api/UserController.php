<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $token_request = compact('token');
        $token = $token_request['token'];

        $user = auth()->user();
        $role = $user->roles[0]['name'];
        
        if( $user['state_id'] === 1 ){

            return response()->json([
                'success' => true,
                'token' => $token_request['token'], 
                'role' => $role
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                "response" => "Usuario inactivo por no cumplir nuetsros términos y condiciones"
            ], 401);
        }

    }

    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        $user = [
            'id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'last_name' => auth()->user()->last_name,
            'email' => auth()->user()->email,
            'role' => auth()->user()->roles[0]['name']
        ];

        return response()->json([
            'success' => true,
            'user' => $user,
        ], 200);
    }


    public function register(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'user_name' => 'required|unique:users',
        //     'name' => 'required|string|max:30',
        //     'last_name' => 'required|string|max:30',
        //     'email' => 'required|string|email|max:40|unique:users',
        //     'password' => 'required|string|min:6|confirmed',
        // ]);
        
        $customMessages = [
            'message' => 'Los datos ingresados son onvalidos',
            'required' => 'Cuidado!! el campo del :attribute no se admite vacío',
            'unique' => 'Este :attribute ya existe, ingrese otro',
            'min' => 'El campo :attribute debe se mayor a 6 digitos',
            'max' => 'El campo :attribute debe se menor a 30 digitos',
        ];

        $request->validate([
            'user_name' => 'required|unique:users',
            'name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'email' => 'required|string|email|max:30|unique:users',
            'password' => 'required|string|min:6',
        ], $customMessages);

        $user = User::create([
            'user_name' => $request->get('user_name'),
            'name' => $request->get('name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'state_id' => 1
        ])->assignRole('user');

        $token = JWTAuth::fromUser($user);

        $user = [
            'id' => $user['id'],
            'user_name' => $user['user_name'],
            'name' => $user['name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'state_id' => $user['state_id'],
            'role' => $user['roles'][0]->name,
        ];

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function logout()
    {

        Auth::guard('api')->logout();

        return response()->json([
            'success' => true,
            'message' => 'logout'
        ], 200);
    }

    public function validate_jwt(){
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json([
            'success' => true
        ], 200);
    }
}
