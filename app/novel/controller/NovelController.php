<?php

namespace app\novel\controller;

use app\service\NovelService;
use Exception;
use support\Request;
use support\Response;

class NovelController
{
    public $serv;

    protected $noNeedLogin = ['index','chapter'];

    public function __construct()
    {
        $this->serv = new NovelService();
    }

    public function index(Request $request,$nid)
    {
        try {
            $data = $this->serv->novel($nid);
            if ($request->isAjax()) {
                return success($data);
            }
            return blade_view('index/novel', $data);
        } catch (Exception $exception) {
            return blade_view('index/error', ['message' => $exception->getMessage()]);
        }
    }

    /**
     * Linotrylie
     * 2024/4/8 - 23:12
     * 加入书架
     * 如果代码和注释不一致，那很可能两者都错了
     * @Description
     * @param $nid
     * @param Request $request
     * @return Response
     */
    public function userAddNovel(Request $request,$nid): Response
    {
        try {
            $res = $this->serv->userAddNovel($nid);
            if ($res) {
                return success([]);
            }
            throw new Exception("加入失败~");
        } catch (Exception $exception) {
            return error([], $exception);
        }
    }

    public function chapter(Request $request,$novelId, $novelChapterId): Response
    {
        try {
            $data = $this->serv->chapter($novelId, $novelChapterId);
            if($request->isAjax()) {
                return success($data);
            }
            return blade_view('index/chapter',$data);
        } catch (Exception $exception) {
            return blade_view('index/error', ['message' => $exception->getMessage()]);
        }
    }
}
