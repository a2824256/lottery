<?php
/**
 * Created by PhpStorm.
 * User: alexleung
 * Date: 2019/2/10
 * Time: 6:12 PM
 */

$goods = [
    ['id' => 0, 'name' => '免费可乐', 'field' => [200 => 25, 570 => 285]],
    ['id' => 1, 'name' => '免费奶茶', 'field' => [200 => 25, 570 => 100]],
    ['id' => 2, 'name' => '免费打扫卫生2小时', 'field' => [200 => 5, 570 => 5]],
    ['id' => 3, 'name' => '10磅抵用卷', 'field' => [200 => 40, 570 => 50]],
    ['id' => 4, 'name' => '免费接机服务一次', 'field' => [200 => 5, 570 => 5]],
    ['id' => 5, 'name' => '50镑申研抵用劵', 'field' => [200 => 10, 570 => 10]],
    ['id' => 6, 'name' => '100镑租房抵用卷', 'field' => [200 => 5, 570 => 5]],
    ['id' => 7, 'name' => '一星期免派送费劵', 'field' => [200 => 15, 570 => 15]],
    ['id' => 8, 'name' => '一星期9折卡', 'field' => [200 => 15, 570 => 15]],
    ['id' => 9, 'name' => '免费欧洲申根卡劵', 'field' => [200 => 3, 570 => 2]],
    ['id' => 10, 'name' => '单次免派送费卡劵', 'field' => [200 => 39, 570 => 61]],
    ['id' => 11, 'name' => '包包夜市抵用卷10镑', 'field' => [200 => 13, 570 => 17]],
];
$config = [200, 570];

function generateArray($goods, $config)
{
//    结果数组
    $res_arr = [];
//    分区信息
    $step_arr = $config;
//    分区数量
    $step_num = count($config);
    for ($part_index = 0; $part_index < $step_num; $part_index++) {
        $temp_arr = $goods;
        for ($i = 0; $i < $step_arr[$part_index]; $i++) {
            $r = rand(0, count($temp_arr) - 1);
            $res_arr[] = $temp_arr[$r]['name'];
            $temp_arr[$r]['field'][$config[$part_index]]--;
            if ($temp_arr[$r]['field'][$config[$part_index]] <= 0) {
                unset($temp_arr[$r]);
                $temp_arr = move($temp_arr);
            }
        }
    }
    return $res_arr;
}

//验证函数,验证各项field相加是否等于总额
function verification($goods, $configs)
{
    $arr = [];
    foreach ($configs as $config) {
        $arr[$config] = 0;
    }
    $switch = true;
    $len = 0;
    foreach ($goods as $key => $v) {
        foreach ($v['field'] as $key => $value) {
            if ($switch) {
                $switch = false;
                $len = count($v['field']);
            }
            $c = count($arr);
            $arr[$key] += $value;
        }
    }
    foreach ($arr as $key => $value) {
        if ($key != $value) {
            return false;
        }
    }
    return true;
}
//索引位移函数
function move($array)
{
    $index = 0;
    $arr = [];
    foreach ($array as $key => $value) {
        $arr[$index] = $value;
        $index++;
    }
    return $arr;
}

$arr = generateArray($goods, $config);
print_r($arr);