$(document).ready(function () {
    $("#fixed-menubar").hide();
    $("#menubar").clone().appendTo("#fixed-menubar");

    $('#fixed-menubar #menubar').addClass('menu-fixed');
    $('#fixed-menubar #menubar').width($("#menubar").width());

    var speed = 1000;

    $(".toggle").each(function (index) {
        $($(this).attr('title')).slideUp(0);
        $(this).on('click', function (e) {
            $($(this).attr('title')).slideToggle(speed);
        });
    });

    function scroll_to(t, offset) {
        var target = t.hash;
        var $target = $(target);
        var target_offset = $target.offset().top;
        $('html, body').animate({
            'scrollTop': target_offset + offset
        }, 1000, 'swing', function () {
            window.location.hash = target;
        });
    }

    function open_scroll(id, t, e) {
        e.preventDefault();
        $(id).slideDown(500);
        var menubarHeight = $('#menubar').outerHeight();
        scroll_to(t, -menubarHeight - 20);
    }

    $(".open").each(function (index) {
        $(this).on('click', function (e) {
            open_scroll($(this).attr('href'), this, e);
        });
    });

    $(window).scroll(function () {
        var menubarTop = $('#title #menubar').offset().top;
        if ($(window).scrollTop() > menubarTop) {
            $("#fixed-menubar").show();
        } else {
            $("#fixed-menubar").hide();
        }
    });

    var menubarHeight = $('#menubar').outerHeight();
    $(".pdf-preview").height($(window).height() - menubarHeight - 100);


    $(".gif").hover(
            function () {
                var src = $(this).attr('src');
                var gif_src = src.replace("-static.png", ".gif");
                var static_src = src.replace(".gif", "-static.png");
                if (src != gif_src) {
                    $(this).attr('src', gif_src);
                } else {
                    $(this).attr('src', static_src);
                }
            },
            function () {
//                                var src = $(this).attr('src');
//                                var new_src = src.replace(".gif", "-static.png");
//                                if (src != new_src) {
//                                    $(this).attr('src', new_src);
//                                }
            }
    );

    var $w = $(window).scroll(function () {
        $(".gif").each(function () {
            var nav_height = $('#fixed-menubar #menubar').outerHeight();
            var offset = $(this).offset().top;
            var middle = offset - ($(window).height() - nav_height) * .5;
            var element_height = $(this).outerHeight();
            var targetOffsetBottom = middle - element_height * .6;
            var targetOffsetTop = middle + element_height * .6;

            if ($w.scrollTop() > targetOffsetBottom && $w.scrollTop() < targetOffsetTop) {
                var src = $(this).attr('src');
                var new_src = src.replace("-static.png", ".gif");
                if (src !== new_src) {
                    $(this).attr('src', new_src);
                }
            } else {
                var src = $(this).attr('src');
                var new_src = src.replace(".gif", "-static.png");
                if (src !== new_src) {
                    $(this).attr('src', new_src);
                }
            }
        });
    });
});