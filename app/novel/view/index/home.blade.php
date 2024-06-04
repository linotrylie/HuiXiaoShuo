@extends('layouts.layout')
@section('content')
    <div class="wrap">
        <div class="hot">
            @foreach($top as $item)
                <div class="item">
                    <div class="image">
                        <a href="{{"novel/{$item['nid']}"}}"><img src="{{$item['pic']}}" alt="{{$item['title']}}"></a>
                    </div>
                    <dl>
                        <dt>
                            <span>{{$item['author']}}</span>
                            <a href="{{"novel/{$item['nid']}"}}">{{$item['title']}}</a>
                        </dt>
                        <dd>
                            {{$item['content']}}
                        </dd>
                    </dl>
                </div>
            @endforeach
        </div>
        <div class="top">
            <h2>强力推荐</h2>
            <ul class="lis">
                @foreach($recommend as $ritem)
                    <li>
                        <span class="s1">[{{mb_substr($ritem['category']['title'],0,2)}}]</span>
                        <span class="s2">
                            <a href="{{'novel/'.$ritem['nid']}}">{{$ritem['title']}}</a>
                        </span>
                        <span class="s5">{{$ritem['author']}}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="clear"></div>
    <div class="wrap">
        <div class="type">
            @foreach($category_list_a as $cTitle => $cItem)
                <div class="block">
                    <h2>{{$cTitle}}</h2>
                        <?php $cItemFirst = array_shift($cItem); ?>
                    <div class="block_top">
                        <div class="image"><a href="{{'novel/'.$cItemFirst['nid']}}"><img src="{{$cItemFirst['pic']}}"
                                                                                          alt="{{$cItemFirst['title']}}"></a>
                        </div>
                        <dl>
                            <dt><a href="{{'novel/'.$cItemFirst['nid']}}">{{$cItemFirst['title']}}</a></dt>
                            <dd>{{$cItemFirst['content']}}</dd>
                        </dl>
                    </div>
                    <ul class="lis">
                        @foreach($cItem as $ccitem)
                            <li>
                                <span class="s1">[{{mb_substr($ccitem['category']['title'],0,2)}}]</span>
                                <span class="s2">
                                    <a href="{{'novel/'.$ccitem['nid']}}">{{$ccitem['title']}}</a>
                                </span>
                                <span class="s3">{{$ccitem['author']}}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
        <div class="type">
            @foreach($category_list_b as $cTitle => $cItem)
                <div class="block">
                    <h2>{{$cTitle}}</h2>
                        <?php $cItemFirst = array_shift($cItem); ?>
                    <div class="block_top">
                        <div class="image">
                            <a href="{{'novel/'.$cItemFirst['nid']}}">
                                <img src="{{$cItemFirst['pic']}}" alt="{{$cItemFirst['title']}}">
                            </a>
                        </div>
                        <dl>
                            <dt><a href="{{'novel/'.$cItemFirst['nid']}}">{{$cItemFirst['title']}}</a></dt>
                            <dd>{{$cItemFirst['content']}}</dd>
                        </dl>
                    </div>
                    <ul class="lis">
                        @foreach($cItem as $ccitem)
                            <li>
                                <span class="s1">[{{mb_substr($ccitem['category']['title'],0,2)}}]</span>
                                <span class="s2">
                                    <a href="{{'novel/'.$ccitem['nid']}}">{{$ccitem['title']}}</a>
                                </span>
                                <span class="s3">{{$ccitem['author']}}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="up">
            <div class="r bd">
                <h2>最新入库小说</h2>
                <ul>
                    @foreach($updated_list as $upItem)
                        <li>
                            <span class="s1">[{{mb_substr($upItem['category']['title'],0,2)}}]</span>
                            <span class="s2">
                                <a href="{{'novel/'.$upItem['nid']}}">{{$upItem['title']}}</a>
                            </span>
                            @if(isset($upItem['lastChapter']) && is_null($upItem['lastChapter']))
                                <span class="s3">
                                <a href="{{'novel/'.$upItem['nid'].'/'.$upItem['lastChapter']['ncid']}}">{{$upItem['lastChapter']['source']}}</a>
                            </span>
                            @endif
                            <span class="s5">{{$upItem['author']}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="l bd">
                <h2> 最近更新小说列表</h2>
                <ul>
                    @foreach($inner_list as $inItem)
                        <li>
                            <span class="s1">[{{mb_substr($inItem['category']['title'],0,2)}}]</span>
                            <span class="s2">
                                <a href="{{'novel/'.$inItem['nid']}}">{{$inItem['title']}}</a>
                            </span>
                            <span class="s5">{{$inItem['author']}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
