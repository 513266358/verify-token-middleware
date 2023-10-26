<?php
declare(strict_types=1);

namespace Tokenmid\TokenMidllerware\Response;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use App\Libs\AES;
/**
 * 接口返回参数
 *
 * Class ApiResponse
 * @package Tokenmid\TokenMidllerware\Response
 */
class ApiResponse
{

    CONST NORMAL = 0;

    CONST AB_NORMAL = -1;
    /**
     * 成功接口参数
     *
     * @param array $responseInfo 返回参数
     * @return JsonResponse
     * @author ycc
     */
    public static function success($responseInfo = [],string $msg = '' , $signature = '')
    {
        $code = ApiCode::SUCCESS;
        if(Request::input('sys') == 'admin'){
            $code = ApiCode::ADMIN_SUCCESS;
        }else if(Request::input('sys') == 'api'){
            $code = ApiCode::SUCCESS;
        }else{
            $rootName = Request::getRequestUri();
            if(strpos($rootName,'adminapi') !== false)$code = ApiCode::ADMIN_SUCCESS;

        }
        $data = [
            'code' =>  $code,
            'msg'  => $msg == '' ? ApiCode::getMessage(ApiCode::SUCCESS) : $msg,
            'data' => $responseInfo,
        ];
        if (!empty( $signature)) {
            $data['signature'] = $signature;
        }
        return response()->json(self::decode($data));
    }

    /**
     * 失败接口参数
     *
     * @param array $responseInfo 返回参数
     * @return JsonResponse
     * @author ycc
     */
    public static function error($responseInfo = [] , string $msg = '', $customCode = 0)
    {
        $code = ApiCode::ERROR;
        if(Request::input('sys') == 'admin'){
            $code = ApiCode::ADMIN_ERROR;
        }else if(Request::input('sys') == 'api'){
            $code = ApiCode::ERROR;
        }else{
            $rootName = Request::getRequestUri();
            if(strpos($rootName,'adminapi') !== false)$code = ApiCode::ADMIN_ERROR;
        }
        return response()->json(self::decode([
            'code' => $customCode ?: $code,
            'msg'  => $msg == '' ? ApiCode::getMessage(ApiCode::ERROR) : $msg,
            'data' => $responseInfo
        ]));
    }

    /**
     * 自定义返回信息内容
     *
     * @param int $code 业务code
     * @param string $message 返回信息
     * @param array $responseInfo 返回数据
     * @param int $httpCode 返回http状态码
     * @return JsonResponse
     * @author ycc
     */
    public static function defineResponse(int $code = 0, string $message = '', array $responseInfo = [], int $httpCode = 0)
    {
        return response()->json(self::decode([
            'code' => empty($code) ? ApiCode::ERROR : $code,
            'msg'  => empty($message) ? ApiCode::getMessage(ApiCode::ERROR) : $message,
            'data' => empty($responseInfo) ? [] : $responseInfo,
        ]), empty($httpCode) ? 200 : $httpCode);
    }

    public static function decode($data)
    {
        $response = $data;
        return  $response;
    }
}
