//屏幕适应 
(function (win, doc) {
    if (!win.addEventListener) return;
    var html = document.documentElement;
    function setFont() {
        var html = document.documentElement;
        var k = 750;
        html.style.fontSize = html.clientWidth / k * 100 + "px";
    }
    setFont();
    setTimeout(function () {
        setFont();
    }, 300);
    doc.addEventListener('DOMContentLoaded', setFont, false);
    win.addEventListener('resize', setFont, false);
    win.addEventListener('load', setFont, false);
})(window, document);
//滑动穿透
var touchMoveStop = (function() {
	var scrollTop;
	return {
		open: function() {
			scrollTop = document.scrollingElement.scrollTop;
			document.body.classList.add('modal-open');
			document.body.style.top = -scrollTop + 'px';
		},
		close: function() {
			document.body.classList.remove('modal-open');
			document.scrollingElement.scrollTop = scrollTop;
		}
	};
})();

