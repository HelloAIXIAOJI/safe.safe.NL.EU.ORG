<?php

// 获取查询参数
$webNumber = isset($_GET['webNumber']) ? $_GET['webNumber'] : '';

// 数据文件路径
$dataFilePath = __DIR__ . '/data-822492.datxt';

// 读取数据文件内容
$dataContent = file_get_contents($dataFilePath);

// 按<next>分割每个网站的信息
$websites = explode('<next>', $dataContent);

// 初始化结果数组
$result = [];

// 遍历每个网站信息
foreach ($websites as $website) {
    // 按<cut>分割每个值
    $values = explode('<cut>', $website);

    // 如果网站号匹配，则构建结果数组
    if ($webNumber == $values[4]) {
        $result['web-name'] = trim(mb_convert_encoding($values[0], 'UTF-8'));
        $result['web-domain'] = trim(mb_convert_encoding($values[1], 'UTF-8'));
        $result['web-homepage'] = trim(mb_convert_encoding($values[2], 'UTF-8'));
        $result['web-owner'] = trim(mb_convert_encoding($values[3], 'UTF-8'));
        $result['web-number'] = trim(mb_convert_encoding($values[4], 'UTF-8'));

        // 找到匹配的网站后就停止循环
        break;
    }
}

// 将结果数组转换为JSON格式并输出（使用JSON_UNESCAPED_UNICODE选项）
$jsonResult = json_encode($result, JSON_UNESCAPED_UNICODE);

echo $jsonResult;

?>
