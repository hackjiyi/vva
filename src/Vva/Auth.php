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
     * 获取加密秘钥
     * @author weinengyu 2020-05-13
     * @param string $encoded_data 加密数据
     * @param string $secret_key secret_key
     * @return string
     */
    public static function sign(string $encoded_data, string $secret_key)
    {
        $signMath = hash_hmac('sha256', $encoded_data, $secret_key);
        return $signMath;
    }
    
    /**
     * 根据数据获取加密秘钥
     * @author weinengyu 2020-05-13
     * @param array $data 数据
     * @param string $secret_key secret_key
     * @return string
     */
    public static function getSignWithData(array $data, $secret_key)
    {
        krsort($data, SORT_STRING);
        $factor = json_encode(http_build_query($data));
        return self::sign($factor, $secret_key);
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