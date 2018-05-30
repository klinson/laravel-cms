<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AuthorizationsRequest;
use Auth;

class AuthorizationsController extends Controller
{
    public function login(AuthorizationsRequest $request)
    {
        //TODO: check user login

        // 验证规则，由于业务需求，这里我更改了一下登录的用户名，使用手机号码登录
        $rules = [

        ];

        // 验证参数，如果验证失败，则会抛出 ValidationException 的异常
        $params = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // 使用 Auth 登录用户，如果登录成功，则返回 201 的 code 和 token，如果登录失败则返回
        return ($token = Auth::guard('api')->attempt($params))
            ? $this->respondWithToken($token)->setStatusCode(201)
            : $this->response->errorUnauthorized(trans('auth.failed'));
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return $this->response->noContent();
    }

    protected function respondWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }
}
