<div class="header_wap pc_none">
    <span class="title">{{$header['icon-title']}}</span>
    <a class="user" href="/novel/user/bookcase">
        <svg class="lnr lnr-user">
            <use xlink:href="#lnr-user"></use>
        </svg>
    </a>
</div>
<div class="header_top"></div>
<div class="header">
    <div class="wrap">
        <div class="logo">
            <a href="/" title="{{$header['title']}}">{{$header['icon-title']}}</a>
        </div>
        <div class="search"></div>
        <div class="share"><a href="/novel/user/read_history">阅读记录</a></div>
    </div>
    <div class="nav">
        <ul>
            @foreach($nav as $item)
            <li @if(sprintf($item['template_index'],$item['cid']) == $current_url) class="this" @endif><a href="{{ sprintf($item['template_index'],$item['cid']).'?page=1' }}">{{$item['title']}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="clear"></div>
</div>
