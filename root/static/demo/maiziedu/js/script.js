$(function(){
    $('body').on('click','.cou a.link', function(e) {
        var href = $(this).attr('href');
        $('#courses').html($(this).text()+'<span class="caret"></span>');
        window.history.pushState({},0,'http://'+window.location.host+href);
        $.get(href,function (res) {
            $('#cou_main').html(res);
            $('#list_main').html('');
            $('#video_main').html('');
        });
        e.preventDefault();
    });
    $('body').on('click','#cou_main a.link', function(e) {
        var href = $(this).attr('href');
        window.history.pushState({},0,'http://'+window.location.host+href);
        $.get(href,function (res) {
            $('#list_main').html(res);
            $('#video_main').html('');
            $("#list_main .list-group").css({
                "max-height": $(window).height() - 100 + "px",
                overflow: "auto"
            });
        });
        e.preventDefault();
    });
    $('body').on('click','#list_main a.link', function(e) {
        var href = $(this).attr('href');
        window.history.pushState({},0,'http://'+window.location.host+href);
        $.get(href,function (res) {
            $('#video_main').html(res);
            play('video');
        });
        e.preventDefault();
    });
    $("#list_main .list-group").css({
        "max-height": $(window).height() - 100 + "px",
        overflow: "auto"
    });
})
function play(box) {
    $("#video").css({
        "height": $(window).height() - 170 + "px",
    });
    var ivaInstance = new Iva(box, {
        appkey: 'NkwSqiB9x',
        live: false,
        video: $('#'+box).data('url'),
        title: $('#'+box).data('title'),
        cover: '视频封面url',
        videoStartPrefixSeconds: 0,
        videoEndPrefixSeconds: 0,
        skinSelect: 0,
        autoplay: true,
        rightHand: true,
        autoFormat: false,
        bubble: false,
        jumpStep: 10,
        tagTrack: false,
        tagShow: false,
        tagDuration: 5,
        tagFontSize: 16
    });

}