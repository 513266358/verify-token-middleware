<?php

namespace Tokenmid\TokenMidllerware;

use App\Mapping\Response\ApiResponse;
use Illuminate\Http\Request;

class GetUser
{
    public function handle(Request $request, \Closure $next)
    {
        $userInfo = $request->get('userInfo');
        if (!$userInfo) {
            return ApiResponse::defineResponse(401, '未登录', [], 200);
        }
        $getObj = new GetUserFromApp();
        $env = [
            'DB_HOST' => env('DB_HOST'),
            'DB_USERNAME' => env('DB_USERNAME'),
            'DB_PASSWORD' => env('DB_PASSWORD'),
            'DB_DATABASE' => env('DB_DATABASE'),
        ];
        $app_id = $userInfo['openid'];
        $appUser = $getObj->get($env, $app_id);
        $request->attributes->add(['appUser' => $appUser]);
        return $next($request);
    }

}