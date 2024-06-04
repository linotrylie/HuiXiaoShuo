<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

use app\controller\CommonController;
use app\novel\controller\CategoryController;
use app\novel\controller\IndexController;
use app\novel\controller\NovelController;
use app\novel\controller\UserController;
use Webman\Route;
Route::any('/',[IndexController::class,'index'])->name('novel-home');
Route::any('/captcha-img',[CommonController::class,'captchaImg'])->name('captcha-img');
Route::any('/send-email-captcha-code',[CommonController::class,'sendEmailCaptcha'])->name('send-email-captcha-code');
Route::group('/novel',function(){
    //登录授权
    Route::group('/auth',function(){
        Route::any('/login', [app\novel\controller\AuthController::class, 'login'])->name('novel-auth-login');
        Route::any('/logout', [app\novel\controller\AuthController::class, 'logout'])->name('novel-auth-logout');
        Route::any('/register', [app\novel\controller\AuthController::class, 'register'])->name('novel-auth-register');
    });
    Route::get('/home',[IndexController::class,'index'])->name('novel-home');
    Route::get('/{nid:\d+}',[NovelController::class,'index'])->name('novel-book');
    Route::get('/category/{cid:\d+}',[CategoryController::class,'index'])->name('novel-category');
    Route::get('/add/{nid:\d+}',[NovelController::class,'userAddNovel'])->name('novel-user-add');
    Route::get('/{novelId:\d+}/{novelChapterId:\d+}',[NovelController::class,'chapter'])->name('novel-book-chapter');

    Route::group('/user',function(){
        Route::any('/bookcase', [UserController::class, 'bookcase'])->name('novel-user-bookcase');
        Route::any('/del-bookcase', [UserController::class, 'delBookcase'])->name('novel-user-del-bookcase');
    });
});










