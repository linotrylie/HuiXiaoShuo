<?php
/**
 * NovelService.php
 * Linotrylie
 * 2024/4/7 - 16:47
 * @Description
 * 天下万般兵刃，唯过往伤人最深
 */

namespace app\service;

use app\model\Novel;
use app\model\NovelChapter;
use app\model\NovelReadHistory;
use app\model\NovelUser;
use app\model\User;
use app\repository\CategoryRepository;
use app\repository\NovelChapterRepository;
use app\repository\NovelPurchaseHistoryRepository;
use app\repository\NovelReadHistoryRepository;
use app\repository\NovelRepository;
use app\repository\NovelUserRepository;
use Exception;
use Illuminate\Support\Facades\Date;
use RuntimeException;

class NovelService
{

    public $novelRepo;
    public $categoryRepo;

    public $novelChapterRepo;
    public $novelPurchaseHistoryRepo;

    public $novelReadHistoryRepo;

    public $novelUserRepo;

    public function __construct()
    {
        $this->novelRepo = new NovelRepository();

        $this->categoryRepo = new CategoryRepository();

        $this->novelChapterRepo = new NovelChapterRepository();

        $this->novelPurchaseHistoryRepo = new NovelPurchaseHistoryRepository();

        $this->novelReadHistoryRepo = new NovelReadHistoryRepository();

        $this->novelUserRepo = new NovelUserRepository();
    }

    /**
     * Linotrylie
     * 2024/4/17 - 14:57
     * 如果代码和注释不一致，那很可能两者都错了
     * @Description
     * @return array
     */
    public function index(): array
    {
        $topPosition = $this->novelRepo->getListByPosition(1, 4);
        $recommendPosition = $this->novelRepo->getListByPosition(2, 9);
        $categories = $this->categoryRepo->getCategoryList(2, 6);
        $cateNovelListA = [];
        $cateNovelListB = [];
        foreach ($categories as $key => $item) {
            $novel = $this->novelRepo->getListByCategory($item['cid'], 9);
            if (($key < 3) && !isset($cateNovelListA[$item['title']])) {
                $cateNovelListA[$item['title']] = $novel;
            }
            if (($key > 2) && !isset($cateNovelListB[$item['title']])) {
                $cateNovelListB[$item['title']] = $novel;
            }
        }
        $updatedList = $this->novelRepo->all([], relation: ['category', 'lastChapter'], limit: 20);
        $updatedInnerList = $this->novelRepo->all([], relation: ['category'], limit: 20);
        return [
            'top' => $topPosition,
            'recommend' => $recommendPosition,
            'category_list_a' => $cateNovelListA,
            'category_list_b' => $cateNovelListB,
            'updated_list' => $updatedList,
            'inner_list' => $updatedInnerList
        ];
    }

    public function getCategoryNovelList($cid, $page, $pageSize)
    {
        $cats = $this->categoryRepo->getCategoryListByPid($cid);
        $cateIds = array_column($cats, 'cid');
        return $this->novelRepo->getPaginationByCid($cateIds, $page, $pageSize);
    }

    /**
     * Linotrylie
     * 2024/4/17 - 14:51
     * 如果代码和注释不一致，那很可能两者都错了
     * @Description
     * @param $nid
     * @return array
     */
    public function novel($nid): array
    {
        $novel = $this->novelRepo->one(['nid'=>$nid],['chapter', 'lastChapter', 'category']);
        if (empty($novel)) {
            throw new RuntimeException("无该书籍信息~");
        }
        if (empty($novel['chapter'])) {
            throw new RuntimeException("该书籍无内容信息~");
        }
        $newBook = (new Novel())->getNewRecommend();
        return ['novel' => $novel, 'new_recommend' => $newBook];
    }

    /**
     * Linotrylie
     * 2024/4/17 - 14:50
     * 如果代码和注释不一致，那很可能两者都错了
     * @Description 加入书架
     * @param $nid
     * @return bool
     */
    public function userAddNovel($nid): bool
    {
        $user = $this->checkUserLoginStatusAndUser();
        $uid = $user->uid;
        $record = $this->novelUserRepo->one(['nid' => $nid,'uid' => $uid]);
        if (!empty($record)) {
            throw new RuntimeException("已存在于书架中~");
        }
        $novel = $this->novelRepo->one(['nid' => $nid]);
        if (empty($novel)) {
            throw new RuntimeException("书本不存在~");
        }
        return NovelUser::insert(['nid' => $nid, 'uid' => $uid, 'created_at' => Date::now()]);
    }

    /**
     * Linotrylie
     * 2024/4/10 - 9:44
     * 如果代码和注释不一致，那很可能两者都错了
     * @Description
     * @return User
     */
    private function checkUserLoginStatusAndUser(): User
    {
        $user = AuthService::getInstance()->user();
        if ($user === null) {
            throw new RuntimeException("请登陆后再操作~");
        }
        return $user;
    }

    /**
     * Linotrylie
     * 2024/4/17 - 14:50
     * 如果代码和注释不一致，那很可能两者都错了
     * @Description 章节
     * @param $nid
     * @param $ncid
     * @return array
     * @throws Exception
     */
    public function chapter($nid, $ncid): array
    {
        $novel = $this->novelRepo->one(['nid' => $nid]);
        if (empty($novel)) {
            throw new RuntimeException("书本不存在~");
        }
        $chapter = $this->novelChapterRepo->one(['nid' => $nid, 'ncid' => $ncid]);
        if (empty($chapter)) {
            throw new RuntimeException("无此章节~");
        }
        //判断收费方式
        switch ($novel['sell_way']) {
            case Novel::SELL_WAY_ONE_CHARGE:
                $this->novelPurchase($novel);
                break;
            case Novel::SELL_WAY_CHAPTER_CHARGE:
                $this->novelChapterPurchase($novel, $chapter);
                break;
            case Novel::SELL_WAY_VIP:
                $this->novelVip($novel);
                break;
            case Novel::SELL_WAY_FREE:
            default:
                break;
        }
        $user = AuthService::getInstance()->user();
        if ($user !== null) {
            $this->saveReadHistory($user->uid, $novel['nid'], $chapter['ncid']);
        }
        $preChapter = $this->novelChapterRepo->one(where: [['nid', '=', $nid], ['ncid', '<', $ncid]]);
        $nextChapter = $this->novelChapterRepo->one(where: [['nid', '=', $nid], ['ncid', '>', $ncid]], orderBy: ['created_at' => 'asc']);
        $new_recommend = (new Novel())->getNewRecommend();
        return compact('novel', 'chapter', 'preChapter', 'nextChapter', 'new_recommend');
    }

    /**
     * Linotrylie
     * 2024/4/17 - 14:49
     * 如果代码和注释不一致，那很可能两者都错了
     * @Description 小说付费
     * @param $novel
     * @return void
     */
    private function novelPurchase($novel): void
    {
        $user = $this->purchase($novel, []);
        if ($user === null) return;
        $data = [
            'nid' => $novel['nid'],
            'ncid' => 0,
            'gold' => $novel['gold'],
            'rmb' => $novel['rmb'],
            'created_at' => Date::now()
        ];
        $this->novelPurchaseHistoryRepo->save($data);
    }

    /**
     * Linotrylie
     * 2024/4/17 - 14:46
     * 如果代码和注释不一致，那很可能两者都错了
     * @Description 付费
     * @param $novel
     * @param $chapter
     * @return User|null
     */
    private function purchase($novel, $chapter): ?User
    {
        $user = $this->checkUserLoginStatusAndUser();
        $purchaseHistory = $this->novelPurchaseHistoryRepo->one(where: ['nid' => $novel['nid'], 'uid' => $user->uid, 'ncid' => $chapter['ncid']]);
        if (!empty($purchaseHistory)) return null;
        if ($chapter['gold'] > 0) {
            if ($user->gold < $chapter['gold']) {
                throw new RuntimeException("金币余额不足~，所需金币{$chapter['gold']}，您当前剩余金币{$user->gold}");
            }
            $user->gold = bcsub($user->gold, $chapter['gold'], 2);
            $user->save();
        }
        if ($chapter['rmb'] > 0) {
            if ($user->rmb < $chapter['rmb']) {
                throw new RuntimeException("点券余额不足~，所需点券{$chapter['rmb']}，您当前剩余点券{$user->rmb}");
            }
            $user->rmb = bcsub($user->rmb, $chapter['rmb'], 2);
            $user->save();
        }
        return $user;
    }

    /**
     * Linotrylie
     * 2024/4/17 - 14:49
     * 如果代码和注释不一致，那很可能两者都错了
     * @Description 章节付费
     * @param $novel
     * @param $chapter
     * @return void
     */
    private function novelChapterPurchase($novel, $chapter): void
    {
        $user = $this->purchase($novel, $chapter);
        if ($user === null) return;
        $data = [
            'nid' => $novel['nid'],
            'ncid' => $chapter['ncid'],
            'gold' => $chapter['gold'],
            'rmb' => $chapter['rmb'],
            'created_at' => Date::now()
        ];
        $this->novelPurchaseHistoryRepo->insert($data);
        $this->saveReadHistory($user->uid, $novel['nid'], $chapter['ncid']);
    }

    /**
     * Linotrylie
     * 2024/4/17 - 14:49
     * 如果代码和注释不一致，那很可能两者都错了
     * @Description 保存阅读记录
     * @param $uid
     * @param $nid
     * @param $ncid
     * @return void
     */
    public function saveReadHistory($uid, $nid, $ncid): void
    {
        $cond = [
            'nid' => $nid,
            'uid' => $uid
        ];
        $data = [
            'nid' => $nid,
            'ncid' => $ncid,
            'uid' => $uid
        ];
        NovelReadHistory::updateOrCreate($cond, $data);
    }

    private function novelVip($novel): void
    {
        $user = $this->checkUserLoginStatusAndUser();
        if (strtotime($user->vip_expired_at) < time()) {
            throw new RuntimeException("VIP已过期~");
        }
        if ($user->vip_level < $novel['vip_level']) {
            throw new RuntimeException("VIP等级不足~");
        }
    }

    /**
     * Linotrylie
     * 2024/4/10 - 9:39
     * 如果代码和注释不一致，那很可能两者都错了
     * @Description 我的书架
     * @param $page
     * @return array
     */
    public function bookcase($page): array
    {
        $user = $this->checkUserLoginStatusAndUser();
        $where = ['uid' => $user->uid,];
        $offset = $page * 9;
        $limit = 9;
        $bookcaseData = NovelUser::where($where)->limit($limit)->offset($offset)->get()->toArray();
        if (empty($bookcaseData)) {
            throw new RuntimeException("没有更多书籍了！");
        }
        $nidArr = array_column($bookcaseData, 'nid');
        $readHistoryData = $this->novelReadHistoryRepo->getUserReadHistoryList($where, $nidArr);
        $readData = [];
        if (!empty($readHistoryData)) {
            $readOrWhere = [];
            foreach ($readHistoryData as $readItem) {
                $readOrWhere[] = [
                    'nid' => $readItem['nid'],
                    'ncid' => $readItem['ncid']
                ];
            }
            $readData = NovelChapter::query()->whereNull('deleted_at')
                ->where(function ($query) use ($readOrWhere) {
                    foreach ($readOrWhere as $orWhere) {
                        $query = $query->orWhere($orWhere);
                    }
                })->get()->toArray();
        }
        $readNovelChapter = [];
        if (!empty($readData)) {
            foreach ($readData as $readDatum) {
                $readNovelChapter[$readDatum['nid']] = [
                    'nid' => $readDatum['nid'],
                    'ncid' => $readDatum['ncid'],
                    'source' => $readDatum['source']
                ];
            }
        }
        $novelData = $this->novelRepo->getListByNids(['nid' => $nidArr], ['lastChapter']);
        $novel = [];
        foreach ($novelData as $novelDatum) {
            $novel[$novelDatum['nid']] = [
                'nid' => $novelDatum['nid'],
                'title' => $novelDatum['title'],
                'author' => $novelDatum['author'],
                'updated_at' => $novelDatum['updated_at'],
                'lastchapter' => $novelDatum['last_chapter']
            ];
        }
        $data = [];
        foreach ($bookcaseData as $bookcaseDatum) {
            $data[] = [
                'title' => $novel[$bookcaseDatum['nid']]['title'],
                'nid' => $bookcaseDatum['nid'],
                'author' => $novel[$bookcaseDatum['nid']]['author'],
                'updated_at' => $novel[$bookcaseDatum['nid']]['updated_at'],
                'lastchapter' => $novel[$bookcaseDatum['nid']]['lastchapter'] ?? [],
                'readchapter' => $readNovelChapter[$bookcaseDatum['nid']] ?? []
            ];
        }
        return $data;
    }

    public function delBookcase($nid): bool
    {
        $user = $this->checkUserLoginStatusAndUser();
        $where = ['uid' => $user->uid, 'nid' => $nid];
        $bookcase = NovelUser::where($where)->whereNull('deleted_at')->first();
        if ($bookcase === null) {
            throw new RuntimeException("该书籍不存在于书架中~");
        }
        $bookcase->deleted_at = Date::now();
        $bookcase->save();
        return true;
    }
}