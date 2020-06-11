jQuery(document).ready(function(e) {
    function t() {
        e("#dbmovies_response_history").show(), e("#welcm").after('<li class="jump">' + dBa.completed + "</li>")
    }

    function a(t, a, s) {
        e("#c" + t).hide(), e("#" + t).removeClass("dbimport"), e("#" + t).addClass("fadeInDown"), e("#" + t).addClass("preimport"), e("#import_all").hide(), e.ajax({
            url: dBa.url,
            type: "post",
            data: {
                id: t,
                nonce: a,
                type: s,
                action: "dt_dbmovies_app_post"
            },
            error: function(e) {
                console.log(e)
            },
            success: function(a) {
                e("#welcm").after(a), e("#" + t).removeClass("preimport"), e("#" + t).addClass("dbimported"), e("#" + t).addClass("jump")
            }
        })
    }

    function s() {
        var s = dBa.url,
            i = e("#term").val(),
            o = e("#stype").val(),
            d = e("#saction").val(),
            r = e("#spage").val(),
            n = e("#nonce").val();
        e("#dbmovies_response").addClass("dbclick"), e("#dbmsearch").prop("disabled", !0), e("#dbmsearch").val(dBa.loading), e("#import_all").hide(), e.ajax({
            url: s,
            type: "POST",
            data: {
                type: o,
                term: i,
                page: r,
                action: d,
                nonce: n
            },
            error: function(e) {
                console.log(e)
            },
            success: function(s) {
                t(), e("#dbmovies_response").removeClass("dbclick"), e("#dbmsearch").prop("disabled", !1), e("#dbmsearch").val(dBa.search), e("#dbmovies_response").html(s), e(".pagex").click(function() {
                    var t = e(this).data("page");
                    e("#spage").val(t), e("#dbmsearch").trigger("click")
                }), e(".cimport").click(function() {
                    var t = e(this).data("id"),
                        s = e(this).data("type");
                    return a(t, e(this).data("nonce"), s), !1
                })
            }
        })
    }
    var i = function() {
        var e = 0;
        return function(t, a) {
            clearTimeout(e), e = setTimeout(t, a)
        }
    }();
    e(".nav-tab").click(function() {
        var t = e(this).attr("data-type");
        e(".nav-tab").removeClass("nav-tab-active"), e(this).addClass("nav-tab-active"), e(".cctype").val(t), e(".genres").removeClass("current_genres"), e("#gn_" + t).addClass("current_genres"), e("#import_all").hide()
    }), e("#show_dbmovies_settings").click(function() {
        e(".settbox").toggle(), e(".dbmovies_sett_modal").toggle()
    }), e("#hidde_dbmovies_settings").click(function() {
        e(".settbox").hide(), e(".dbmovies_sett_modal").hide()
    }), e(".dbmovies_sett_modal").click(function() {
        e(".settbox").hide(), e(".dbmovies_sett_modal").hide()
    }), e(document).on("submit", "#dbmovies-save", function() {
        var t = e(this),
            a = dBa.url;
        return e(".perico").addClass("saving"), e("#save_sdbmvs").prop("disabled", !0), e("#save_sdbmvs").val(dBa.saving), e.ajax({
            url: a,
            type: "post",
            data: t.serialize(),
            error: function(e) {
                console.log(e)
            },
            success: function(t) {
                e(".perico").removeClass("saving"), e("#save_sdbmvs").prop("disabled", !1), e("#save_sdbmvs").val(dBa.save)
            }
        }), !1
    }), e(document).on("submit", "#dbmovies-filter", function() {
        var s = e(this),
            i = dBa.url;
        return e("#dbmovies_response").addClass("dbclick"), e("#dbmfilter").prop("disabled", !0), e("#dbmfilter").val(dBa.filtering), e.ajax({
            url: i,
            type: "post",
            data: s.serialize(),
            error: function(e) {
                console.log(e)
            },
            success: function(s) {
                t(), e("#dbmovies_response").removeClass("dbclick"), e("#dbmfilter").prop("disabled", !1), e("#dbmfilter").val(dBa.filter), e("#dbmovies_response").html(s), e("#import_all").show(), e(".pagex").click(function() {
                    var t = e(this).data("page");
                    e("#page").val(t), e("#dbmfilter").trigger("click"), e("#import_all").hide()
                }), e(".cimport").click(function() {
                    var t = e(this).data("id"),
                        s = e(this).data("type");
                    return a(t, e(this).data("nonce"), s), !1
                })
            }
        }), !1
    }), e(document).on("submit", "#dbmovies-search", function() {
        return s(), !1
    }), e("#dbmovies-search").keyup(function() {
        return i(function() {
            s()
        }, 500), !1
    }), e(".resetfil").click(function() {
        e("#page").val("1"), e("#spage").val("1")
    }), e("#activate_dbmovies").click(function() {
        return e("#activate_dbmovies").hide(), e("#dbmv").val(dBa.loading), e("#dbmv").prop("disabled", !0), e.ajax({
            url: dBa.url,
            type: "post",
            data: {
                action: "register_dbmv"
            },
            error: function(e) {
                console.log(e)
            },
            success: function(t) {
                e("#dbmv").val(t), e("#dbmv").removeClass("alert"), e("#dbmv").addClass("keyva"), setTimeout(function() {
                    window.location.reload(1)
                }, 2e3)
            }
        }), !1
    }), e.getJSON(dBa.apidbmv + "app/" + dBa.dbmv, function(t) {
        e.each(t, function(a, s) {
            "response" == a && "0" == s && e.each(t, function(t, a) {
                "message" == t && e(".toolbar").html("<p>" + a + "</p>") && e("#pnote").html("<strong>Warning:</strong> " + a) && e("#dbmv").addClass("alert") && e("#show_dbmovies_settings").trigger("click")
            })
        })
    }), e(document).keyup(function(t) {
        27 == t.keyCode && e("#hidde_dbmovies_settings").trigger("click"), 18 == t.keyCode && e("#show_dbmovies_settings").trigger("click"), 39 == t.keyCode && e("#nexty").trigger("click"), 37 == t.keyCode && e("#prevty").trigger("click")
    }), e("#import_all").click(function() {
        return e("#import_all").hide(), e(".cimport").trigger("click"), !1
    })
});