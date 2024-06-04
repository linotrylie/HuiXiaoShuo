var ng = navigator;
if (/Android|Windows Phone|webOS|iPhone|iPod|BlackBerry/i.test(ng.userAgent)) {
    var htmltest = document.getElementsByTagName('head')[0].innerHTML;
    if (htmltest.match(RegExp(/format=html5/))) {
        var wapurl = htmltest.match(/format=html5; url=(.+?)"/)[1];
        location.href = wapurl;
    }
}//donetop

function setCookie(c_name, value, expiredays) {
    var exdate = new Date()
    exdate.setDate(exdate.getDate() + 365)
    document.cookie = c_name + "=" + escape(value) + ";expires=" + exdate.toGMTString() + ";path=/";
}

function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) c_end = document.cookie.length;
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}

function delCookie(name) {
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = getCookie(name);
    if (cval != null)
        document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
}

var bookUserName = getCookie("username");

function tj() {
    var head = "<div class=\'wrap\'><div class=\'topcase\'><a href=\'javascript:setHome();\'>将本站设为首页</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\'javascript:topCase();\'>收藏本站</a></div>";
    if (bookUserName != '' && bookUserName != undefined) {
        head += "<div class=\'toplogin\'><a rel=\'nofollow\' href=\'/user/notify.html\'><font color=red>联系我们</font></a>&nbsp;&nbsp;|&nbsp;&nbsp;欢迎您：<a class=\'loginbtn\' href=\'/user/my\'>" + bookUserName + "</a>&nbsp;&nbsp;<a href=\'/novel/user/bookcase\'>我的书架</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\'javascript:logout();\'>退出登录</a></div>";
    } else {
        head += "<div class=\'toplogin\'><a rel=\'nofollow\' href=\'/user/notify.html\'><font color=red>联系我们</font></a>&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a class=\'loginbtn\' href=\'/novel/auth/login\'>登陆</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\'/novel/auth/register\'>用户注册</a></div>";
    }
    $(".header_top").html(head + '</div>');
    $(".search").html('<form action="/s" onsubmit="if(q.value==\'\'){alert(\'提示：请输入小说名称或作者名字！\');return false;}"><input type="search" class="text" name="q" placeholder="快速搜索、找书、找作者" value="" /><input type="submit" class="btn" value=""></form>');

}

function lists(id) {
    $(".listmain .more").click(function () {
        $(".listmain .dd_hide").show();
        $(".listmain .more").hide();
    });
    $(".noshow").hide();
    $(".allshow").click(function () {
        $(".noshow").show();
        $(".allshow").hide();
    });
    $(".comment_hide").hide();
    $(".comment_more").click(function () {
        $(".comment_hide").show();
        $(".comment_more").hide();
    });
    var lis = window.localStorage.getItem("bookList");
    if(lis == null) return false;
    var looklist = window.localStorage.getItem("bookList").split('#');
    var lookid = looklist.indexOf(id);
    if (lookid < 0) {
        return false;
    }
    var lastbook = window.localStorage.getItem(looklist[lookid]).split('#');
    $(".readlink .rl").attr('href', '/novel/' + id + '/' + lastbook[1] + '.html');
    $(".readlink .rl").attr('title', '上次阅读到：' + lastbook[3]);
    $(".readlink .rl").text('继续阅读');
    var hm = Math.ceil(Math.random() * 10);
    if (hm == 1) {
        new Image().src = '/' + id + '/hm.gif';
    }
}

function read3() {
    $(".noshow").hide();
}


function get_bookpage(id, num) {
    if (num == "n") {
        page++;
    } else if (num == "p") {
        if (page <= 1) {
            alert('已经是第一页了!');
            return false;
        }
        page--;
    } else {
        page = num;
    }
    $.getJSON("/json_book?id=" + id + "&page=" + page, function (data) {
        var strHtml = "";
        $.each(data, function (index, val) {
            strHtml += '<li><a href="./' + (page * 20 - 20 + index + 1) + '.html">' + val + '</a></li>';
        })
        if (strHtml == "") {
            alert('没有了!');
            return false;
        }
        $(".allup").html(strHtml);
        $("select option[value=" + page + "]").attr("selected", true);
    });
}

function get_booklist(id) {
    $.getJSON("/json_book?id=" + id + "&page=0", function (data) {
        var strHtml = "";
        $.each(data, function (index, val) {
            strHtml += '<li><a href="./' + (index + 1) + '.html">' + val + '</a></li>';
        })
        if (strHtml == "") {
            alert('没有了!');
            return false;
        }
        $(".allup").html(strHtml);
        $(".listpage").hide();
    });
}

function topCase() {
    var sURL = "http://" + location.hostname;
    var sTitle = "笔趣阁";
    try {
        window.external.addFavorite(sURL, document.title);
    } catch (e) {
        try {
            window.sidebar.addPanel(sTitle, sURL, "");
        } catch (e) {
            alert("加入收藏失败，请使用Ctrl+D进行添加");
        }
    }
}

function setHome() {
    var url = "http://" + location.hostname;
    if (document.all) {
        document.body.style.behavior = 'url(#default#homepage)';
        document.body.setHomePage(url);
    } else {
        alert("操作被浏览器拒绝,请手动在浏览器里设置该页面为首页！");
    }
}

function logout() {
    $.xpost('/novel/auth/logout',{uid:getCookie('user_id')},function(code,data,message){
       if(code == 0) {
           setCookie("user_id", '', 1);
           setCookie("username", '', 1);
           setCookie("access_token", '', 1);
           location.reload();
       }else{
           layer.alert(message, -1);
           jsend.button('reset');
       }
    });

}

function doParse(url) {
    var params = {};
    if (!url) return params;
    var paramPart = url.substring(url.indexOf("?") + 1);
    var parts = paramPart.split("&");
    for (var i = 0; i < parts.length; i++) {
        var index = parts[i].indexOf("=");
        if (index == -1) continue;
        params[parts[i].substring(0, index)] = parts[i].substring(index + 1);
    }
    return params;
}

function user_href() {
    if (getCookie('username')) {
        var params = doParse(location.href);
        if (!params.jumpurl || params.jumpurl == "undefined") {
            location.href = "/novel/user/bookcase";
        } else {
            location.href = decodeURIComponent(params.jumpurl);
        }
    }
}

function addBookCase(bookid) {
    $.xget('/novel/add/'+bookid,function (code,data,message){
        if(code == 0) {
            layer.msg("加入书架成功！")
        }else{
            layer.msg(message)
        }
    });
}

function addBookMark(bookId, chapterId, articleName, chapterName) {
    $.post("/user/action.html",
        {action: "addbook", bookid: bookId, chapterid: chapterId, articlename: articleName, chaptername: chapterName},
        function (data) {
            if (data == -1) {
                alert("您还没有登录，请登录后再加入书签！");
                location.href = "/login.html?jumpurl=" + location.href + "#footer";
            } else if (data == 0) {
                alert("书架已满，加入书架出错！");
            } else if (data == 1) {
                alert("加入书签成功！");
            } else {
                alert("加入书签出错！");
            }

        }
    );
}

function chapter_error(bookId, chapterId, articleName, chapterName, Time) {
//if (confirm('你确定这章节有错吗？')) {
    $.post("/user/action.html",
        {
            action: "chapter_error",
            bookid: bookId,
            chapterid: chapterId,
            articlename: articleName,
            chaptername: chapterName,
            time: Time
        },
        function (data) {
            if (data == 1) {
                alert("举报错误章节成功，请耐心等待维护人员处理~");
            } else if (data > 10) {
                window.location.href = window.location.href + '?' + data;
            } else {
                alert("请不要频繁提交~");
            }
        }
    );
//}
}

function book_error(bookId, articleName, Time) {
    if (confirm('你确定本书更新出错吗？')) {
        $.post("/user/action.html",
            {action: "book_error", bookid: bookId, articlename: articleName, time: Time},
            function (data) {
                if (data == 1) {
                    alert("举报错误成功，请耐心等待维护人员处理~");
                } else if (data > 10) {
                    window.location.href = window.location.href + '?' + data;
                } else {
                    alert("请不要频繁提交~");
                }
            }
        );
    }
}

$(function () {
    document.body.insertAdjacentHTML("afterBegin", '<div hidden>' +
        '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" style="width:0;height:0;position:absolute;overflow:hidden;">' +
        '<defs><symbol id="lnr-home" viewBox="0 0 1024 1024"><title>home</title><path class="path1" d="M1017.382 622.826l-452.050-499.634c-14.051-15.533-32.992-24.086-53.333-24.086-0.002 0 0 0 0 0-20.339 0-39.282 8.555-53.334 24.086l-452.050 499.634c-9.485 10.485-8.675 26.674 1.808 36.158 4.899 4.432 11.043 6.616 17.168 6.616 6.982 0 13.938-2.838 18.992-8.426l109.016-120.491v410.517c0 42.347 34.453 76.8 76.8 76.8h563.2c42.347 0 76.8-34.453 76.8-76.8v-410.517l109.018 120.493c9.485 10.483 25.674 11.296 36.158 1.808 10.483-9.485 11.293-25.675 1.806-36.158zM614.4 972.8h-204.8v-230.4c0-14.115 11.485-25.6 25.6-25.6h153.6c14.115 0 25.6 11.485 25.6 25.6v230.4zM819.2 947.2c0 14.115-11.485 25.6-25.6 25.6h-128v-230.4c0-42.349-34.451-76.8-76.8-76.8h-153.6c-42.347 0-76.8 34.451-76.8 76.8v230.4h-128c-14.115 0-25.6-11.485-25.6-25.6v-467.106l291.832-322.552c4.222-4.667 9.68-7.237 15.368-7.237s11.146 2.57 15.366 7.235l291.834 322.552v467.107z"></path></symbol>' +
        '<symbol id="lnr-arrow-up-circle" viewBox="0 0 1024 1024"><title>arrow-up-circle</title><path class="path1" d="M142.464 193.662c-91.869 91.869-142.464 214.016-142.464 343.938s50.595 252.067 142.464 343.936 214.014 142.464 343.936 142.464 252.069-50.595 343.938-142.464 142.462-214.014 142.462-343.936-50.594-252.069-142.462-343.938-214.016-142.462-343.938-142.462-252.067 50.594-343.936 142.462zM921.6 537.6c0 239.97-195.23 435.2-435.2 435.2s-435.2-195.23-435.2-435.2c0-239.97 195.23-435.2 435.2-435.2s435.2 195.23 435.2 435.2z"></path><path class="path2" d="M468.301 237.901l-204.8 204.8c-9.998 9.995-9.998 26.206 0 36.203 9.997 9.998 26.206 9.998 36.203 0l161.096-161.101v526.997c0 14.138 11.461 25.6 25.6 25.6s25.6-11.462 25.6-25.6v-526.997l161.101 161.096c9.995 9.998 26.206 9.998 36.203 0 4.997-4.997 7.496-11.547 7.496-18.099s-2.499-13.102-7.501-18.099l-204.8-204.8c-9.997-10-26.202-10-36.198 0z"></path></symbol>' +
        '<symbol id="lnr-chevron-left-circle" viewBox="0 0 1024 1024"><title>chevron-left-circle</title><path class="path1" d="M142.462 193.664c91.869-91.869 214.016-142.464 343.938-142.464s252.067 50.595 343.936 142.464 142.464 214.014 142.464 343.936-50.595 252.069-142.464 343.938-214.014 142.462-343.936 142.462-252.069-50.594-343.938-142.462-142.462-214.016-142.462-343.938 50.594-252.067 142.462-343.936zM486.4 972.8c239.97 0 435.2-195.23 435.2-435.2s-195.23-435.2-435.2-435.2c-239.97 0-435.2 195.23-435.2 435.2s195.23 435.2 435.2 435.2z"></path><path class="path2" d="M563.2 819.2c6.552 0 13.102-2.499 18.102-7.499 9.997-9.997 9.997-26.206 0-36.203l-237.898-237.898 237.898-237.898c9.997-9.998 9.997-26.206 0-36.205-9.998-9.997-26.206-9.997-36.205 0l-256 256c-9.998 9.997-9.998 26.206 0 36.203l256 256c5 5 11.55 7.499 18.102 7.499z"></path></symbol>' +
        '<symbol id="lnr-user" viewBox="0 0 1024 1024"><title>user</title><path class="path1" d="M486.4 563.2c-155.275 0-281.6-126.325-281.6-281.6s126.325-281.6 281.6-281.6 281.6 126.325 281.6 281.6-126.325 281.6-281.6 281.6zM486.4 51.2c-127.043 0-230.4 103.357-230.4 230.4s103.357 230.4 230.4 230.4c127.042 0 230.4-103.357 230.4-230.4s-103.358-230.4-230.4-230.4z"></path><path class="path2" d="M896 1024h-819.2c-42.347 0-76.8-34.451-76.8-76.8 0-3.485 0.712-86.285 62.72-168.96 36.094-48.126 85.514-86.36 146.883-113.634 74.957-33.314 168.085-50.206 276.797-50.206 108.71 0 201.838 16.893 276.797 50.206 61.37 27.275 110.789 65.507 146.883 113.634 62.008 82.675 62.72 165.475 62.72 168.96 0 42.349-34.451 76.8-76.8 76.8zM486.4 665.6c-178.52 0-310.267 48.789-381 141.093-53.011 69.174-54.195 139.904-54.2 140.61 0 14.013 11.485 25.498 25.6 25.498h819.2c14.115 0 25.6-11.485 25.6-25.6-0.006-0.603-1.189-71.333-54.198-140.507-70.734-92.304-202.483-141.093-381.002-141.093z"></path></symbol>' +
        '</defs></svg></div>')
});