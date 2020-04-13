<?php
require_once './vendor/autoload.php';

use \Firebase\JWT\JWT;

class VerifyPushData
{
    /**
     * 验证token
     * @return bool
     */
	public static function checkToken()
	{
	    // 在laravel中获取
	    // $token  = str_replace('Bearer ','',$request->header('Authorization'));

        // Authorization的获取可能需要修改服务器/虚拟主机配置
		$token = str_replace('Bearer ','',$_SERVER['Authorization']);

		// 商户/服务商端自行配置
        $secret_key = '******';
        $decoded = JWT::decode($token, $secret_key, array('HS256'));

        if( time()>$decoded->exp ){
            throw new \Exception('token 已过期');
        }
		
		return true;
	}

    /**
     * 获取推送数据
     * @return mixed
     */
	public static function postData()
    {
        // 在laravel中获取
        // $data = $request->json()->all();

        return json_decode(file_get_contents('php://input'),true);
    }
}

echo "<pre>";
var_dump( VerifyPushData::checkToken() );
var_dump( VerifyPushData::postData() );



