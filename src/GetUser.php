<?php

namespace Tokenmid\TokenMidllerware;

use App\Mapping\Response\ApiResponse;
use Illuminate\Http\Request;

class GetUser
{
    public function handle(Request $request, \Closure $next)
    {
        $user = \JWTAuth::parseToken()->authenticate();
        if ($user == false) {
            return ApiResponse::defineResponse(401,'未登录',[$user],200);
        }

        $data = $request->all();
        array_walk_recursive($data, function (&$input) {
            $input = htmlspecialchars($input, ENT_HTML5);
        });
        $request->merge($data);

        $userInfo['openid']            = $user->OPENID;
        $userInfo['user_id']           = $user->SYS_USER_ID;
        $userInfo['unionid']           = $user->UNION_ID;
        $userInfo['nick_name']         = $user->USER_NAME;
        $userInfo['phone']             = $user->TELEPHONE;
        $userInfo['file_user_id']      = $user->file_user_id;
        $userInfo['id']                = $user->id;
        $userInfo['sys_user_id']       = $user->SYS_USER_ID;
        $userInfo['source']       = $user->USER_SOURCE;
        $request->attributes->add(['userInfo' => $userInfo]);

        return $next($request);
    }

}