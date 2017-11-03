<?php
/**
 * Created by PhpStorm.
 * User: rpzhan
 * Date: 15/12/28
 * Time: 16:35
 */

namespace Mirror\ApiBundle\Util;

/**
 * 订单相关
 * Class OrderHelper
 * @package Mirror\ApiBundle\Util
 */
class OrderHelper {

    /**
     * 生成订单号
     * @return string
     */
    public static function generateTradeNo() {
        $year=date('y');
        $tradeNo = date('mdHis');
        $randCode = sprintf('%04s', mt_rand(0,1000));
        $tradeNo = $year.$randCode.$tradeNo;
        return $tradeNo;
    }

    /**
     * 拼接参数, 带''
     * @param $url
     * @param array $params
     * @return string
     */
    public static function addQuoteParams($url, array $params) {
        foreach ($params as $key => $value) {
            $url = $url."&".$key.'="'.$value.'"';
        }
        if (!empty($params)) {
            $url = substr($url, 1);
        }

        return $url;
    }

    /**
     * 拼接参数,不带''
     * @param $url
     * @param array $params
     * @return string
     */
    public static function addParams($url, array $params) {
        foreach ($params as $key => $value) {
            $url = $url."&".$key.'='.$value;
        }
        if (!empty($params)) {
            $url = substr($url, 1);
        }

        return $url;
    }

    /**
     * 拼接参数,不带''
     * @param $url
     * @param array $params
     * @return string
     */
    public static function jointParams(array $params) {
        $string='';
        foreach ($params as $key => $value) {
            if($value){
                $string.=$key.'='.$value.'&';
            }
        }
        return rtrim($string,'&');
    }

    /**
     * 生成14位的时间戳
     * @return float
     */
    public static function generatorMillisecond() {
        list($t1, $t2) = explode(' ', microtime());

        return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }
}