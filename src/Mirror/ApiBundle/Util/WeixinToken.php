<?php

namespace Mirror\ApiBundle\Util;

class WeixinToken {
	private $token;
	private $createTime;
	private $expire;
	public function __construct() {
		$this->refresh();
	}
	
	private function refresh() {
		$rr = WeixinHelper::getAccessToken ();
		$result = Helper::getc($rr, 'result','');
		$json = json_decode($result,true);
		$token = Helper::getc($json,'access_token','');
		$expire = Helper::getc($json,'expires_in',0);
		$this->createTime = new \DateTime();
		$this->token = $token;;
		$this->expire = $expire;
	}
	public function getToken() {
		return $this->token;
	}
}
	
