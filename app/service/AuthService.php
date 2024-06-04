<?php
declare(strict_types=1);
namespace app\service;
use app\model\User;
use app\util\Utils;
use Exception;
use Illuminate\Support\Facades\Date;
use think\helper\Str;
use support\Redis;
use support\Request;
use Tinywan\Jwt\JwtToken;

class AuthService
{
    public function __construct()
    {
    }
    private static $instance;
    private $guard = 'app.guard.user';
    private function getUserClass(){
        $guardConfig = config($this->guard);
        if(!empty($guardConfig)){
            return new $guardConfig;
        }
        return null;
    }
    public static function getInstance()
    {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function register(Request $request)
    {
        $data = $request->post();
        $exist = User::where('username', '=', $data['username'])->exists();
        if($exist) {
            throw new \RuntimeException('用户名已存在~');
        }
        // 获取邮箱验证码
        $emailCaptcha = $data['emailCaptchaCode'];
        // 获取redis缓存中的验证码
        if ($emailCaptcha !== Redis::get($data['email'])) {
            throw new \RuntimeException('输入的邮箱验证码不正确');
        }
        Redis::del($data['email']);
        // 验证都通过了插入用户数据
        $salt = Str::random();
        $encryptPassword = Utils::passwordHash($data['password'] . '_' . $salt);
        $userModel = new User();
        $userModel->username = $data['username'];
        $userModel->nickname = $data['nickname'];
        $userModel->email = $data['email'];
        $userModel->password = $encryptPassword;
        $userModel->salt = $salt;
        $userModel->ip = $request->getRealIp();
        $userModel->last_login_time = date('Y-m-d H:i:s');
        if($userModel->save() === false) {
            throw new \RuntimeException("注册失败~");
        }
        $user = User::where('username', '=', $data['username'])->first();
        if (!$user) {
            throw new \RuntimeException('未知的用户！');
        }

        return $this->generateJwtToken($user);
    }


    private function generateJwtToken(User $user): array
    {
        $userData = [
            'id' => $user->uid,
            'uid' => $user->uid,
            'email' => $user->email,
            'username' => $user->username,
            'nickname' => $user->nickname,
            'rid' => $user->rid,
            'rmb' => $user->rmb,
            'gold' => $user->gold,
            'last_login_time' => $user->last_login_time,
            'level' => $user->level,
            'sex' => $user->sex,
            'vip_level' => $user->vip_level,
            'avatar_url' => $user->avatar_url,
            'created_at' => $user->created_at,
            'status' => $user->status,
            'vip_expired_at' => $user->vip_expired_at
        ];
        request()->session()->set('user',json_encode($userData, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE));
        $jwt = JwtToken::generateToken($userData);
        request()->session()->set('token',$jwt['access_token']);
        return [
            'user' => $userData,
            'jwt' => $jwt,
            'app_name' => getenv('APP_NAME')
        ];
    }

    public function login(Request $request)
    {
        $data = $request->post();
        // 获取post请求中的captcha字段
        $captcha = $data['captcha'];
        // 对比session中的captcha值
        if (strtolower($captcha) !== session()->get('captcha')) {
            throw new \RuntimeException('输入的验证码不正确');
        }

        session()->delete('captcha');
        //判断是否已经登录过
        if(getenv('SSO') == 1 && !empty(session()->get('user'))) {
            throw new \RuntimeException('重复登录！');
        }
        $userModel = new User();
        $user = $userModel::where('username', '=', $data['username'])->first();
        if (is_null($user)) {
            throw new Exception('未知的用户！');
        }
        //验证密码
        $ok = Utils::passwordVerify($data['password'] . '_' . $user->salt, $user->password);
        if (!$ok) {
            throw new \RuntimeException('密码错误');
        }
        if(!str_contains('127.0.0.1',$request->getRemoteIp())) {
            $user->ip = $request->getRemoteIp();
            $user->addr = get_ip_city_post($request->getRemoteIp());
        }else{
            $user->ip = '127.0.0.1';
            $user->addr = '本地';
        }
        $user->last_login_time =  Date::now();
        $user->save();
        return $this->generateJwtToken($user);
    }

    public function logout(Request $request)
    {
        $userModel = new User();
        $check = $userModel::where('uid', '=', $request->post('uid'))->first();
        if(is_null($check)) {
            throw new Exception("该用户不存在！");
        }
        $sessionUser = session('user');
        if(empty($sessionUser)) {
            return [];
        }
        session()->delete('user');
        session()->delete('token');
        return [];
    }


    public function getUserData()
    {
        try {
            $header = request()->header('Authorization', '');
            if(empty($header)) {
                throw new \Exception("请登录！");
            }
            if (Str::startsWith($header, 'Bearer ')) {
                $token = Str::substr($header, 7);
            }
            $token = $token ?? session('token');
            if(is_null($token)) {
                throw new \Exception("请登录！");
            }
            $authedToken = JwtToken::verify(token:$token);
            if($authedToken['exp'] < time()) {
                throw new \Exception("登录过期！");
            }
            if(!empty($authedToken['extend'])){
                return $authedToken['extend'];
            }
            return [];
        }catch (\Exception $exception) {
            return [];
        }
    }

    public function isLogin()
    {
        $data = $this->getUserData();
        if(!empty($data)){
            return true;
        }
        return false;
    }

    public function lockUser()
    {
        $data = $this->getUserData();
        if(!empty($data)){
            $user = $this->getUserClass();
            return $user->where('uid',$data['uid'])->lockForUpdate()->first();
        }
        return null;
    }

    /**
     * 获取会员信息
     * @return User
     */
    public function user()
    {
        $data = $this->getUserData();
        if(!empty($data)){
            $user = $this->getUserClass();
            $user = $user->where('uid',$data['uid'])->first();
            if(User::STATUS[$user->status] !== '正常') {
                throw new \Exception(User::STATUS[$user->status]);
            }
            return $user;
        }
        return null;
    }

}