<?php

namespace Mirror\ApiBundle\Common;

/**
 * 常量类
 * Class Constant
 * @package Mirror\ApiBundle\Common
 */
class Constant {

    //数据状态
    public static $status_normal=1;

    public static $order_status_wait=1;//待支付
    public static $order_status_success=2;//支付成功
    public static $order_status_report=3;//已经导入报表
    public static $order_status_invalid=0;//无效订单

    //固定的商品id
    public static $goods_id=1;
    //云之讯
    public static $UCPASS_ACCOUNT_SID='f87397ba589a9e33a8d9e2085a0e9705';
    public static $UCPASS_AUTH_TOKEN='987bd0296fa2bcde02b429fcd47733d2';
    public static $UCPAAS_APP_ID='dcd2fd41e1bf40d596c6fbc72cf472f7';
    public static $UCPAAS_TEMPLATE_ID='231041';//其他状态修改

    //20170516创建
    public static $download_server = 'DOWNLOAD_SERVER';

    //微信
    public static $openIdUrl = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code';
    public static $appId = 'wx8c06263e253e080d';
    public static $secret = '1ebfe6bec0c027b9a97750d183b56ce9';
    public static $WX_NOTIFY_PATH='weixin.amogene.com/api/order/notify';
    public static $accessTokenUrl = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s';
    public static $userInfoUrl='https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN';

    //盒子
    public static $box_status_start=1;//盒子初始生成
    public static $box_status_filled=2;//用户已经填写
    public static $box_status_result=3;//检测结果已出
    public static $box_status_report=4;//报表已经上传
}