<?php

namespace app\novel\controller;

use app\service\NovelService;
use support\Request;

class UserController
{
    public $serv;

    protected $noNeedLogin = [];

    public function __construct()
    {
        $this->serv = new NovelService();
    }

    public function index(Request $request)
    {
        return response(__CLASS__);
    }

    public function bookcase(Request $request)
    {
        try {
            $page = $request->get('page',0);
            $list = $this->serv->bookcase($page);
            if(empty($list)) {
                throw new \RuntimeException('书架为空~');
            }
            if ($request->isAjax()) {
                return success($list);
            }
            return blade_view('index/bookcase', ['data' => $list]);
        } catch (\Exception $exception) {
            if ($request->isAjax()) {
                return error([],$exception);
            }
            return blade_view('index/error', ['message' => $exception->getMessage()]);
        }
    }

    public function delBookcase(Request $request)
    {
        try {
            $nid = $request->post('nid','');
            if(empty($nid)) {
                throw new \RuntimeException('参数错误~');
            }
            $this->serv->delBookcase($nid);
            return success([]);
        } catch (\Exception $exception) {
            return error([],$exception);
        }
    }
}
