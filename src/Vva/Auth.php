<?php

namespace Vva;
use SplFileObject;

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
     * @param string $jwt_key
     * @param array $alg 解密算法
     * @return object
     * @throws \Exception
     */
    public static function jwtDecode(string $jwt_encode, $jwt_key, $alg = ['HS256'])
    {
        try {
            $jwt_str = JWT::decode($jwt_encode, $jwt_key, $alg);
            return $jwt_str;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * 获取文件路径
     * User: H&M
     * Date: 2020/5/14
     * @param string $path
     * @return string
     * @throws \Exception
     */
    private static function oAuthPublicKey(string $path)
    {
        try {
            $file    = new SplFileObject($path);
            $content = '';
            while (!$file->eof()) {
                $content .= $file->fgets();
            }
            return $content;
        } catch (\Exception $exception) {
            throw new \Exception('You must provide a valid key file', 0, $exception);
        }
    }

    /**
     * 获取文件路径
     * User: H&M
     * Date: 2020/5/14
     * @param string $file
     * @return string
     * @throws \Exception
     */
    private static function getPath(string $file)
    {
        $path =  dirname(__FILE__).'/'.$file;
        if (!file_exists($path) || !is_readable($path)) {
            throw new \Exception(sprintf('Key path "%s" does not exist or is not readable', $path));
        }
        return $path;
    }

    /**
     * 解密验证
     * User: H&M
     * Date: 2020/5/14
     * @param $jwt
     * @param array $alg
     * @return object
     * @throws \Exception
     */
    public static function validateAuthorization($jwt,  $alg = ['HS256'])
    {
        try {
            $path = self::getPath('oauth-public.key');
            $jwt_key = self::oAuthPublicKey($path);
            return self::jwtDecode($jwt, $jwt_key, $alg);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}