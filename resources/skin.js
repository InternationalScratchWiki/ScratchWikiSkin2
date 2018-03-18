/*
ScratchWikiSkin script
*/

//get an element from a query selector, with functions to write, add, show, hide, addclass, delclass
function q(s) {
	var h = document.querySelector(s);
	//if no element exists that matches the selector, return null
	if (!h) return h;

	h.write = function(o) {this.innerHTML = o;};
	h.add = function(o) {this.innerHTML += o;};
	h.show = function() {this.style.display = 'block';};
	h.hide = function() {this.style.display = 'none';};
	h.addclass = function(c) {this.classList.add(c);};
	h.delclass = function(c) {this.classList.remove(c);};

	return h;
}

window.addEventListener('load', function(){
	//when pencil icon clicked, display dropdown
	var pagefctbtn = q('#navigation ul > li.content-actions > a.user-info');
	var pagefctdropdown = q('#navigation ul > li.content-actions > ul.dropdown');
	pagefctbtn.onclick = function(){
		if (pagefctdropdown.style.display != 'block') {
			pagefctbtn.addclass('open');
			pagefctdropdown.show();
		} else {
			pagefctbtn.delclass('open');
			pagefctdropdown.hide();
		}
	};
	//when mouse moved away, hide dropdown
	q('#navigation ul > li.content-actions').onmouseout = function(e) {
		if (!e) e = window.event;
		if (!e.toElement) e.toElement = e.relatedTarget;
		if (!e.toElement) return;
		if (!e.toElement.matches('#navigation ul > li.content-actions, #navigation ul > li.content-actions *')) {
			pagefctbtn.delclass('open');
			pagefctdropdown.hide();
		}
	};
	//if user is logged in and toggle is showing, add dropdown functions
	if (userfcttoggle = q('#navigation ul > li.account-nav > a.user-info')) {
		//if username toggle clicked, display dropdown
		var userfctdropdown = q('#navigation ul > li.account-nav > ul.dropdown');
		userfcttoggle.onclick = function() {
			if (userfctdropdown.style.display != 'block') {
				userfcttoggle.addclass('open');
				userfctdropdown.show();
			} else {
				userfcttoggle.delclass('open');
				userfctdropdown.hide();
			}
		};
		q('#navigation ul > li.account-nav').onmouseout = function(e) {
			if (!e) e = window.event;
			if (!e.toElement) e.toElement = e.relatedTarget;
			if (!e.toElement) return;
			if (!e.toElement.matches('#navigation ul > li.account-nav, #navigation ul > li.account-nav *')) {
				userfcttoggle.delclass('open');
				userfctdropdown.hide();
			}
		};
	};
	if (q(':target') !== null) {
		window.scrollBy(0, -50);
	};
});
window.addEventListener('hashchange', function(){
	window.scrollBy(0, -50);
});
