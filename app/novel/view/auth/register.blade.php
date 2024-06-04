@extends('layouts.layout')
@section('content')
    <style>
        .reg-container {
            width: 320px;
            margin: 21px auto 0;
        }

        .reg-other .layui-icon {
            position: relative;
            display: inline-block;
            margin: 0 2px;
            top: 2px;
            font-size: 26px;
        }
    </style>
    <form class="layui-form" id="form">
        <div class="reg-container">

            <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <div class="layui-input-prefix">
                        <i class="layui-icon layui-icon-username"></i>
                    </div>
                    <input type="text" name="username" value="" lay-verify="required" placeholder="用户名"
                           autocomplete="off"
                           class="layui-input" lay-affix="clear">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <div class="layui-input-prefix">
                        <i class="layui-icon layui-icon-username"></i>
                    </div>
                    <input type="text" name="nickname" value="" lay-verify="required" placeholder="昵称"
                           autocomplete="off"
                           class="layui-input" lay-affix="clear">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <div class="layui-input-prefix">
                        <i class="layui-icon layui-icon-password"></i>
                    </div>
                    <input type="password" name="password" value="" lay-verify="required" placeholder="密码"
                           autocomplete="off" class="layui-input" id="reg-password" lay-affix="eye">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <div class="layui-input-prefix">
                        <i class="layui-icon layui-icon-password"></i>
                    </div>
                    <input type="password" name="confirmPassword" value="" lay-verify="required|confirmPassword"
                           placeholder="确认密码" autocomplete="off" class="layui-input" lay-affix="eye">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-row">
                    <div class="layui-col-xs7">
                        <div class="layui-input-wrap">
                            <div class="layui-input-prefix">
                                <i class="layui-icon layui-icon-email"></i>
                            </div>
                            <input type="text" name="email" value="" lay-verify="required|email" placeholder="邮箱"
                                   lay-reqtext="请填写邮箱" autocomplete="off" class="layui-input" id="reg-email">
                        </div>
                    </div>
                    <div class="layui-col-xs5">
                        <div style="margin-left: 11px;">
                            <button data-loading-text="验证码发送中。。。" id="sendcode" type="button"
                                    class="layui-btn layui-btn-fluid layui-btn-primary" lay-on="reg-get-vercode"
                                    action="{{route('send-email-captcha-code')}}">获取验证码
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-wrap">
                    <div class="layui-input-prefix">
                        <i class="layui-icon layui-icon-vercode"></i>
                    </div>
                    <input type="text" id="code" name="emailCaptchaCode" value="" lay-verify="required"
                           placeholder="验证码"
                           lay-reqtext="请填写验证码" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <input type="checkbox" name="agreement" lay-verify="required" lay-skin="primary" title="同意">
                <a href="{{route('novel-service-terms')}}" target="_blank"
                   style="position: relative; top: 6px; left: -15px;">
                    <ins>用户协议</ins>
                </a>
            </div>
            <div class="layui-form-item">
                <button id="register-btn" class="layui-btn layui-btn-fluid" lay-submit lay-filter="register"
                        action="{{route('novel-auth-register')}}">注册
                </button>
            </div>
            <div class="layui-form-item reg-other">
                <label>社交账号注册</label>
                <span style="padding: 0 21px 0 6px;">
        <a href="javascript:"><i class="layui-icon layui-icon-login-qq" style="color: #3492ed;"></i></a>
        <a href="javascript:"><i class="layui-icon layui-icon-login-wechat" style="color: #4daf29;"></i></a>
        <a href="javascript:"><i class="layui-icon layui-icon-login-weibo" style="color: #cf1900;"></i></a>
      </span>
                <a href="{{route('novel-auth-login')}}">登录已有帐号</a>
            </div>
        </div>
    </form>
    <script>
        layui.use(['jquery', 'layer'], function () {
            var $ = layui.$;
            var form = layui.form;
            var layer = layui.layer;
            var util = layui.util;
            // 自定义验证规则
            form.verify({
                // 确认密码
                confirmPassword: function (value, item) {
                    var passwordValue = $('#reg-password').val();
                    if (value !== passwordValue) {
                        return '两次密码输入不一致';
                    }
                }
            });
            // 提交事件
            form.on('submit(register)', function (data) {
                var field = data.field; // 获取表单字段值
                // 是否勾选同意
                if (!field.agreement) {
                    layer.msg('您必须勾选同意用户协议才能注册');
                    return false;
                }
                var jsend = $('#register-btn');
                jsend.button('loading');
                var postdata = $('#form').serialize();
                $.xpost(jsend.attr('action'), postdata, function (code, data, message) {
                    if (code === 0) {
                        layer.msg('注册成功~');
                        $.cookie('user', data.user, data.jwt.expires_in)
                        $.cookie('access_token', data.jwt.access_token, data.jwt.expires_in)
                    } else if (code < 0) {
                        layer.alert(message, -1);
                        jsend.button('reset');
                    } else {
                        jsend.button('reset');
                    }
                });
                return false; // 阻止默认 form 跳转
            });
            // 普通事件
            util.on('lay-on', {
                'reg-get-vercode': function (othis) {
                    const isvalid = form.validate('#reg-email');
                    if (!isvalid) {
                        layer.msg('邮箱规则验证不通过');
                        return;
                    }
                    const jsend = $('#sendcode');
                    jsend.button('loading');
                    layer.msg('请尽快填写验证码，完成注册！');
                    $('#emailCaptchaCode').focus();
                    let t = 60; // 倒计时
                    const handler = setInterval(function () {
                        jsend.button('请稍后再试！' + (--t) + ' ');
                        if (t === 0) {
                            clearInterval(handler);
                            jsend.button('reset');
                        }
                    }, 1000);
                    const postdata = $('#form').serialize();
                    $.xpost(jsend.attr('action'), postdata, function (code, data, msg) {
                        if (code < 0) {
                            layer.alert(msg, -1);
                            jsend.button('reset');
                        } else {
                            jsend.button('reset');
                        }
                    });
                }
            });
        });
    </script>
@endsection