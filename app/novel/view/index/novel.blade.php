@extends('layouts.layout')
@section('content')
    <div class="book">
        <div class="path wap_none"><a href="/">{{$header['icon-title']}}</a> &gt; {{$novel['category']['title']}} &gt; {{$novel['title']}}全文免费阅读<span
                    class="oninfo"><a class="ll" rel="nofollow" title="更新报错留言"
                                      href="javascript:book_error('{{$novel['nid']}}','{{$novel['title']}}');">更新报错</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a
                        rel="nofollow" href="#comment">直达底部</a></span></div>
        <div class="info">
            <div class="cover"><img src="{{$novel['pic']}}" alt="{{$novel['title']}}"></div>
            <h1>{{$novel['title']}}</h1>
            <div class="small">
                <span>作者：{{$novel['author']}}</span>
                <span>状态：{{$novel['serialize'] == 0 ? '连载' : '完结'}}</span>
                <span class="last">更新：{{$novel['updated_at']}}</span>
				@if(!is_null($novel['last_chapter']))
					<span class="last">最新：<a href="/novel/{{$novel['nid']}}/{{$novel['last_chapter']['ncid']}}">{{$novel['last_chapter']['source']}}</a></span>
				@elseif(!empty($novel['chapter']))
					<span class="last">最新：<a href="/novel/{{$novel['nid']}}/{{$novel['chapter']['ncid']}}">{{$novel['chapter']['source']}}</a></span>
                @else
                    <span class="last">无最新内容</span>
                @endif
            </div>
            <div class="readlink">
                <a rel="nofollow" href="javascript:" onclick="addBookCase('{{$novel['nid']}}');">加入书架</a>
                @if(!is_null($novel['last_chapter']))
                    <a class="rl" href="/novel/{{$novel['nid']}}/{{$novel['last_chapter']['ncid']}}">开始阅读</a>
                @elseif(!empty($novel['chapter']))
                    <a class="rl" href="/novel/{{$novel['nid']}}/{{$novel['chapter']['ncid']}}">开始阅读</a>
                @else
                    <a class="rl" href="javascript:void(0);">无内容</a>
                @endif
            </div>
            <div class="intro">
                <dl>
                    <dt>内容简介：</dt>
                    <dd>
						<?php echo mb_substr($novel['content'],0,40);?>
                        <span class="noshow"><?php echo mb_substr($novel['content'],40);?></span>
                        <span class="allshow">展开全部&gt;&gt;</span>
                    </dd>
                </dl>
            </div>
            <div class="link wap_none">
                新书推荐：
				@foreach($new_recommend as $newItem)
					<a href="/novel/{{$newItem['nid']}}/">{{$newItem['title']}}</a>&nbsp;
				@endforeach
            </div>
        </div>
    </div>
    <div class="listmain">
        <dl>
            <dt>{{$novel['title']}}最新章节列表</dt>
				<?php
					if(count($novel['chapter'])>30) {
						$chapterA = array_slice($novel['chapter'],0,10);
						$chapterB = array_slice($novel['chapter'],10,count($novel['chapter'])-20);
						$chapterC = array_slice($novel['chapter'],-10);
						foreach ($chapterA as $ia) {
							echo "<dd><a class='chapter' href='javascript:void(0);' data-nid='{$ia['nid']}' data-ncid='{$ia['ncid']}'>{$ia['source']}</a></dd>";
						}
						$temp =  <<<EOF
<dd class="more pc_none">
	<a rel="nofollow" href="javascript:dd_show()">&lt;&lt;---展开全部章节---&gt;&gt;</a>
</dd>
<span class="dd_hide">
EOF;
						foreach ($chapterB as $ib) {
							$temp .= "<dd><a class='chapter' href='javascript:void(0);' data-nid='{$ib['nid']}' data-ncid='{$ib['ncid']}'>{$ib['source']}</a></dd>";
						}
						$temp .= "</span>";
                        echo $temp;
                        foreach ($chapterC as $ic) {
                            echo "<dd><a class='chapter' href='javascript:void(0);' data-nid='{$ic['nid']}' data-ncid='{$ic['ncid']}'>{$ic['source']}</a></dd>";
                        }
					}elseif(count($novel['chapter']) > 0 && count($novel['chapter']) < 31){
						foreach($novel['chapter'] as $chapter) {
                            echo "<dd><a class='chapter' href='javascript:void(0);' data-nid='{$chapter['nid']}' data-ncid='{$chapter['ncid']}'>{$chapter['source']}</a></dd>";
						}
					}else{
                        echo "<dd><a href='javascript:void(0);'>无章节内容</a></dd>";
                    }
                ?>
        </dl>
    </div>
    <div class="comment" id="comment">
        <dl>
            <dt>《{{$novel['title']}}》热门评论</dt>
            <dd>
                <b>魔改歼星战舰</b>：
                <p>两个人在一起，比较有趣，即便是不做什么，心中还是觉得舒服</p>
                <a href="https://www.alxsu.com/book/86988/">精灵：什么叫稳健型训练家啊</a>：206火山赛场，开赛！ 发表于
                2022-07-31 23:20:09
            </dd>
            <dd>
                <b>离人横川</b>：
                <p>只不过今天她比较有趣，两人在一起的时候一直笑个不停，房俊捏着她的俏脸她都没有停止</p>
                <a href="https://www.wpxs.cc/book/96843/">剑众生</a>：第761章 登台 发表于 2024-02-29 00:00:00
            </dd>
        </dl>
        <div class="comment_more">展开全部&gt;&gt;</div>
    </div>
    <div class="footer wap_none">
        <div class="link">
            热门推荐：
            <a href="/book/94357/">美人法医的小娇妻力大无穷</a>、
            <a href="/book/93456/">真千金只想当奥运冠军[花滑]</a>、
            <a href="/book/92555/">hp狮院最强生活玩家</a>、
            <a href="/book/91654/">骑着巨龙的全系魔法师</a>、
            <a href="/book/90753/">我好像真的天赋异禀！</a>、
            <a href="/book/98900/">召唤师：我能萌化一切</a>、
            <a href="/book/97999/">超级特工系统</a>、
            <a href="/book/97098/">大明：我能翻阅华夏图书馆</a>、
            <a href="/book/96197/">温时简傅克韫</a>、
            <a href="/book/95296/">空降热搜！裴爷家的娇娇是妖妃</a>
        </div>
    </div>
    <script>
        lists({{$novel['nid']}});
    </script>
    <script>
        $('.chapter').click(function () {
            let nid = $(this).data('nid');
            let ncid = $(this).data('ncid');
            window.location.href = '/novel/'+nid+'/'+ncid;
        })
    </script>
@endsection