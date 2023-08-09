<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    public function register($request)
    {
        $user               = new User();
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->phone        = $request->phone;
        $user->password     = Hash::make($request->password);
        $user->save();

        // Assign default user role
        $user->assignRole('Employee');


        // Revoke previous tokens and craete new one (access token only)
        // $token = $this->createToken($user);
        // $user->access_token = $token;


        // Revoke previous tokens and craete new one (both access and refresh token)
        $token = $this->createToken($user);
        $user->access_token = $token['access_token']->accessToken;
        $user->refresh_token = $token['refresh_token']->accessToken;

        return $user;
    }


    public function login($request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return ['data' => 'Error!', 'message' =>'Invalide email.', 'status' => 404];
        }

        if (!Hash::check($request->password, $user->password)) {
            return ['data' => 'Error!', 'message' => 'Invalide password.', 'status' => 401];
        }


        if (auth()->guard('api')->setUser($user)) {
            $user = auth()->user();
            $user->roles->pluck('name');

            // Revoke previous tokens and craete new one (access token only)
            // $token = $this->createToken($user);
            // $user->access_token = $token;


            // Revoke previous tokens and craete new one (both access and refresh token)
            $token = $this->createToken($user);
            $user->access_token = $token['access_token']->accessToken;
            $user->refresh_token = $token['refresh_token']->accessToken;

            return ['data' => $user, 'message' => 'User login successfully.', 'status' => 200];
        } else {
            return ['data' => 'Error!', 'message' =>'The provided credentials are incorrect.', 'status' => 401];
        }
    }


    public function refresh()
    {
        $user = auth()->guard('api')->user();

        // Revoke previous tokens and craete new one (both access and refresh token)
        $token = $this->createToken($user);
        $user->access_token = $token['access_token']->accessToken;
        $user->refresh_token = $token['refresh_token']->accessToken;

        return $user;
    }


    public function createToken($user)
    {
        $user->tokens()?->delete();
        // return $user->createToken('AccessToken')->accessToken;

        // Generate an access token with read-data scope that expires after 60*24 minutes
        $accessToken = $user->createToken('AccessToken', ['access']);
        $accessToken->token->expires_at = now()->addMinutes(60 * 24);
        $accessToken->token->save();

        // Generate another access token with write-data scope that expires after 60*24*7 minutes
        $refreshToken = $user->createToken('RefreshToken', ['refresh']);
        $refreshToken->token->expires_at = now()->addMinutes(60 * 24 * 7);
        $refreshToken->token->save();

        return ['access_token' => $accessToken, 'refresh_token' => $refreshToken];
    }
}
