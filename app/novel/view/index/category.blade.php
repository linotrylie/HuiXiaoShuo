@extends('layouts.layout')
@section('content')
    <div class="wrap class">
        <div class="hot">
            @foreach($list['data'] as $item)
            <div class="item">
                <div class="image">
                    <a href="{{'novel/'.$item['nid']}}">
                        <img src="{{$item['pic']}}" alt="{{$item['title']}}" width="120" height="150" border="0"/>
                    </a>
                </div>
                <dl>
                    <dt>
                        <span>{{$item['author']}}</span>
                        <a href="{{'/novel/'.$item['nid']}}">{{$item['title']}}</a>
                    </dt>
                    <dd>
                        {!! $item['content'] !!}
                    </dd>
                </dl>
            </div>
            @endforeach
        </div>
        <div class="loadmore">加载中……</div>
    </div>
    <script type="text/javascript">
        var page = 1;var start = true;
        function loadmore(id){
            page++;
            $.xget("/novel/category/"+id+"?page="+page,function (code,data,message) {
                var strHtml = "";
                if(data.length > 0) {
                    $.each(data.list.data,function(index,val){
                        strHtml += '<div class="item"><div class="image"><a href="novel/'+val.nid+'"><img src="'+val.pic+'" alt="'+val.title+'" width="120" height="150" border="0" /></a></div><dl><dt><span>'+val.author+'</span><a href="novel/'+val.nid+'" target="_blank">'+val.title+'</a></dt><dd>'+val.content+'......</dd></dl></div>';
                    })
                }
                if(strHtml==""){
                    $(".loadmore").html('没有了!');
                    return false;
                }
                $(".hot").append(strHtml);
                start=true;
            })
        }
        $(document).ready(function(){
            $(window).bind('scroll',function(){
                if(start==true && $(window).scrollTop()+$(window).height()+3>=$(document).height()){
                    start=false;loadmore({{$cid}});
                }
            })
        })
    </script>
@endsection
