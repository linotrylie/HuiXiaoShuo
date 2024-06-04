<?php

namespace app\service;

use Exception;
use Illuminate\Support\Facades\File;
use yzh52521\mailer\mail\Mailer;
use function DI\get;

class MailerService
{
    protected $captchaHtml = <<<EOF
<p>【%s】感谢您的注册！验证代码：%s,请在5分钟内完成验证！</p>
EOF;


    /**
     * @throws Exception
     */
    public function sendMail($email, $suject, $content, $file = '',$type = 1): void
    {
        try {
            $mailer = new Mailer();
            if (is_array($email)) {
                $toEmail = $email;
            } else {
                $toEmail = [$email];
            }
            $mailer->setCharset('utf8')->setFrom([getenv('MAIL_USERNAME') => getenv('APP_NAME')])
                ->setTo($toEmail)
                ->setReplyTo(getenv('MAIL_USERNAME'))
                ->setSubject($suject);
            if (!empty($file)) {
                if (File::exists($file)) {
                    $mailer = $mailer->attach($file);
                }
            }
            if($type == 1) {
                $mailer->view('mailer/index', [
                    'content' => sprintf($this->captchaHtml,getenv('APP_NAME'), $content),
                    'app_name' => getenv('APP_NAME'),
                    'year' => date('Y')
                ])->send();
            }else if($type == 2) {
                $mailer->view('mailer/index', [
                    'content' => $content,
                    'app_name' => getenv('APP_NAME'),
                    'year' => date('Y')
                ])->send();
            }
        } catch (Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }
}