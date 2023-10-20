<?php

namespace Tokenmid\TokenMidllerware;

use Illuminate\Support\Facades\DB;

class GetUserFromApp
{

    public function get($app_id)
    {
        if (!$app_id) {
            return '差数错误';
        }
        $app_id = htmlspecialchars(addslashes($app_id));
        $open_platform = DB::table('open_platform')->where('app_id',$app_id)->value('source');
        if (!$open_platform){
            return 'parameter error';
        }
        $result =  DB::table('sys_user')->where('USER_SOURCE',$open_platform)->get();
        return $result;
    }
}