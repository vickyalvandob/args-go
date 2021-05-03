<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PasswordRequest;
use Session;
use Carbon\Carbon;
use Alert;
use App\User;
use Validator;
use App\General;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{

    /**
     *  @group  Authentication
     *
    * Login
    *
    * @bodyParam username string required
    * @bodyParam password string required
    *
    * @response  {
    *"data": [
    *    {
    *        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC93ZWJtYXN0ZXIudGVzdFwvYXBpXC9sb2dpbiIsImlhdCI6MTYxOTM4MzY4MywiZXhwIjoxNjE5Mzg3MjgzLCJuYmYiOjE2MTkzODM2ODMsImp0aSI6InltTmRZV2U4SHFLeGxPdm0iLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.y9l9cci70N8um7RzsRs0ziMqVR0VTy3ODJaZU5SFwn4",
    *        "token_type": "bearer",
    *        "expires_in": 3600,
    *        "user": {
    *            "id": 1,
    *            "name": "user",
    *            "username": "user",
    *            "email": "user@gmail.com",
    *            "email_verified_at": null,
    *            "image": "default.png",
    *            "address": null,
    *            "city": null,
    *            "country": null,
    *            "zipcode": null,
    *            "phone": null,
    *            "birth": null,
    *            "balance": 0,
    *            "coin_gast": 0,
    *            "coin_ttg": 0,
    *            "energy": 0,
    *            "energy_quota": 0,
    *            "created_at": "2021-04-24 06:19:21",
    *            "updated_at": "2021-04-26 01:58:05"
    *           }
    *       }

    *   ]
    *}

    */
    public function login()
    {
        $credentials = request(['username', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error'=>true, 'message'=>'Invalid Credentials']);
        }

        return $this->respondWithToken($token);
    }

    /**
     *  @group Authentication
     *
     * Register
     *
    * @bodyParam  name string required
    * @bodyParam  email string required
    * @bodyParam  username string required
    * @bodyParam  password string required
    * @bodyParam  password_confirmation string required
    * @bodyParam  phone string
    * @bodyParam  zipcode string
    * @bodyParam  city string
    * @bodyParam  birth date
    * @bodyParam  address text
    *
    * @response  {
        * "data": [
        * {
            *  "message": "User successfully registered",
            *  "user": {
            *      "name": "user2",
            *      "email": "user2@gmail.com",
            *      "username": "user2",
            *      "phone": null,
            *      "zipcode": null,
            *      "city": null,
            *      "birth": null,
            *      "address": null,
            *      "updated_at": "2021-04-26 06:24:37",
            *      "created_at": "2021-04-26 06:24:37",
            *      "id": 2
            *     }
            * }
        * ]
    * }
    */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'username' => ['required','unique:users','alpha_dash'],
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    [
                        'name' => $request['name'],
                        'email' => $request['email'],
                        'password' => Hash::make($request['password']),
                        'username' => $request['username'],
                        'phone' => $request['phone'],
                        'zipcode' => $request['zipcode'],
                        'city' => $request['city'],
                        'birth' => $request['birth'],
                        'address' => $request['address'],
                    ]
                ));



        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }


   /**
     *  @group  Authentication
     *
     * Logout
     *
     * @response  {
        * "data": [
        * {
            *  "message": "Successfully logged out"
            * }
        * ]
    * }
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

   /**
     *  @group  Authentication
     *
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     *  @group  Authentication
     *
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
         return response()->json([
            'token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ], 200, [
            'Authorization'=> $token
        ]);
    }
}
