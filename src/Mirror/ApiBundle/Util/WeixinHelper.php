<?php

namespace Mirror\ApiBundle\Util;

use Mirror\ApiBundle\Common\Constant;
use Mirror\ApiBundle\ViewModel\WXMessage;
class WeixinHelper {
	
	public static function refreshToken()
	{
		$url = Constant::$accessTokenUrl;
		$url = sprintf($url,Constant::$appId,Constant::$secret);
		$rr = CurlHelper::httpGet($url);
		$result = Helper::getc($rr,'result');
		$json = json_decode($result,true);
		$token = Helper::getc($json,'access_token','');
		$expires = Helper::getc($json,'expires_in',0);
		$now = time()+$expires;
		$args= array(
				'access_token' => $token,
				'expires' => $now
		);
		$context = json_encode($args);
		$path = WeixinHelper::getConfigPath();
		file_put_contents($path, $context);
		return $token;
	}
	
	public static function sendMessage($user,WXMessage $wxMessage,$token)
	{
		$url = $wxMessage->getUrl();
		$server = sprintf(Constant::$templateSendUrl,$token);
		$param = array(
				'touser' => $user,
				'template_id' => 'nfXf4-M52q0-pRk8P2L9PcqOXVoSTGdDdAkSD4hd3so',
				'url' => $url,
				'topcolor' => '#ffff00',
				'data' => $wxMessage->toArray()
		);
		$arguments = json_encode($param);
		$rr = CurlHelper::httpPost($server, $arguments);
	}

	public static function getUserInfo($openId,$token)
	{
		$url=sprintf(Constant::$userInfoUrl,$token,$openId);
		$rr=CurlHelper::httpGet($url);
		$result=Helper::getc($rr,'result',array());
		$json=json_decode($result,true);
		return $json;

	}
	public function getIsFollow($openId,$token)
	{
		$url=sprintf(Constant::$isFollowUrl,$token,$openId);
		$rr=CurlHelper::httpGet($url);
		$result = Helper::getc($rr,'result',array());
		$json = json_decode($result,true);
		$subscribe=Helper::getc($json,'subscribe');
		return $subscribe==1 ? true : false;
	}
	
	public static function getWeixinId($code)
	{
		$url = sprintf(Constant::$openIdUrl,Constant::$appId,Constant::$secret,$code);
		$rr = CurlHelper::httpGet($url);
		$result = Helper::getc($rr,'result',array());
		$json =  json_decode($result,true);
		$openId = Helper::getc($json,'openid','');
		$token=Helper::getc($json,'access_token','');

		return array('token'=>$token,'openid'=>$openId);
	}

	public static function getJsToken()
	{
		$url=sprintf(Constant::$wxJsTokenUrl,Constant::$appId,Constant::$secret);
		$result=CurlHelper::httpGet($url);
		$result=json_decode($result['result'],true);
		$jsToken=Helper::getc($result,'access_token','');
		return $jsToken;
	}
	
	public static function getToken()
	{
		$path = WeixinHelper::getConfigPath();
		$str = file_get_contents($path);
		$json = json_decode($str,true);
		$token = Helper::getc($json,'access_token','');
		$expires = Helper::getc($json,'expires',0);
		$now = time();
		if($token=='' || $now >=$expires){
			return WeixinHelper::refreshToken();
		}
		return $token;
	}
	
	public static function getConfigPath() {
		$dir = __DIR__;
		$os = php_uname ( 's' );
		$os = strtoupper ( $os );
		$split = "/";
		if (strpos ( $os, 'WINDOWS' )) {
			$split = "\\";
		}
		return $dir . $split . 'token.json';
	}
	
	
}