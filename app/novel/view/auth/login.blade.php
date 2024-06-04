@extends('layouts.layout')
@section('content')
    <style>
        .login-container {
            width: 320px;
            margin: 21px auto 0;
        }

        .login-other .layui-icon {
            position: relative;
            display: inline-block;
            margin: 0 2px;
            top: 2px;
            font-size: 26px;
        }
    </style>
    <form id="form" class="layui-form">
        <div class="login-container">
            <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <div class="layui-input-prefix">
                        <i class="layui-icon layui-icon-username"></i>
                    </div>
                    <input type="text" name="username" value="" lay-verify="required" placeholder="用户名"
                           lay-reqtext="请填写用户名" autocomplete="off" class="layui-input" lay-affix="clear">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <div class="layui-input-prefix">
                        <i class="layui-icon layui-icon-password"></i>
                    </div>
                    <input type="password" name="password" value="" lay-verify="required" placeholder="密   码"
                           lay-reqtext="请填写密码" autocomplete="off" class="layui-input" lay-affix="eye">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-row">
                    <div class="layui-col-xs7">
                        <div class="layui-input-wrap">
                            <div class="layui-input-prefix">
                                <i class="layui-icon layui-icon-vercode"></i>
                            </div>
                            <input type="text" name="captcha" value="" lay-verify="required" placeholder="验证码"
                                   lay-reqtext="请填写验证码" autocomplete="off" class="layui-input" lay-affix="clear">
                        </div>
                    </div>
                    <div class="layui-col-xs5">
                        <div style="margin-left: 10px;">
                            <img src="{{route('captcha-img')}}" style="width: 120px;height: 40px;"
                                 onclick="this.src='{{route('captcha-img',['t'=>time()])}}'">
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <input type="checkbox" name="remember" lay-skin="primary" title="记住密码">
                <a href="{{route('novel-auth-forget')}}" style="float: right; margin-top: 7px;">忘记密码？</a>
            </div>
            <div class="layui-form-item">
                <button id="login-btn" action="{{route('novel-auth-login')}}" class="layui-btn layui-btn-fluid"
                        lay-submit lay-filter="login">登录
                </button>
            </div>
            <div class="layui-form-item login-other">
                <label>社交账号登录</label>
                <span style="padding: 0 21px 0 6px;">
        <a href="javascript:"><i class="layui-icon layui-icon-login-qq" style="color: #3492ed;"></i></a>
        <a href="javascript:"><i class="layui-icon layui-icon-login-wechat" style="color: #4daf29;"></i></a>
        <a href="javascript:"><i class="layui-icon layui-icon-login-weibo" style="color: #cf1900;"></i></a>
      </span>
                或 <a href="{{route('novel-auth-register')}}">注册帐号</a>
            </div>
        </div>
    </form>
    <script>
        layui.use(function () {
            var form = layui.form;
            var layer = layui.layer;
            // 提交事件
            form.on('submit(login)', function (data) {
                var jsend = $('#login-btn');
                jsend.button('loading');
                var postdata = $('#form').serialize();
                $.xpost(jsend.attr('action'), postdata, function (code, data, message) {
                    if (code == 0) {
                        console.log(data);
                        layer.msg('登录成功~');
                        jsend.button('reset');
                        $.cookie('user_id', data.user.uid, data.jwt.expires_in,'/')
                        $.cookie('username', data.user.nickname, data.jwt.expires_in,'/')
                        $.cookie('user', JSON.stringify(data.user), data.jwt.expires_in,'/')
                        $.cookie('access_token', data.jwt.access_token, data.jwt.expires_in,'/')
                        window.location.href = '/';
                    } else {
                        layer.alert(message, -1);
                        jsend.button('reset');
                    }
                });
                return false;
            });
        });
    </script>
@endsection