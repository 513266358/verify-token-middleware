<?php

namespace Tokenmid\TokenMidllerware;

use Illuminate\Support\Facades\DB;

class GetUserFromApp
{

    public function get($sql_data, $app_id)
    {
        if (!$app_id) {
            return '差数错误';
        }
        $app_id = htmlspecialchars(addslashes($app_id));
//        // 创建连接
//        $type = 'mysql';  // 数据库为mysql数据库
//        $hostname = $sql_data['DB_HOST'];  // 数据库ip
//        $dbname = $sql_data['DB_DATABASE'];  // 操纵的数据库名
//        $username = $sql_data['DB_USERNAME'];;  // mysql 的账户
//        $password = $sql_data['DB_PASSWORD']; // mysql 的密码
//        $dsn = "$type:dbname=$dbname;host=$hostname";
//        try {
//            $pdo = new \PDO($dsn, $username, $password, [
//                // 开启异常模式
//                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
//            ]);
//        } catch (\PDOException $e) {
//            return 'Connection failed: ' . $e->getMessage();
//        }
//        $open_platform_sql = 'select * from open_platform where app_id=?';
//        $open = $pdo->prepare($open_platform_sql);
//        $open->bindParam(1, $app_id);
//        $open->execute();
//        $open_platform = $open->fetch();
//        if ($open->rowCount() <= 0) {
//            return 'parameter error';
//        }
//        $sql = 'select * from `sys_user` where `USER_SOURCE`=' . $open_platform['source'];
//        $result = $pdo->query($sql)->fetchAll();
        $open_platform = DB::table('open_platform')->where('app_id',$app_id)->find('source');
        if (!$open_platform){
            return 'parameter error';
        }
        $result = DB::table('sys_user')->where('USER_SOURCE',$open_platform)->get();
        return $result;
    }
}