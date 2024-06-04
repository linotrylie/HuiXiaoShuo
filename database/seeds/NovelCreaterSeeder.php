<?php


use app\model\Category;
use Phinx\Seed\AbstractSeed;

class NovelCreaterSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $novelData = [
            [
                'cid' => 12,
                'title' => '神道帝尊',
                'pic' => '/upload/img/25981.jpg',
                'author' => '蜗牛狂奔',
                'content' => '《神道帝尊》是蜗牛狂奔精心创作的都市言情，ABC小说网实时更新神道帝尊最新章......',
                'tag' => '[玄幻],[奇幻],[玄幻奇幻]',
            ],
            [
                'cid' => 12,
                'title' => '都市极品神医',
                'pic' => '/upload/img/81468.jpg',
                'author' => '风会笑',
                'content' => '江城高铁站，夏日炎炎。熙攘的人群中出现了一道消瘦的身影，引入注目。身影的主人是一个青年，青年穿着一件洗的几乎发白的军绿T恤，戴着一顶鸭舌帽，身上斜跨着一个老式帆布包。',
                'tag' => '[玄幻],[奇幻],[玄幻奇幻]',
            ],
            [
                'cid' => 12,
                'title' => '混沌剑神',
                'pic' => '/upload/img/1156.jpg',
                'author' => '心星逍遥',
                'content' => '剑尘，江湖中公认的第一高手，一手快剑法出神入化，无人能破，当他与消失百年的绝世高手独孤求败一战之后，身死而亡。 死后，剑尘的灵魂转世来到了一个陌生的世界，并且飞快的成长了起来 ，最后因仇家太多，被仇家打成重伤，在生死关头灵魂发生异变，从此以后，他便踏上了一条完全不同的剑道修炼之路，最终成为一代剑神。 ',
                'tag' => '[玄幻],[奇幻],[玄幻奇幻]',
            ],
            [
                'cid' => 12,
                'title' => '开局签到荒古圣体',
                'pic' => '/upload/img/1666.jpg',
                'author' => 'J神',
                'content' => '【不废柴，不舔狗，天骄争霸暴爽无敌流】君逍遥穿越玄幻世界，成为荒古世家神子，拥有无敌背景，惊世天赋，更得到签到系统，开局签到一具大成荒古圣体。在泰岳古碑签到，获得六星奖励，神象镇狱 劲！在十岁宴上签到，获得七星奖励，至尊骨！在青铜仙殿签到，获得八星奖励，万物母气鼎！在无边界海签到，获得十星奖励，他化自在大法！无数年后，君逍遥盘坐九霄，剑指苍天道：“九天十地，我主沉浮，仙路尽头，我为巅峰！',
                'tag' => '[玄幻],[奇幻],[玄幻奇幻]',
            ],
            [
                'cid' => 13,
                'title' => '最强boss系统',
                'pic' => '/upload/img/3658.jpg',
                'author' => '封七月',
                'content' => '什么是江湖？是拳倾天下，纵横一世，还是万人皆敌，搅动风云？　　重生一世，最强boss系统加身，苏信可以获得前世武侠世界当中所有的boss人物的功法和武技。　　“我叫苏信，我言而有信 。',
                'tag' => '[武侠],[仙侠],[武侠仙侠]',
            ],
            [
                'cid' => 13,
                'title' => '阿飞正传',
                'pic' => '/upload/img/3658.jpg',
                'author' => '封七月',
                'content' => '什么是江湖？是拳倾天下，纵横一世，还是万人皆敌，搅动风云？　　重生一世，最强boss系统加身，苏信可以获得前世武侠世界当中所有的boss人物的功法和武技。　　“我叫苏信，我言而有信 。',
                'tag' => '[武侠],[仙侠],[武侠仙侠]',
            ],
            [
                'cid' => 13,
                'title' => '卖报小郎君',
                'pic' => '/upload/img/3658.jpg',
                'author' => '封七月',
                'content' => '什么是江湖？是拳倾天下，纵横一世，还是万人皆敌，搅动风云？　　重生一世，最强boss系统加身，苏信可以获得前世武侠世界当中所有的boss人物的功法和武技。　　“我叫苏信，我言而有信 。',
                'tag' => '[武侠],[仙侠],[武侠仙侠]',
            ],
            [
                'cid' => 13,
                'title' => '仙都',
                'pic' => '/upload/img/3658.jpg',
                'author' => '封七月',
                'content' => '什么是江湖？是拳倾天下，纵横一世，还是万人皆敌，搅动风云？　　重生一世，最强boss系统加身，苏信可以获得前世武侠世界当中所有的boss人物的功法和武技。　　“我叫苏信，我言而有信 。',
                'tag' => '[武侠],[仙侠],[武侠仙侠]',
            ],
            [
                'cid' => 14,
                'title' => '猎户出山',
                'pic' => '/upload/img/3658.jpg',
                'author' => '封七月',
                'content' => '什么是江湖？是拳倾天下，纵横一世，还是万人皆敌，搅动风云？　　重生一世，最强boss系统加身，苏信可以获得前世武侠世界当中所有的boss人物的功法和武技。　　“我叫苏信，我言而有信 。',
                'tag' => '[都市],[言情],[都市言情]',
            ],
            [
                'cid' => 14,
                'title' => '官场',
                'pic' => '/upload/img/3658.jpg',
                'author' => '封七月',
                'content' => '什么是江湖？是拳倾天下，纵横一世，还是万人皆敌，搅动风云？　　重生一世，最强boss系统加身，苏信可以获得前世武侠世界当中所有的boss人物的功法和武技。　　“我叫苏信，我言而有信 。',
                'tag' => '[都市],[言情],[都市言情]',
            ],
            [
                'cid' => 14,
                'title' => '龙门医婿',
                'pic' => '/upload/img/3658.jpg',
                'author' => '封七月',
                'content' => '什么是江湖？是拳倾天下，纵横一世，还是万人皆敌，搅动风云？　　重生一世，最强boss系统加身，苏信可以获得前世武侠世界当中所有的boss人物的功法和武技。　　“我叫苏信，我言而有信 。',
                'tag' => '[都市],[言情],[都市言情]',
            ],
            [
                'cid' => 14,
                'title' => '盖世神医',
                'pic' => '/upload/img/3658.jpg',
                'author' => '封七月',
                'content' => '什么是江湖？是拳倾天下，纵横一世，还是万人皆敌，搅动风云？　　重生一世，最强boss系统加身，苏信可以获得前世武侠世界当中所有的boss人物的功法和武技。　　“我叫苏信，我言而有信 。',
                'tag' => '[都市],[言情],[都市言情]',
            ],
            [
                'cid' => 14,
                'title' => '都市狂枭',
                'pic' => '/upload/img/3658.jpg',
                'author' => '陈六合',
                'content' => '什么是江湖？是拳倾天下，纵横一世，还是万人皆敌，搅动风云？　　重生一世，最强boss系统加身，苏信可以获得前世武侠世界当中所有的boss人物的功法和武技。　　“我叫苏信，我言而有信 。',
                'tag' => '[都市],[言情],[都市言情]',
            ],
            [
                'cid' => 15,
                'title' => '团宠郡主小暖宝',
                'pic' => '/upload/img/93561.jpg',
                'author' => '封七月',
                'content' => '【团宠萌宝温馨搞笑轻松小白文】一觉醒来，发现自己成了一个刚出生的婴儿！什么？......',
                'tag' => '[历史],[军事],[历史军事]',
            ],
            [
                'cid' => 15,
                'title' => '红楼春',
                'pic' => '/upload/img/93561.jpg',
                'author' => '封七月',
                'content' => '【团宠萌宝温馨搞笑轻松小白文】一觉醒来，发现自己成了一个刚出生的婴儿！什么？......',
                'tag' => '[历史],[军事],[历史军事]',
            ],
            [
                'cid' => 15,
                'title' => '房客',
                'pic' => '/upload/img/93561.jpg',
                'author' => '九五',
                'content' => '【团宠萌宝温馨搞笑轻松小白文】一觉醒来，发现自己成了一个刚出生的婴儿！什么？......',
                'tag' => '[历史],[军事],[历史军事]',
            ],
            [
                'cid' => 15,
                'title' => '诡三国',
                'pic' => '/upload/img/93561.jpg',
                'author' => '马月后年',
                'content' => '【团宠萌宝温馨搞笑轻松小白文】一觉醒来，发现自己成了一个刚出生的婴儿！什么？......',
                'tag' => '[历史],[军事],[历史军事]',
            ],
            [
                'cid' => 15,
                'title' => '邪器',
                'pic' => '/upload/img/93561.jpg',
                'author' => '知乐',
                'content' => '【团宠萌宝温馨搞笑轻松小白文】一觉醒来，发现自己成了一个刚出生的婴儿！什么？......',
                'tag' => '[历史],[军事],[历史军事]',
            ],
            [
                'cid' => 15,
                'title' => '国破山河在',
                'pic' => '/upload/img/93561.jpg',
                'author' => '华表',
                'content' => '【团宠萌宝温馨搞笑轻松小白文】一觉醒来，发现自己成了一个刚出生的婴儿！什么？......',
                'tag' => '[历史],[军事],[历史军事]',
            ],
            [
                'cid' => 16,
                'title' => '文明之万界领主',
                'pic' => '/upload/img/857.jpg',
                'author' => '飞翔de懒猫',
                'content' => '【团宠萌宝温馨搞笑轻松小白文】一觉醒来，发现自己成了一个刚出生的婴儿！什么？......',
                'tag' => '[网游],[竞技],[网游竞技]',
            ],
            [
                'cid' => 16,
                'title' => '网游之近战法师',
                'pic' => '/upload/img/4291.jpg',
                'author' => '蝴蝶蓝',
                'content' => '一个超级武者,在玩网游时误选了法师,习惯以暴制暴,以力降力的他,只能将错就错,摇身一变,成为一个近战暴力法师,当力量与法术完美结合时,一条新的游戏之路,被他打开了!',
                'tag' => '[网游],[竞技],[网游竞技]',
            ],
            [
                'cid' => 16,
                'title' => '我的救世游戏成真了',
                'pic' => '/upload/img/4291.jpg',
                'author' => '笔墨纸键',
                'content' => '一个超级武者,在玩网游时误选了法师,习惯以暴制暴,以力降力的他,只能将错就错,摇身一变,成为一个近战暴力法师,当力量与法术完美结合时,一条新的游戏之路,被他打开了!',
                'tag' => '[网游],[竞技],[网游竞技]',
            ],
            [
                'cid' => 16,
                'title' => '禁区之狐',
                'pic' => '/upload/img/4291.jpg',
                'author' => '林海听涛',
                'content' => '一个超级武者,在玩网游时误选了法师,习惯以暴制暴,以力降力的他,只能将错就错,摇身一变,成为一个近战暴力法师,当力量与法术完美结合时,一条新的游戏之路,被他打开了!',
                'tag' => '[网游],[竞技],[网游竞技]',
            ],
            [
                'cid' => 16,
                'title' => '和男主同归于尽',
                'pic' => '/upload/img/4291.jpg',
                'author' => '画七',
                'content' => '一个超级武者,在玩网游时误选了法师,习惯以暴制暴,以力降力的他,只能将错就错,摇身一变,成为一个近战暴力法师,当力量与法术完美结合时,一条新的游戏之路,被他打开了!',
                'tag' => '[网游],[竞技],[网游竞技]',
            ],
            [
                'cid' => 16,
                'title' => '繁衍计划',
                'pic' => '/upload/img/4291.jpg',
                'author' => '画七',
                'content' => '一个超级武者,在玩网游时误选了法师,习惯以暴制暴,以力降力的他,只能将错就错,摇身一变,成为一个近战暴力法师,当力量与法术完美结合时,一条新的游戏之路,被他打开了!',
                'tag' => '[网游],[竞技],[网游竞技]',
            ],
            [
                'cid' => 17,
                'title' => '娇养',
                'author' => '画七',
                'content' => '养成记十五岁少女被成熟男人霸占从不甘到沦陷……......',
                'tag' => '[科幻],[灵异],[科幻灵异]',
            ],
            [
                'cid' => 17,
                'title' => '沉沦',
                'author' => '画七',
                'content' => '养成记十五岁少女被成熟男人霸占从不甘到沦陷……......',
                'tag' => '[科幻],[灵异],[科幻灵异]',
            ],
            [
                'cid' => 17,
                'title' => '全球崩坏',
                'author' => '画七',
                'content' => '养成记十五岁少女被成熟男人霸占从不甘到沦陷……......',
                'tag' => '[科幻],[灵异],[科幻灵异]',
            ],
            [
                'cid' => 17,
                'title' => '末日重启',
                'author' => '画七',
                'content' => '养成记十五岁少女被成熟男人霸占从不甘到沦陷……......',
                'tag' => '[科幻],[灵异],[科幻灵异]',
            ],
            [
                'cid' => 17,
                'title' => '囚欢',
                'author' => '画七',
                'content' => '养成记十五岁少女被成熟男人霸占从不甘到沦陷……......',
                'tag' => '[科幻],[灵异],[科幻灵异]',
            ],
            [
                'cid' => 17,
                'title' => '伴娘',
                'author' => '画七',
                'content' => '养成记十五岁少女被成熟男人霸占从不甘到沦陷……......',
                'tag' => '[科幻],[灵异],[科幻灵异]',
            ],
        ];
        $novel = $this->table('xs_novel');
        $novel->insert($novelData)->save();
    }
}