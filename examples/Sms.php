<?php
/**
 * Created by PhpStorm.
 * User: zyxcba
 * Date: 2017/2/17
 * Time: 下午3:56
 */

use Cmzz\AliyunCore\Profile\DefaultProfile;
use Cmzz\AliyunCore\DefaultAcsClient;
use Cmzz\AliyunSms\Sms\Request\V20160927\SingleSendSmsRequest;
use Cmzz\AliyunCore\Exception\ClientException;
use Cmzz\AliyunCore\Exception\ServerException;

class SmsController
{
    public function send()
    {
        define('ENABLE_HTTP_PROXY', FALSE);
        define('HTTP_PROXY_IP', '127.0.0.1');
        define('HTTP_PROXY_PORT', '8888');

        $iClientProfile = DefaultProfile::getProfile("cn-hangzhou", "your accessKey", "your accessSecret");
        $client = new DefaultAcsClient($iClientProfile);
        $request = new SingleSendSmsRequest();
        $request->setSignName("验证测试");                 /*签名名称*/
        $request->setTemplateCode("SMS_11111");           /*模板code*/
        $request->setRecNum("手机号");                     /*目标手机号*/
        $request->setParamString("{\"name\":\"sanyou\"}");/*模板变量，数字一定要转换为字符串*/

        try {
            $response = $client->getAcsResponse($request);
            print_r($response);
        } catch (ClientException  $e) {
            print_r($e->getErrorCode());
            print_r($e->getErrorMessage());
        } catch (ServerException  $e) {
            print_r($e->getErrorCode());
            print_r($e->getErrorMessage());
        }
    }
}
