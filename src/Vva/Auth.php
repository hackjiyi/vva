<?php

namespace Vva;

use Firebase\JWT\JWT;

/**
 * 验证
 * @author weinengyu 2020-05-13
 */
final class Auth
{
    /**
     *
     * @var string $access_key1
     */
    private $access_key = '';
    
    /**
     * 
     * @var string $secret_key
     */
    private $secret_key = '';

    /**
     *
     * @var string $jwt_key
     */
    private $jwt_key = '';

    /**
     * 构造函数
     * @param string $access_key
     * @param type $secret_key
     */
    public function __construct(string $access_key, string $secret_key, string $jwt_key)
    {
        $this->access_key = $access_key;
        $this->secret_key = $secret_key;
        $this->jwt_key = $jwt_key;
    }
    
    /**
     * 获取access_key
     * @author weinengyu 2020-05-13
     * @return string
     */
    public function getAccessKey()
    {
        return $this->access_key;
    }
    
    /**
     * 设置$access_key
     * @author weinengyu 2020-05-13
     * @param string $access_key
     * @return void
     */
    public function setAccessKey(string $access_key)
    {
        $this->access_key = $access_key;
    }
    
    /**
     * 获取secret_key
     * @author weinengyu 2020-05-13
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secret_key;
    }
    
    /**
     * 设置$secret_key
     * @author weinengyu 2020-05-13
     * @param string $secret_key
     * @return void
     */
    public function setSecretKey(string $secret_key)
    {
        $this->secret_key = $secret_key;
    }
    
     /**
     * 获取jwt_key
     * @author weinengyu 2020-05-13
     * @return string
     */
    public function getJwtKey()
    {
        return $this->jwt_key;
    }
    
    /**
     * 设置$secret_key
     * @author weinengyu 2020-05-13
     * @param string $jwt_key
     * @return void
     */
    public function setJwtKey(string $jwt_key)
    {
        $this->jwt_key = $jwt_key;
    }
    
    /**
     * 获取加密秘钥
     * @author weinengyu 2020-05-13
     * @param string $encoded_data
     * @return string
     */
    public function sign(string $encoded_data)
    {
        $signMath = hash_hmac('sha256', $encoded_data, $this->secret_key);
        return $signMath;
    }
    
    /**
     * 根据数据获取加密秘钥
     * @author weinengyu 2020-05-13
     * @param array $data 数据
     * @return string
     */
    public function getSignWithData(array $data)
    {
        krsort($data, SORT_STRING);
        $factor = json_encode(http_build_query($data));
        return $this->sign($factor);
    }
    
    /**
     * jwt加密
     * @author weinengyu 2020-05-13
     * @param array $payload 数据
     * @param string $alg 加密算法
     * @return string
     */
    public static function jwtEncode(array $payload, $jwt_key, $alg = "HS256")
    {
        $jwt_str = JWT::encode($payload, $jwt_key, $alg);
        
        return $jwt_str;
    }
    
    /**
     * jwt解密
     * @author weinengyu 2020-05-13
     * @param string $jwt_encode jwt加密串
     * @param string $alg 加密算法
     * @return string
     */
    public static function jwtDecode(string $jwt_encode, $jwt_key, $alg = "HS256")
    {
        $jwt_str = JWT::encode($jwt_encode, $jwt_key, $alg);
        
        return $jwt_str;
    }
}