<?php
/**
 * 基于PHP的JWT实现 2019年3月25日
 * https://www.jb51.net/article/146790.htm
 * https://github.com/firebase/php-jwt/blob/master/src/JWT.php
 */

namespace think;

class JWT {
    //头部
    private static $header=[
        'alg'=>'HS256', //生成signature的算法
        'typ'=>'JWT'    //
    ];
    //使用HMAC生成信息摘要时所使用的密钥
    private static $key= 'uekedu';

    /**
       * 获取jwt token
       * @param array $payload jwt载荷  格式如下非必须
       * [
       *    'iss'=>'jwt_admin',     //该JWT的签发者
       *    'iat'=>time(),          //签发时间
       *    'exp'=>time()+7200,     //过期时间，默认过期时间2小时
       *    'nbf'=>time()+0,       //该时间之前不接收处理该Token
       *    'sub'=>'www.admin.com', //面向的用户
       *    'jti'=>md5(uniqid('JWT').time()) //该Token唯一标识
       * ]
       * @param string $key  使用HMAC生成信息摘要时所使用的密钥
       * @return bool|string
       */
    public static function getToken($payload,$key){
        //获取加密KEY
        $k = empty($key)?self::$key:$key;
        if(empty($payload['iat'])){
            $payload['iat'] = time();
        }
        if(empty($payload['exp'])){
            $payload['exp'] = time()+72000;
        }
        if(empty($payload['nbf'])){
            $payload['nbf'] = time()+0;
        }

        //验证负载
        if(is_array($payload)){
            //JWT由三个部分组成：header.payload.signature
            $base64header = self::base64UrlEncode(json_encode(self::$header,JSON_UNESCAPED_UNICODE));
            $base64payload = self::base64UrlEncode(json_encode($payload,JSON_UNESCAPED_UNICODE));
            $signature = self::signature($base64header.'.'.$base64payload,$k,self::$header['alg']);
            $token = $base64header.'.'.$base64payload.'.'.$signature;
            return $token;
        }else{
            return false;
        }
    }

    /**
     * 验证token是否有效,默认验证exp,nbf,iat时间
     * @param string $Token 需要验证的token
     * @return bool|string
     */
    public static function verify($Token,$key)
    {
        //获取加密KEY
        $k = empty($key)?self::$key:$key;
        //验证token长度
        $tokens = explode('.', $Token);
        if (count($tokens) != 3)
            return false;

        list($base64header, $base64payload, $sign) = $tokens;

        //获取jwt算法
        $base64decodeheader = json_decode(self::base64UrlDecode($base64header), JSON_OBJECT_AS_ARRAY);
        if (empty($base64decodeheader['alg']))
            return false;

        //签名验证
        if (self::signature($base64header . '.' . $base64payload, $k, $base64decodeheader['alg']) !== $sign)
            return false;

        $payload = json_decode(self::base64UrlDecode($base64payload), JSON_OBJECT_AS_ARRAY);

        //签发时间大于当前服务器时间验证失败
        if (isset($payload['iat']) && $payload['iat'] > time())
            return false;


        //过期时间小于当前服务器时间验证失败
        if (isset($payload['exp']) && $payload['exp'] < time())
            return false;


        //该nbf时间之前不接收处理该Token
        if (isset($payload['nbf']) && $payload['nbf'] > time())
            return false;

        return $payload;
    }

    /**
     * base64UrlEncode  https://jwt.io/ 中base64UrlEncode编码实现
     * @param string $input 需要编码的字符串
     * @return string
     */
    private static function base64UrlEncode($input)
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }

    /**
     * base64UrlEncode https://jwt.io/ 中base64UrlEncode解码实现
     * @param string $input 需要解码的字符串
     * @return bool|string
     */
    private static function base64UrlDecode($input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $addlen = 4 - $remainder;
            $input .= str_repeat('=', $addlen);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }

    /**
     * HMACSHA256签名  https://jwt.io/ 中HMACSHA256签名实现
     * @param string $input 为base64UrlEncode(header).".".base64UrlEncode(payload)
     * @param string $key
     * @param string $alg  算法方式
     * @return mixed
     */
    private static function signature($input, $key, $alg = 'HS256')
    {
        $alg_config=array(
            'HS256'=>'sha256'
        );
        return self::base64UrlEncode(hash_hmac($alg_config[$alg], $input, $key,true));
    }
}
