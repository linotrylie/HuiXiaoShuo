<?php
namespace app\middleware;

use app\service\AuthService;
use ReflectionClass;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

class AuthCheck implements MiddlewareInterface
{
    public function process(Request $request, callable $handler) : Response
    {
        // 通过反射获取控制器哪些方法不需要登录
        $controller = new ReflectionClass($request->controller);
        $noNeedLogin = $controller->getDefaultProperties()['noNeedLogin'] ?? [];
        if(in_array('*', $noNeedLogin)) {
            // 不需要登录，请求继续向洋葱芯穿越
            return $handler($request);
        }
        // 访问的方法需要登录
        if (!in_array($request->action, $noNeedLogin)) {
            $isOk = AuthService::getInstance()->isLogin();
            if(!$isOk) {
                return redirect('/novel/auth/login');
            }
            // 拦截请求，返回一个重定向响应，请求停止向洋葱芯穿越
            return $handler($request);
        }
        // 不需要登录，请求继续向洋葱芯穿越
        return $handler($request);
    }
}