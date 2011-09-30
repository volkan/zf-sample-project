var sampleproject = {}
sampleproject.pages = {};
sampleproject.utils = {};
sampleproject.fn = {};
sampleproject.templates = {};
sampleproject.env = {};

sampleproject.env.imgUrl = '';
sampleproject.env.corporate = 'Firma Adı';
sampleproject.env.successful = 'İşlem başarılı';
sampleproject.env.unsuccessful = 'İşlem başarısız';
sampleproject.env.welcomeIndex = 'İndex sayfasına hoşgeldiniz';
sampleproject.env.denemeIndex = 'Burda artık sessiona değer atanmış onu gösteriyoruz<br/>Aynı zamanda veritabanından gelen sonuçları';

(function (a) {
    if (!window.console) {
        window.console = {}
    }
    if (!window.console.log) {
        window.console.log = function () {}
    }
}(sampleproject));
sampleproject.utils.loadingIndicator = {};
(function (c, a) {
    a.status = false;
    a.init = function (d) {
        d = d || c("body");
        var e = d.find(".ajaxLoader");
        c(document).bind("loadingStarted", function () {
            a.status = true;
            e.show()
        });
        c(document).bind("loadingFinished", function () {
            a.status = false;
            e.hide()
        })
    }
}(jQuery, sampleproject.utils.loadingIndicator));
sampleproject.messages = {};
(function (d, c) {
    var a = function (g) {
            var h = g.split(".");
            var f = sampleproject.messages;
            for (var e = 0; e < h.length; e++) {
                f = f[h[e]]
            }
            return f
        };
    sampleproject._ = a
}(jQuery, sampleproject.messages));
sampleproject.messages.xhr = {

};


(function (e, h) {
    var d = "/";
    var a = "/";
    var c = "/";
    var f = {
        welcome: "/",
        getLookup: "/index/get-lookup"
    };
    h.url = function (i) {
        if (f[i]) {
            return d + f[i]
        } else {
            return d + i
        }
    };
    var g = function (j) {
            var i = j.length - 1;
            if (j && j.charAt(i) === "/") {
                j = j.substring(0, i);
                j = j.slice(0, i)
            }
            return j
        };
    h.contentImageUrl = function (i) {
        return c + i
    };
    h.redirect = function (i) {
        window.location.href = h.url(i);
        return true
    };
    e(document).ready(function () {
        d = g(e("#baseUrl").val());
        a = e("#imageUrl").val();
        c = g(e("#contentImageUrl").val())
    })
}(jQuery, sampleproject));
(function (d, e) {
    var a = e._("xhr");
    var f = {
        start: function () {
            d(document).trigger("loadingStarted");
            d("body").css("cursor", "wait")
        },
        stop: function () {
            d(document).trigger("loadingFinished");
            d("body").css("cursor", "default")
        }
    };
    var c = function (m, h, k, l, i) {
            if (!m || !h) {
                return false
            }
            k = k || {};
            l = l ||
            function () {};
            i = i ||
            function () {};
            var j = function (p) {
                    f.stop();
                    var o, n;
                    if (!p) {
                        o = a.noData.subject;
                        n = a.noData.body
                    } else {
                        if (a[p.status]) {
                            o = a[p.status].subject;
                            n = a[p.status].body
                        } else {
                            o = a.defaultText.subject;
                            n = a.defaultText.body
                        }
                    }
                    e.popup.alert(a.title, o, n)
                };
            var g = function (p) {
                    var n = p.errors.errors;
                    var o = n.redirectUrl;
                    e.popup.alert(n.subject, n.body)
                };
            f.start();
            return d.ajax({
                url: h,
                type: m,
                dataType: "json",
                data: k,
                success: function (n) {
                    if (!n) {
                        return j(n)
                    }
                    if (n.success === true) {
                        l(n)
                    } else {
                        if (n.errors.type === "Exceptional") {
                            g(n)
                        } else {
                            i(n)
                        }
                    }
                    f.stop()
                },
                error: function (n) {
                    j(n)
                }
            })
        };
    e.GET = function (j, i, k, g) {
        var h = e.url(j);
        return c("GET", h, i, k, g)
    };
    e.POST = function (j, i, k, g) {
        var h = e.url(j);
        return c("POST", h, i, k, g)
    }
}(jQuery, sampleproject));
//kodlar burdan asagi yazilmali
sampleproject.pages.common = {};
(function ($, common, env) {

    common.init = function () {
        env.imgUrl = $('#contentImageUrl').val()
    }
    
}(jQuery, sampleproject.pages.common, sampleproject.env));

sampleproject.pages.index = {};
(function ($, index, env) {    
    var onload = function() {
        $.jGrowl(env.welcomeIndex)
    };
    
    var click = function() {
        $("#closed").click(function () {
            $('#fileInpt').html($('#fileInpt').html())
        });      
    };

    
    index.init = function () {       
        onload();
        click()
    }
    
}(jQuery, sampleproject.pages.index, sampleproject.env));

sampleproject.pages.denemeIndex = {};
(function ($, index, env) {    
    var onload = function() {
        $.jGrowl(env.denemeIndex)
    };
    
    index.init = function () {       
        onload()
    }
    
}(jQuery, sampleproject.pages.denemeIndex, sampleproject.env));

// her zaman en altta
(function ($, d) {
    var a = function () {
            var g = $("body").dataAttr("jsModules"),
                f = d.pages;
            if (g) {
                g = g.split(" ");
                for (var j = 0, k = g.length; j < k; j++) {
                    var h = g[j];
                    if (h && f[h] && f[h].init) {
                        f[h].init()
                    }
                }
            }
        };
    $(document).ready(function () {
        a()
    })
}(jQuery, sampleproject));
