<?php
/**
 * Here is your custom functions.
 */
if(!function_exists('encrypt_md5')){
    function encrypt_md5(string $salt,string $str) : string {
        return md5($str.'_'.$salt);
    }
}

if(!function_exists('success')) {
    function success(array $data) {
        $res = [
            'message'=>'success',
            'data'=>$data,
            'code'=>0
        ];
        return json($res,JSON_UNESCAPED_UNICODE)->withStatus(200);
    }
}
if(!function_exists('error')) {
    function error($data,Exception $msg,int $code=1) {
        $res = [
            'message'=>$msg->getMessage(),
            'data'=>$data,
            'code'=>$code
        ];
        return json($res,JSON_UNESCAPED_UNICODE)->withStatus(200);
    }
}

if(!function_exists('get_ip_city_post')) {
    /**
     * 获取ip归属地
     *
     * @param string $ip
     * @return string
     */
    function get_ip_city_post($ip) {
            $ch = curl_init();
            $url = 'https://whois.pconline.com.cn/ipJson.jsp?ip=' . $ip;
            //用curl发送接收数据
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //请求为https
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            $location = curl_exec($ch);
            curl_close($ch);
            //转码
            $location = mb_convert_encoding($location, 'utf-8', 'GB2312');
            //var_dump($location);
            //截取{}中的字符串
            $location = substr($location, strlen('({') + strpos($location, '({'), (strlen($location) - strpos($location, '})')) * (-1));
            //将截取的字符串$location中的‘，’替换成‘&’   将字符串中的‘：‘替换成‘=’
            $location = str_replace('"', "", str_replace(":", "=", str_replace(",", "&", $location)));
            //php内置函数，将处理成类似于url参数的格式的字符串  转换成数组
            parse_str($location, $ip_location);
            if (isset($ip_location['proCode']) && $ip_location['proCode'] != '999999') {
                $location_db=$ip_location['pro'];

            } else  {

                $location_db=isset($ip_location['addr']) ? $ip_location['addr'] : "未知地点";

            }
            return $location_db;
    }
}

if (! function_exists('str_replace_array')) {
    /**
     * Replace a given value in the string sequentially with an array.
     *
     * @param  string  $search
     * @param  array   $replace
     * @param  string  $subject
     * @return string
     *
     * @deprecated Str::replaceArray() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function str_replace_array($search, array $replace, $subject)
    {
        $segments = explode($search, $subject);

        $result = array_shift($segments);

        foreach ($segments as $segment) {
            $result .= (array_shift($replace) ?? $search).$segment;
        }

        return $result;
    }
}