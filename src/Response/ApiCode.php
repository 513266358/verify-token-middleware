<?php
declare(strict_types=1);

namespace Tokenmid\TokenMidllerware\Response;

/**
 * 业务code
 *
 * Class ApiCode
 * @package App\Mapping\Response
 */
class ApiCode
{
    CONST SUCCESS = 200;
    CONST ADMIN_SUCCESS = 0;
    CONST ERROR = 500;
    CONST ADMIN_ERROR = 1;
    CONST REPEAT_REQUEST = 10003;

    CONST LOGIN_NOT_FUND = 401;

    CONST REQUEST_PARAMS_LACK = 10005;

    CONST LOGIN_ERROR = 10006;

    CONST HTTP_MESSAGE = [
        self::SUCCESS             => '请求成功',
        self::ADMIN_SUCCESS       => '请求成功',
        self::ERROR               => '请求失败',
        self::ADMIN_ERROR         => '请求失败',
        self::REPEAT_REQUEST      => '禁止重复请求',
        self::LOGIN_NOT_FUND      => '请先进行登录',
        self::REQUEST_PARAMS_LACK => '请求参数缺少',
        self::LOGIN_ERROR         => '登录信息错误',

    ];

    /**
     * 根据code获取对应的message
     *
     * @param int $httpCode
     * @return string
     * @author kert
     */
    public static function getMessage(int $httpCode): string
    {
        return self::HTTP_MESSAGE[$httpCode];
    }
}
