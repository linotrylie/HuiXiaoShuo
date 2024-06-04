<?php

namespace app\novel\controller;

use app\model\NovelChapter;
use app\repository\NovelChapterRepository;
use app\service\NovelService;
use support\Request;

class IndexController
{
    protected $noNeedLogin = ['*'];

    public function index(Request $request)
    {
        try {
            return blade_view('index/home',(new NovelService())->index());
        }catch (\Exception $exception) {
            return error([],$exception);
        }
    }

    public function view(Request $request)
    {
        return view('index/view', ['name' => 'webman']);
    }

    public function json(Request $request)
    {
        return json(['code' => 0, 'msg' => 'ok']);
    }

}
