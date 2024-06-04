@extends('layouts.layout')
@section('content')
    <div class="book reader">
        <div class="path wap_none">
            <a href="/">{{$header['icon-title']}}</a> &gt; <a href="/novel/{{$chapter['nid']}}">{{$novel['title']}}</a> &gt; {{$chapter['source']}}
        </div>
        <div class="Readbtn">
            字体：<a id="fontbig" class="sizebg" onclick="nr_setbg('big')">大</a>
            <a id="fontmiddle" class="button sizebgon" onclick="nr_setbg('middle')">中</a>
            <a id="fontsmall" class="sizebg" onclick="nr_setbg('small')">小</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a id="huyandiv" class="button huyanon" onclick="nr_setbg('huyan')">护眼</a>
            <a id="lightdiv" class="button lightoff" onclick="nr_setbg('light')">关灯</a>
        </div>
        <div class="content">
            <h1 class="wap_none">{{$chapter['source']}}</h1>
            <div class="link wap_none">
                新书推荐：
                @foreach($new_recommend as $newItem)
                    <a href="/novel/{{$newItem['nid']}}">{{$newItem['title']}}</a>&nbsp;
                @endforeach
            </div>
            <div class="Readpage pc_none">
                @if(!empty($preChapter))
                    <a href="/novel/{{$preChapter['nid']}}/{{$preChapter['ncid']}}" id="pb_prev"
                       class="Readpage_up">上一章</a>
                @endif
                <a href="/novel/{{$chapter['nid']}}" id="pb_mulu" class="Readpage_up">目录</a>
                @if(!empty($nextChapter))
                    <a href="/novel/{{$nextChapter['nid']}}/{{$nextChapter['ncid']}}" id="pb_next"
                       class="Readpage_down js_page_down">下一章</a>
                @endif
            </div>
            <div id="chaptercontent" class="Readarea ReadAjax_content">
                {!! htmlspecialchars_decode($chapter['chapter']) !!}
                <br/>　　
                请收藏本站：{{$header['pc_url']}}。笔趣阁手机版：{{$header['mobile_url']}}
                <br/>
                <br/>
                <p class="readinline"><a class="ll" rel="nofollow" title="章节错误,点此举报[免注册]"
                                         href="javascript:chapter_error({{$chapter['nid']}},{{$chapter['ncid']}},'{{$novel['title']}}');">『点此报错』</a><a
                            class="rr" rel="nofollow" title="加入书签，方便阅读"
                            href="javascript:addBookMark({{$chapter['nid']}},{{$chapter['ncid']}},'{{$novel['title']}}','{{$chapter['source']}}');">『加入书签』</a>
                </p></div>
            <div class="Readpage pagedown">
                @if(!empty($preChapter))
                    <a href="/novel/{{$preChapter['nid']}}/{{$preChapter['ncid']}}" id="pb_prev"
                       class="Readpage_up">上一章</a>
                @endif
                <a href="/novel/{{$chapter['nid']}}" id="pb_mulu" class="Readpage_up">目录</a>
                @if(!empty($nextChapter))
                    <a href="/novel/{{$nextChapter['nid']}}/{{$nextChapter['ncid']}}" id="pb_next"
                       class="Readpage_down js_page_down">下一章</a>
                @endif
            </div>
            <script>read3();</script>
        </div>
    </div>
    <script src="/assets/js/read.js"></script>
@endsection
