@extends('layouts.layout')
@section('content')
    <div class="wrap">
        <div class="bookcase">
            <h2>永不丢失的书架,与电脑同步 <a rel="nofollow" href="javascript:logout();" class="bookbox_btn"><font
                            color=red>退出登录</font></a></h2>
            <div class="read_book">
                <?php $sort = 1; ?>
                @foreach($data as $item)
                    <div class="bookbox">
                        <div class="box">
                            <span class="num">{{$sort++}}</span>
                            <div class="bookinfo">
                                <h4 class="bookname">
                                    <a href="novel/{{$item['nid']}}">{{$item['title']}}</a>
                                </h4>
                                <div class="author">作者：{{$item['author']}}</div>
                                <div class="update">
                                    @if(!empty($item['lastchapter']))
                                        <span>最新章节：</span><a
                                                href="novel/{{$item['nid']}}/{{$item['lastchapter']['ncid']}}">{{$item['lastchapter']['source']}}</a>
                                    @else
                                        <span>最新章节：</span><a href="javasript:void(0);">无最新内容</a>
                                    @endif
                                </div>
                                <div class="update">
                                    <span>更新时间：</span>{{$item['updated_at']}}</a>
                                </div>
                                <div class="update">
                                    @if(!empty($item['readchapter']))
                                        <span>已读到：</span><a
                                                href="novel/{{$item['nid']}}/{{$item['readchapter']['ncid']}}">{{$item['readchapter']['source']}}</a>
                                    @else
                                        <span>已读到：</span><a href="javasript:void(0);">无阅读记录</a>
                                    @endif
                                </div>
                            </div>
                            <div class="delbutton">
                                <a href="javascript:" onclick="removeCase(this,{{$item['nid']}});">删除</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        var page = 1;
        var start = true;
        var k = 4;

        function loadmore() {
            $.xget('/novel/user/bookcase?page=' + (page++), function (code, data, message) {
                if (code == 0) {
                    var strHtml = "";
                    $.each(data, function (i, val) {
                        k = ++k;
                        strHtml += '<div class="bookbox">' +
                            '<div class="box"><span class="num">' + k + '' +
                            '</span><div class="bookinfo"><h4 class="bookname"><a href="novel/' + val.nid + '">' + val.title +
                            '</a></h4><div class="author">作者：' + val.author + '</div>';
                        if (val.lastchapter.length > 0) {
                            strHtml += '<div class="update"><span>最新章节：</span><a href="novel/' + val.nid + '/' + val.lastchapter.ncid + '">' + val.lastchapter.source + '</a></div>';
                        } else {
                            strHtml += '<span>最新章节：</span><a href="javasript:void(0);">无最新内容</a>';
                        }
                        strHtml += '<div class="update"><span>更新时间：</span>' + val.updated_at + '</a></div>';
                        if (val.readchapter.length > 0) {
                            strHtml += '<div class="update"><span>已读到：</span><a href="' + val.url_readchapter + '">' + val.readchapter.source + '</a></div></div>';
                        }
                        strHtml += '<div class="delbutton"><a href="javascript:;" onclick="removeCase(this,\'' + val.nid + '\');">删除</a></div></div></div></div>';
                    })
                    if (strHtml == "") {
                        $(".tips").html('你的书架上没有书。');
                        return false;
                    }
                    $(".read_book").append(strHtml);
                    start = true;
                } else {
                    layer.msg(message);
                }
            });
        }

        function removeCase(nid) {
            $.xpost('/novel/user/del-bookcase',{'nid':nid},function(code,data,message){
                if(code == 0) {
                    location.reload();
                }else{
                    layer.msg(message)
                }
            });
        }

        $(document).ready(function () {
            $(window).bind('scroll', function () {
                if (start == true && $(window).scrollTop() + $(window).height() + 3 >= $(document).height()) {
                    start = false;
                    loadmore();
                }
            })
        })
    </script>
@endsection