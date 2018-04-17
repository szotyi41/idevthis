$(document).ready(function() {

	hljs.configure({tabReplace: '  '});
  hljs.initHighlighting();

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