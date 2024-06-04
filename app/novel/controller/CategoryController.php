<?php

namespace app\novel\controller;

use app\service\NovelService;
use Exception;
use support\Request;

class CategoryController
{
    public $serv;

    protected $noNeedLogin = ['*'];

    public function __construct()
    {
        $this->serv = new NovelService();
    }

    public function index($cid, Request $request)
    {
        try {
            $page = $request->input('page', 1);
            $pageSize = $request->input('page_size', 12);
            $list = $this->serv->getCategoryNovelList($cid, $page, $pageSize);
            if (empty($list['data'])) {
                throw new Exception('书本不存在~');
            }
            if ($request->isAjax()) {
                return success(['cid' => $cid, 'list' => $list]);
            }
            return blade_view('index/category', compact('cid', 'list'));
        } catch (Exception $exception) {
            if ($request->isAjax()) {
                return error([], $exception);
            }
            return blade_view('index/error', ['message' => $exception->getMessage()]);
        }
    }

}
