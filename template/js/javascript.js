$(document).ready(function() {

    hljs.configure({tabReplace: '  '});
    hljs.initHighlighting();

/*
    $(document).scroll(function() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            $(".scrolltop").css({display: "block"});
        } else {
            $(".scrolltop").css({display: "none"});
        }
    });*/

    $(".scrolltop").click(function(event) {
        $('html, body').animate({scrollTop: '0px'}, 500);
    });

	$("code").click(function(event) {
		copyToClipboard($(this).text());
	});

	$("span").tooltip({
		tooltipClass: "tooltip",
		position: {
		  my: "center bottom",
		  at: "center top-5",
		  collision: "none"
		}
    });

    $("code.short").tooltip({
    tooltipClass: "tooltip",
    content: "Másolás",
    position: {
        my: "center bottom",
        at: "center top-5",
        collision: "none"
    }
    });

	function copyToClipboard(text) {
        console.log("Copy: " + text);
        var temp = $("<input>");
        $("body").append(temp);
        temp.val(text).select();
        document.execCommand("copy");
        temp.remove();
	}
});