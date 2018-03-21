/*
ScratchWikiSkin script
*/

//get an element from a query selector, with functions to write, add, show, hide, addclass, delclass
function mod(el) {
	if (!el) return el;
	el.addclass = function(c) {this.classList.add(c);};
	el.delclass = function(c) {this.classList.remove(c);};
}

window.addEventListener('load', function(){
	for (let btn of document.querySelectorAll('#navigation a.dropdown-toggle')) {
		let dropdown = btn.nextElementSibling;
		mod(btn);
		mod(dropdown);
		btn.onclick = function(){
			if (!dropdown.classList.contains('open')) {
				btn.addclass('open');
				dropdown.addclass('open');
			} else {
				btn.delclass('open');
				dropdown.delclass('open');
			}
		};
		btn.parentElement.onmouseout = function(e) {
			if (!e) e = window.event;
			if (!e.toElement) e.toElement = e.relatedTarget;
			if (!e.toElement) return;
			if (!btn.parentElement.contains(e.toElement)) {
				btn.delclass('open');
				dropdown.delclass('open');
			}
		};
	};
	if (document.querySelector(':target') !== null) {
		window.scrollBy(0, -50);
	};
	document.querySelector('#searchInput').onfocus = function () {
		for (let link of document.querySelectorAll('#navigation .link')) {
			if (!link.classList.contains('right')) {
				link.style.display = 'none';
			}
		}
	};
	document.querySelector('#searchInput').onblur = function () {
		for (let link of document.querySelectorAll('#navigation .link')) {
			if (!link.classList.contains('right')) {
				link.style.display = '';
			}
		}
	};
});
window.addEventListener('hashchange', function(){
	window.scrollBy(0, -50);
});
