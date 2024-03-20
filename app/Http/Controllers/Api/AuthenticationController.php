<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Interfaces\UserInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    private $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => (int) config('sanctum.expiration')
        ];
    }

    public function login(Request $request){
        $rules = [
            'username' => 'required',
            'password' => 'required',
            'recaptcha' => 'nullable|string',
        ];

        $messages = [];

        $attributes = [
            'username' => 'Username',
            'password' => 'Password',
            'recaptcha' => 'Recaptcha',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'errors' => $validator->errors()
            ], 'Silahkan isi form dengan benar terlebih dahulu', 422);
        }

        $userAuth = $this->userInterface->findUserLogin(
            username: $request->username,
            password: $request->password
        );

        if (empty($userAuth)) {
            return ResponseFormatter::error(null, 'Data User tidak ditemukan', 401);
        }

        // if ($userAuth->is_active != true) {
        //     return ResponseFormatter::error(null, 'User anda telah diblokir', 401);
        // }

        return ResponseFormatter::success([
            'me' => (new UserResource($userAuth))->toArray($request),
            'auth' => $this->respondWithToken($userAuth->createToken('auth_token')->plainTextToken)
        ], 'User berhasil login');

        
    }

    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();

        return ResponseFormatter::success(null, 'User berhasil logout');
    }


    
    /**
     * @OA\Post(
     *   tags={"Api|Auth"},
     *   path="/api/auth/me",
     *   summary="Auth me",
     *   @OA\Response(response="default", ref="#/components/responses/globalResponse")
     * )
     */
    public function me()
    {
        $userAuth = $this->userInterface->findById(
            id: auth()->user()->id,
            withRelations: ['role']
        );

        return (new UserResource($userAuth))->additional([
            'status' => [
                'code' => 200,
                'message' => 'Data berhasil ditampilkan'
            ]
        ]);
    }
}
