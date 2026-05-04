(function () {
	'use strict';

	function getHeaderOffset() {
		var header = document.querySelector('.site-header');
		if (!header) {
			return 16;
		}
		var position = window.getComputedStyle(header).position;
		if (position !== 'sticky' && position !== 'fixed') {
			return 16;
		}
		return Math.ceil(header.getBoundingClientRect().height) + 12;
	}

	function init() {
		var root = document.querySelector('.diseases-index');
		if (!root) {
			return;
		}

		var nav = root.querySelector('[data-diseases-nav]');
		if (!nav) {
			return;
		}

		var links = nav.querySelectorAll('.diseases-index__nav-link');
		var sections = root.querySelectorAll('.diseases-index__department[id]');
		if (!sections.length || !links.length) {
			return;
		}

		function setActive(id) {
			links.forEach(function (link) {
				var href = link.getAttribute('href');
				var isActive = href === '#' + id;
				link.classList.toggle('is-active', isActive);
				if (isActive) {
					link.setAttribute('aria-current', 'location');
				} else {
					link.removeAttribute('aria-current');
				}
			});
		}

		function getActiveSectionId() {
			var offset = getHeaderOffset();
			var activeId = '';
			for (var i = sections.length - 1; i >= 0; i--) {
				var sec = sections[i];
				var top = sec.getBoundingClientRect().top;
				if (top <= offset) {
					activeId = sec.id;
					break;
				}
			}
			if (!activeId && sections[0]) {
				activeId = sections[0].id;
			}
			return activeId;
		}

		var ticking = false;
		function onScroll() {
			if (!ticking) {
				window.requestAnimationFrame(function () {
					var id = getActiveSectionId();
					if (id) {
						setActive(id);
					}
					ticking = false;
				});
				ticking = true;
			}
		}

		nav.addEventListener('click', function (e) {
			var anchor = e.target.closest('a[href^="#"]');
			if (!anchor || !nav.contains(anchor)) {
				return;
			}
			var hash = anchor.getAttribute('href');
			if (!hash || hash.length < 2) {
				return;
			}
			var id = hash.slice(1);
			var target = document.getElementById(id);
			if (!target) {
				return;
			}
			e.preventDefault();
			target.scrollIntoView({ behavior: 'smooth', block: 'start' });
			if (history.replaceState) {
				history.replaceState(null, '', hash);
			} else {
				window.location.hash = hash;
			}
			setActive(id);
		});

		window.addEventListener('scroll', onScroll, { passive: true });
		window.addEventListener('resize', onScroll, { passive: true });

		function applyFromScrollPosition() {
			var sid = getActiveSectionId();
			if (sid) {
				setActive(sid);
			}
		}

		if (window.location.hash) {
			var hid = window.location.hash.slice(1);
			var el = document.getElementById(hid);
			if (el && root.contains(el)) {
				window.requestAnimationFrame(function () {
					el.scrollIntoView({ behavior: 'auto', block: 'start' });
					setActive(hid);
				});
			} else {
				applyFromScrollPosition();
			}
		} else {
			applyFromScrollPosition();
		}
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
