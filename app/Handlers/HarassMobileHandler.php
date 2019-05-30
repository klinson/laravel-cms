<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 19-5-30
 * Time: 下午4:13
 */

namespace App\Handlers;

/**
 * 手机号骚扰攻击
 * Class HarassMobileHandler
 * @package App\Handlers
 * @author klinson <klinson@163.com>
 */
class HarassMobileHandler
{
    const modes = [
        1 => '车置宝估价',
        2 => '二手车之家',
        4 => '瓜子二手车',
    ];
    protected $mode2method = [
        1 => 'chezhibao',
        2 => 'che168',
        4 => 'guazi'
    ];

    protected static $instance;
    protected function __construct()
    {
    }
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function handle($mobile, $modes = 1)
    {
        if (! is_array($modes)) {
            $modes = explode(',', $modes);
        }
        $return = [];
        foreach ($modes as $mode) {
            $return[] = [
                'res' => call_user_func([$this, $this->mode2method[$mode]], $mobile),
                'mode' => $mode,
            ];
        }
    }

    // 二手车之家
    public function che168($mobile)
    {
        function encodeMobile($mobile) {
            $xxxAarr = ['u', 'x', 'k', 'd', 'o', 'p', 'g', 's', 'v', 'j'];
            $c = "";
            for ($i = 0, $len = strlen($mobile); $i < $len; $i++) {
                $c .= $xxxAarr[$mobile[$i]];

                if (($i + 1) % 2 === 0) {
                    $c .= "-";
                }
            }
            return $c;
        }

        $url = 'https://www.che168.com/Handler/Evaluate/AddCarEstimate.ashx';
        $method = 'GET';
        $mobile = encodeMobile($mobile);

        $params = [
            'xxx' => $mobile,
            'provinceID' => '350000',
            'cityID' => '350100',
            'brandID' => '33',
            'seriesID' => '3170',
            'specid' => '36601',
            'FirstRegTime' => date('Y-M'),
            'mileage' => '0.4',
            'sourceid' => '3',
            'sourcetwo' => '1',
            'sourcethree' => '128',
            'pagetype' => '2',
            'ischecked' => 'true',
            'isopen' => '1',
            'di' => '4|330754|0'
        ];
        $res1 = $this->request($url, $params, $method);

        $url = 'https://www.che168.com/pinggu/buyeva_419949926/0.html';
        $params = [
            'bid' => '33',
            'sid' => '3170',
            'specId' => '36601',
            'registerYear' => date('Y'),
            'registerMonth' => date('M'),
            'pid' => '350000',
            'cid' => '350100',
            'buyMark' => 'uahp10003',
            'isfromoutside' => '0',
            'pgmlg' => '0.4',
            'cdatestr' => date('Ym'),
            'pvareaid' => '100567',
            'xxx' => $mobile
        ];
        $res2 = $this->request($url, $params, $method);

        if (! $res1['error'] && ! $res2['error']) {
            return true;
        } else {
            return false;
        }
    }

    public function chezhibao($mobile)
    {
        $url = 'https://www.chezhibao.com/customer/addCar.htm';
        $params = [
            'mobile' => $mobile,
            'region' => 2067,
            'regionName' => '东莞'
        ];
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        $method = 'POST';
        $res = $this->request($url, $params, $method, $headers);
        if ($res['error']) {
            return false;
        } else {
            return true;
        }
    }

    // TODO:: 难做，需要等待页面js加载
    public function guazi($mobile)
    {
        $url1 = 'https://www.guazi.com/dg/';
        $headers = [
            'Cache-Control' => 'no-cache',
            'Host' => 'www.guazi.com',
            'Origin' => 'https://www.guazi.com',
            'Referer' => 'https://www.guazi.com/dg/',
            'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36',
        ];
        $res = $this->request($url1, [], 'GET', $headers);
        dd($res);


        $url = 'https://www.guazi.com/ww/appointCars/?act=ziXun';
        $params = [
            'phone' => $mobile,
            'puid' => '3009120631',
            'source' => '129',
            'time' => time(),
            'token' => 'f33f75d635ac9f48a5dbfbae2d61dfe3'
        ];

        $method = 'GET';
    }

    protected function request($url, $params = [], $method = 'GET', $headers = [], $cookies = null)
    {
        // 1. 初始化
        $ch = curl_init();
        // 2. 设置选项，包括URL
        if (strpos($url, '?') === false) {
            $url .= '?'.http_build_query($params);
        } else {
            $url .= '&'.http_build_query($params);
        }
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_ENCODING, '');
        if ($method === 'POST' && $params) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        // https
        if (substr($url, 0, 5) === 'https') {
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        }
        if ($headers) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        // 3. 执行并获取HTML文档内容
        $output = curl_exec($ch);
        // 4. 释放curl句柄
        curl_close($ch);
        if($output === false){
            return [
                'error' => curl_errno($ch),
                'message' => curl_error($ch)
            ];
        } else {
            return [
                'error' => 0,
                'response' => $output
            ];
        }

    }
}