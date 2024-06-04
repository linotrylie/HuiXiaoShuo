<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if(!empty($header['keywords'])) { ?>
    <meta name="keywords" content="<?php echo strip_tags($header['keywords']);?>" />
    <?php } ?>
    <meta name="description" content="<?php echo strip_tags($header['description']);?>" />
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta http-equiv="mobile-agent" content="format=html5; url=<?=$header['mobile_url'];?>"/>
    <meta http-equiv="mobile-agent" content="format=xhtml; url=<?=$header['mobile_url'];?>"/>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="format-detection" content="telephone=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" >
    <title><?php echo $header['title'];?></title>
    <link href="/assets/css/layui.css" rel="stylesheet">
{{--    <link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">--}}
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="icon" sizes="32x32" href="/favicon.ico">
    <link rel="Bookmark" href="/favicon.ico" />
    <link href="/assets/css/main.css" rel="stylesheet">
    <style data-id="immersive-translate-input-injected-css">
        .immersive-translate-input {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            z-index: 2147483647;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .immersive-translate-loading-spinner {
            vertical-align: middle !important;
            width: 10px !important;
            height: 10px !important;
            display: inline-block !important;
            margin: 0 4px !important;
            border: 2px rgba(221, 244, 255, 0.6) solid !important;
            border-top: 2px rgba(0, 0, 0, 0.375) solid !important;
            border-left: 2px rgba(0, 0, 0, 0.375) solid !important;
            border-radius: 50% !important;
            padding: 0 !important;
            -webkit-animation: immersive-translate-loading-animation 0.6s infinite linear !important;
            animation: immersive-translate-loading-animation 0.6s infinite linear !important;
        }

        @-webkit-keyframes immersive-translate-loading-animation {
            from {
                -webkit-transform: rotate(0deg);
            }

            to {
                -webkit-transform: rotate(359deg);
            }
        }

        @keyframes immersive-translate-loading-animation {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(359deg);
            }
        }


        .immersive-translate-input-loading {
            --loading-color: #f78fb6;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: block;
            margin: 12px auto;
            position: relative;
            color: white;
            left: -100px;
            box-sizing: border-box;
            animation: immersiveTranslateShadowRolling 1.5s linear infinite;
        }

        @keyframes immersiveTranslateShadowRolling {
            0% {
                box-shadow: 0px 0 rgba(255, 255, 255, 0), 0px 0 rgba(255, 255, 255, 0), 0px 0 rgba(255, 255, 255, 0), 0px 0 rgba(255, 255, 255, 0);
            }

            12% {
                box-shadow: 100px 0 var(--loading-color), 0px 0 rgba(255, 255, 255, 0), 0px 0 rgba(255, 255, 255, 0), 0px 0 rgba(255, 255, 255, 0);
            }

            25% {
                box-shadow: 110px 0 var(--loading-color), 100px 0 var(--loading-color), 0px 0 rgba(255, 255, 255, 0), 0px 0 rgba(255, 255, 255, 0);
            }

            36% {
                box-shadow: 120px 0 var(--loading-color), 110px 0 var(--loading-color), 100px 0 var(--loading-color), 0px 0 rgba(255, 255, 255, 0);
            }

            50% {
                box-shadow: 130px 0 var(--loading-color), 120px 0 var(--loading-color), 110px 0 var(--loading-color), 100px 0 var(--loading-color);
            }

            62% {
                box-shadow: 200px 0 rgba(255, 255, 255, 0), 130px 0 var(--loading-color), 120px 0 var(--loading-color), 110px 0 var(--loading-color);
            }

            75% {
                box-shadow: 200px 0 rgba(255, 255, 255, 0), 200px 0 rgba(255, 255, 255, 0), 130px 0 var(--loading-color), 120px 0 var(--loading-color);
            }

            87% {
                box-shadow: 200px 0 rgba(255, 255, 255, 0), 200px 0 rgba(255, 255, 255, 0), 200px 0 rgba(255, 255, 255, 0), 130px 0 var(--loading-color);
            }

            100% {
                box-shadow: 200px 0 rgba(255, 255, 255, 0), 200px 0 rgba(255, 255, 255, 0), 200px 0 rgba(255, 255, 255, 0), 200px 0 rgba(255, 255, 255, 0);
            }
        }


        .immersive-translate-search-recomend {
            border: 1px solid #dadce0;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 16px;
            position: relative;
            font-size: 16px;
        }

        .immersive-translate-search-enhancement-en-title {
            color: #4d5156;
        }

        /* dark */
        @media (prefers-color-scheme: dark) {
            .immersive-translate-search-recomend {
                border: 1px solid #3c4043;
            }

            .immersive-translate-close-action svg {
                fill: #bdc1c6;
            }

            .immersive-translate-search-enhancement-en-title {
                color: #bdc1c6;
            }
        }


        .immersive-translate-search-settings {
            position: absolute;
            top: 16px;
            right: 16px;
            cursor: pointer;
        }

        .immersive-translate-search-recomend::before {
            /* content: " "; */
            /* width: 20px; */
            /* height: 20px; */
            /* top: 16px; */
            /* position: absolute; */
            /* background: center / contain url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAAxlBMVEUAAADpTInqTIjpSofnSIfqS4nfS4XqS4nqTIjsTYnrTInqTIroS4jvQIDqTIn////+/v7rSYjpTIn8/v7uaZzrTIr9/f3wfansWJL88/b85e73qc39+/v3xNnylrvrVI/98fb62Obva5/8+fr76vH4y9zpSIj74e353Oj1ocTzm77xhK/veKbtYpjsXJTqU47oTInxjrXyh7L99fj40eH2ttH1udD3sc31ssz1rMnykLXucqPtbqD85e/1xdn2u9DzqcXrUY6FaJb8AAAADnRSTlMA34BgIM8Q37/fz7+/EGOHcVQAAAGhSURBVDjLhZPncuowEEZFTW7bXVU7xsYYTO/p7bb3f6lICIOYJOT4h7/VnFmvrBFjrF3/CR/SajBHswafctG0Qg3O8O0Xa8BZ6uw7eLjqr30SofCDVSkemMinfL1ecy20r5ygR5zz3ArcAqJExPTPKhDENEmS30Q9+yo4lEQkqVTiIEAHCT10xWERRdH0Bq0aCOPZNDV3s0xaYce1lHEoDHU8wEh3qRJypNcTAeKUIjgKMeGLDoRCLVLTVf+Ownj8Kk6H9HM6QXPgYjQSB0F00EJEu10ILQrs/QeP77BSSr0MzLOyuJJQbnUoOOIUI/A8EeJk9E4YUHUWiRyTVKGgQUB8/3e/NpdGlfI+FMQyWsCBWyz4A/ZyHXyiiz0Ne5aGZssoxRmcChw8/EFKQ5JwwkUo3FRT5yXS7q+Y/rHDZmFktzpGMvO+5QofA4FPpEmGw+EWRCFvnaof7Zhe8NuYSLR0xErKLThUSs8gnODh87ssy6438yzbLzxl012HS19vfCf3CNhnbWOL1eEsDda+gDPUvri8tSZzNFrwIZf1NmNvqC1I/t8j7nYAAAAASUVORK5CYII='); */
        }

        .immersive-translate-search-title {}

        .immersive-translate-search-title-wrapper {}

        .immersive-translate-search-time {
            font-size: 12px;
            margin: 4px 0 24px;
            color: #70757a;
        }

        .immersive-translate-expand-items {
            display: none;
        }

        .immersive-translate-search-more {
            margin-top: 16px;
            font-size: 14px;
        }

        .immersive-translate-modal {
            display: none;
            position: fixed;
            z-index: 2147483647;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            font-size: 15px;
        }

        .immersive-translate-modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 40px 24px 24px;
            border: 1px solid #888;
            border-radius: 10px;
            width: 80%;
            max-width: 270px;
            font-family: system-ui, -apple-system, "Segoe UI", "Roboto", "Ubuntu",
            "Cantarell", "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji",
            "Segoe UI Symbol", "Noto Color Emoji";
            position: relative
        }

        .immersive-translate-modal .immersive-translate-modal-content-in-input {
            max-width: 500px;
        }
        .immersive-translate-modal-content-in-input .immersive-translate-modal-body {
            text-align: left;
            max-height: unset;
        }

        .immersive-translate-modal-title {
            text-align: center;
            font-size: 16px;
            font-weight: 700;
            color: #333333;
        }

        .immersive-translate-modal-body {
            text-align: center;
            font-size: 14px;
            font-weight: 400;
            color: #333333;
            word-break: break-all;
            margin-top: 24px;
        }

        @media screen and (max-width: 768px) {
            .immersive-translate-modal-body {
                max-height: 250px;
                overflow-y: auto;
            }
        }

        .immersive-translate-close {
            color: #666666;
            position: absolute;
            right: 16px;
            top: 16px;
            font-size: 20px;
            font-weight: bold;
        }

        .immersive-translate-close:hover,
        .immersive-translate-close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .immersive-translate-modal-footer {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 24px;
        }

        .immersive-translate-btn {
            width: fit-content;
            color: #fff;
            background-color: #ea4c89;
            border: none;
            font-size: 16px;
            margin: 0 8px;
            padding: 9px 30px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .immersive-translate-btn:hover {
            background-color: #f082ac;
        }

        .immersive-translate-cancel-btn {
            /* gray color */
            background-color: rgb(89, 107, 120);
        }


        .immersive-translate-cancel-btn:hover {
            background-color: hsl(205, 20%, 32%);
        }

        .immersive-translate-action-btn {
            background-color: transparent;
            color: #EA4C89;
            border: 1px solid #EA4C89
        }

        .immersive-translate-btn svg {
            margin-right: 5px;
        }

        .immersive-translate-link {
            cursor: pointer;
            user-select: none;
            -webkit-user-drag: none;
            text-decoration: none;
            color: #007bff;
            -webkit-tap-highlight-color: rgba(0, 0, 0, .1);
        }

        .immersive-translate-primary-link {
            cursor: pointer;
            user-select: none;
            -webkit-user-drag: none;
            text-decoration: none;
            color: #ea4c89;
            -webkit-tap-highlight-color: rgba(0, 0, 0, .1);
        }

        .immersive-translate-modal input[type="radio"] {
            margin: 0 6px;
            cursor: pointer;
        }

        .immersive-translate-modal label {
            cursor: pointer;
        }

        .immersive-translate-close-action {
            position: absolute;
            top: 2px;
            right: 0px;
            cursor: pointer;
        }
    </style>
    <script src="/assets/js/layui.js"></script>
    <script src="/assets/js/xn.js"></script>
    <script src="/assets/js/compc.js?v=1.23"></script>
</head>
<body id="read"  class="read">
    <div id="app">
        @include('layouts.header')
        <main>
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
</body>
</html>
