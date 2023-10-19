<?php

namespace tokenmid;

class index
{

    public function index($sql_data,$app_id)
    {
        // 创建连接
        $conn = new \mysqli($sql_data['DB_HOST'], $sql_data['DB_USERNAME'], $sql_data['DB_PASSWORD'], $sql_data['DB_DATABASE']);
        // 检测连接
        if ($conn->connect_error) {
            return ['连接失败' . $conn->connect_error];
        }
        $sql = "select * from `open_platform` left join `sys_user` on `sys_user`.`USER_SOURCE` = `open_platform`.`source` where `open_platform`.`app_id` = ". $app_id;
        $result = $conn->query($sql);
        $conn->close();

        if ($result->num_rows > 0) {
            // 输出数据
            return $result;
        } else {
            return [];
        }

    }
}