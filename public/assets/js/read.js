var checkbg = "#A7A7A7";

function nr_setbg(intype) {
    var huyandiv = document.getElementById("huyandiv");
    var light = document.getElementById("lightdiv");
    if (intype == "huyan") {
        if (huyandiv.className == "button huyanon") {
            document.cookie = "light=huyan;path=/";
            set("light", "huyan");
        } else {
            document.cookie = "light=no;path=/";
            set("light", "no");
        }
    }
    if (intype == "light") {
        if (light.innerHTML == "关灯") {
            document.cookie = "light=yes;path=/";
            set("light", "yes");
        } else {
            document.cookie = "light=no;path=/";
            set("light", "no");
        }
    }
    if (intype == "big") {
        document.cookie = "font=big;path=/";
        set("font", "big");
    }
    if (intype == "middle") {
        document.cookie = "font=middle;path=/";
        set("font", "middle");
    }
    if (intype == "small") {
        document.cookie = "font=small;path=/";
        set("font", "small");
    }
}

function getset() {
    var strCookie = document.cookie;
    var arrCookie = strCookie.split("; ");
    var light;
    var font;

    for (var i = 0; i < arrCookie.length; i++) {
        var arr = arrCookie[i].split("=");
        if ("light" == arr[0]) {
            light = arr[1];
            break;
        }
    }

    //light
    if (light == "yes") {
        set("light", "yes");
    } else if (light == "no") {
        set("light", "no");
    } else if (light == "huyan") {
        set("light", "huyan");
    }
}


function getset1() {
    var strCookie = document.cookie;
    var arrCookie = strCookie.split("; ");
    var light;
    var font;

    for (var j = 0; j < arrCookie.length; j++) {
        var arr = arrCookie[j].split("=");
        if ("font" == arr[0]) {
            font = arr[1];
            break;
        }
    }

    //font
    if (font == "big") {
        set("font", "big");
    } else if (font == "middle") {
        set("font", "middle");
    } else if (font == "small") {
        set("font", "small");
    } else {
        set("font", "middle");
    }
}

//鍐呭椤靛簲鐢ㄨ缃�
function set(intype, p) {
    var nr_body = document.getElementById("read");
    var huyandiv = document.getElementById("huyandiv");
    var lightdiv = document.getElementById("lightdiv");
    var fontfont = document.getElementById("fontfont");
    var fontbig = document.getElementById("fontbig");
    var fontmiddle = document.getElementById("fontmiddle");
    var fontsmall = document.getElementById("fontsmall");
    var nr1 = document.getElementById("chaptercontent");
    if (intype == "light") {
        if (p == "yes") {
            lightdiv.innerHTML = "开灯";
            lightdiv.className = "button lighton";
            nr_body.style.backgroundColor = "#111";
            huyandiv.className = "button huyanon";
            nr1.style.color = "#999";
        } else if (p == "no") {
            lightdiv.innerHTML = "关灯";
            lightdiv.className = "button lightoff";
            nr_body.style.backgroundColor = "#fff";
            if (/Android|Windows Phone|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)) {
                nr_body.style.backgroundColor = "#fff";
            } else {
                nr_body.style.backgroundColor = "#E9FAFF";
            }
            nr1.style.color = "#111";
            huyandiv.className = "button huyanon";
        } else if (p == "huyan") {
            // lightdiv.innerHTML = "开灯";
            lightdiv.className = "button lightoff";
            huyandiv.className = "button huyanoff";
            nr_body.style.backgroundColor = "#CCE8CF";
            nr1.style.color = "#000";
        }
    }
    //瀛椾綋
    if (intype == "font") {
        fontbig.className = "sizebg";
        fontmiddle.className = "sizebg";
        fontsmall.className = "sizebg";
        if (p == "big") {
            fontbig.className = "button sizebgon";
            nr1.style.fontSize = "25px";
        }
        if (p == "middle") {
            fontmiddle.className = "button sizebgon";
            nr1.style.fontSize = "20px";
        }
        if (p == "small") {
            fontsmall.className = "button sizebgon";
            nr1.style.fontSize = "14px";
        }
    }
}


function LastRead() {
    this.bookList = "bookList"
}

LastRead.prototype = {
    set: function (bid, tid, title, texttitle, author, sortname) {
        if (!(bid && tid && title && texttitle && author && sortname)) return;
        var v = bid + '#' + tid + '#' + title + '#' + texttitle + '#' + author + '#' + sortname;
        this.setItem(bid, v);
        this.setBook(bid)
    },
    get: function (k) {
        return this.getItem(k) ? this.getItem(k).split("#") : "";
    },
    remove: function (k) {
        this.removeItem(k);
        this.removeBook(k)
    },
    setBook: function (v) {
        var reg = new RegExp("(^|#)" + v);
        var books = this.getItem(this.bookList);
        if (books == "") {
            books = v
        } else {
            if (books.search(reg) == -1) {
                books += "#" + v
            } else {
                books.replace(reg, "#" + v)
            }
        }
        this.setItem(this.bookList, books)
    },
    getBook: function () {
        var v = this.getItem(this.bookList) ? this.getItem(this.bookList).split("#") : Array();
        var books = Array();
        if (v.length) {
            for (var i = 0; i < v.length; i++) {
                var tem = this.getItem(v[i]).split('#');
                if (tem.length > 3) books.push(tem);
            }
        }
        return books
    },
    removeBook: function (v) {
        var reg = new RegExp("(^|#)" + v);
        var books = this.getItem(this.bookList);
        if (!books) {
            books = ""
        } else {
            if (books.search(reg) != -1) {
                books = books.replace(reg, "")
            }
        }
        this.setItem(this.bookList, books)
    },
    setItem: function (k, v) {
        if (!!window.localStorage) {
            localStorage.setItem(k, v);
        } else {
            var expireDate = new Date();
            var EXPIR_MONTH = 30 * 24 * 3600 * 1000;
            expireDate.setTime(expireDate.getTime() + 12 * EXPIR_MONTH)
            document.cookie = k + "=" + encodeURIComponent(v) + ";expires=" + expireDate.toGMTString() + "; path=/";
        }
    },
    getItem: function (k) {
        var value = ""
        var result = ""
        if (!!window.localStorage) {
            result = window.localStorage.getItem(k);
            value = result || "";
        } else {
            var reg = new RegExp("(^| )" + k + "=([^;]*)(;|\x24)");
            var result = reg.exec(document.cookie);
            if (result) {
                value = decodeURIComponent(result[2]) || ""
            }
        }
        return value
    },
    removeItem: function (k) {
        if (!!window.localStorage) {
            window.localStorage.removeItem(k);
        } else {
            var expireDate = new Date();
            expireDate.setTime(expireDate.getTime() - 1000)
            document.cookie = k + "= " + ";expires=" + expireDate.toGMTString()
        }
    },
    removeAll: function () {
        if (!!window.localStorage) {
            window.localStorage.clear();
        } else {
            var v = this.getItem(this.bookList) ? this.getItem(this.bookList).split("#") : Array();
            var books = Array();
            if (v.length) {
                for (i in v) {
                    var tem = this.removeItem(v[k])
                }
            }
            this.removeItem(this.bookList)
        }
    }
}
window.lastread = new LastRead();