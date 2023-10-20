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
        $app_id = $userInfo['openid'];
        $appUser = $getObj->get($app_id);
        $request->attributes->add(['appUser' => $appUser]);
        return $next($request);
    }

}