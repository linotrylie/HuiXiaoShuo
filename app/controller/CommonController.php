<?php

namespace app\controller;

use app\service\MailerService;
use GuzzleHttp\Client;
use Respect\Validation\Validator;
use support\Redis;
use support\Request;
use Webman\Captcha\CaptchaBuilder;

class CommonController
{
    protected array $noNeedLogin = [
        'captchaImg','sendEmailCaptcha'
    ];
    /**
     * 输出验证码图像
     */
    public function captchaImg(Request $request)
    {
        // 初始化验证码类
        $builder = new CaptchaBuilder;
        // 生成验证码
        $builder->build();

        $builderCaptcha =  strtolower($builder->getPhrase());
        // 将验证码的值存储到session中
        session()->set('captcha', $builderCaptcha);
        // 获得验证码图片二进制数据
        $img_content = $builder->get();
        // 输出验证码二进制数据
        return response($img_content, 200, ['Content-Type' => 'image/jpeg']);
    }

    public function sendEmailCaptcha(Request $request)
    {
        try{
            $key = sprintf('get_email_captcha_code_%s',str_replace('.','_',$request->getRemoteIp()));
            if(!is_null(Redis::get($key))) throw new \RuntimeException('请稍后再试~');
            $email = Validator::input($request->post(),[
                'email' => Validator::email()->setName('邮箱地址')
            ]);
            $email = $email['email'];
            $captcha = random_int(100000,999999);
            Redis::setEx($email,300,$captcha);
            $mailer = new MailerService();
            //$mailer->sendMail($email,'【'.getenv('APP_NAME').'】邮箱验证邮件,验证码：'.$captcha,$captcha);
            Redis::setEx($key, 60, 1);
            return success($request->post());
        }catch (\Exception $exception) {
            return error($request->all(),$exception,200);
        }

    }
}