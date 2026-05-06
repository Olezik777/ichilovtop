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

	/**
	 * Sticky fallback for the diseases sidebar.
	 *
	 * Uses CSS `position: sticky` as the primary mechanism and only takes over
	 * with manual `position: fixed` if the browser/layout silently broke sticky
	 * (e.g. an ancestor with overflow: hidden / overflow-x clipping).
	 */
	function initStickySidebar() {
		var sidebar = document.querySelector('.sidebar-box--diseases-nav');
		if (!sidebar) {
			return;
		}
		var parent = sidebar.parentElement;
		if (!parent) {
			return;
		}

		var DESKTOP_MIN = 1021;
		var TOP_OFFSET = 96;
		var BOTTOM_PAD = 16;

		var placeholder = document.createElement('div');
		placeholder.setAttribute('aria-hidden', 'true');
		placeholder.className = 'sidebar-box--diseases-nav__placeholder';
		placeholder.style.display = 'none';
		placeholder.style.flex = '0 0 auto';
		sidebar.parentNode.insertBefore(placeholder, sidebar);

		var nativeStickyWorks = null;

		function detectNativeSticky() {
			if (window.innerWidth < DESKTOP_MIN) {
				return false;
			}
			var probe = document.createElement('div');
			probe.style.cssText = 'position:sticky;position:-webkit-sticky;top:0;';
			sidebar.parentNode.insertBefore(probe, sidebar);
			var ok = window.getComputedStyle(probe).position.indexOf('sticky') !== -1;
			probe.parentNode.removeChild(probe);
			if (!ok) {
				return false;
			}
			// Also walk ancestors and ensure none clips sticky.
			var node = sidebar.parentElement;
			while (node && node !== document.body && node !== document.documentElement) {
				var cs = window.getComputedStyle(node);
				if (
					cs.overflow === 'hidden' || cs.overflow === 'auto' || cs.overflow === 'scroll' ||
					cs.overflowY === 'hidden' || cs.overflowY === 'auto' || cs.overflowY === 'scroll'
				) {
					return false;
				}
				node = node.parentElement;
			}
			return true;
		}

		function release() {
			sidebar.classList.remove('is-stuck');
			sidebar.style.left = '';
			sidebar.style.width = '';
			sidebar.style.top = '';
			placeholder.style.display = 'none';
			placeholder.style.height = '';
			placeholder.style.width = '';
		}

		function update() {
			if (window.innerWidth < DESKTOP_MIN) {
				release();
				return;
			}
			if (nativeStickyWorks === null) {
				nativeStickyWorks = detectNativeSticky();
			}
			if (nativeStickyWorks) {
				return;
			}

			var parentRect = parent.getBoundingClientRect();
			var sidebarHeight = sidebar.offsetHeight;
			var topOffset = getHeaderOffset() > 16 ? Math.max(getHeaderOffset(), TOP_OFFSET) : TOP_OFFSET;
			var stickThreshold = topOffset;
			var releaseBottom = parentRect.bottom - sidebarHeight - BOTTOM_PAD;

			if (parentRect.top <= stickThreshold && releaseBottom > stickThreshold) {
				if (!sidebar.classList.contains('is-stuck')) {
					var rect = sidebar.getBoundingClientRect();
					placeholder.style.display = 'block';
					placeholder.style.height = sidebarHeight + 'px';
					placeholder.style.width = rect.width + 'px';
				}
				var phRect = placeholder.getBoundingClientRect();
				sidebar.classList.add('is-stuck');
				sidebar.style.top = topOffset + 'px';
				sidebar.style.left = phRect.left + 'px';
				sidebar.style.width = phRect.width + 'px';
			} else if (releaseBottom <= stickThreshold && parentRect.bottom > 0) {
				// Pin to the bottom of the parent so it scrolls out smoothly.
				if (!sidebar.classList.contains('is-stuck')) {
					var r2 = sidebar.getBoundingClientRect();
					placeholder.style.display = 'block';
					placeholder.style.height = sidebarHeight + 'px';
					placeholder.style.width = r2.width + 'px';
				}
				var ph2 = placeholder.getBoundingClientRect();
				sidebar.classList.add('is-stuck');
				sidebar.style.left = ph2.left + 'px';
				sidebar.style.width = ph2.width + 'px';
				sidebar.style.top = (releaseBottom) + 'px';
			} else {
				release();
			}
		}

		var ticking = false;
		function onScroll() {
			if (!ticking) {
				window.requestAnimationFrame(function () {
					update();
					ticking = false;
				});
				ticking = true;
			}
		}

		function onResize() {
			nativeStickyWorks = null;
			release();
			update();
		}

		window.addEventListener('scroll', onScroll, { passive: true });
		window.addEventListener('resize', onResize, { passive: true });
		update();
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

		function scrollToSection(target, behavior) {
			var offset = getHeaderOffset();
			// Keep section title slightly under activation threshold.
			var extraOffset = 26;
			var top = target.getBoundingClientRect().top + window.scrollY - offset + extraOffset;
			window.scrollTo({
				top: Math.max(0, Math.round(top)),
				behavior: behavior
			});
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
			scrollToSection(target, 'smooth');
			if (history.replaceState) {
				history.replaceState(null, '', hash);
			} else {
				window.location.hash = hash;
			}
			setActive(id);
			window.setTimeout(applyFromScrollPosition, 380);
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
					scrollToSection(el, 'auto');
					setActive(hid);
				});
			} else {
				applyFromScrollPosition();
			}
		} else {
			applyFromScrollPosition();
		}
	}

	function bootstrap() {
		init();
		initStickySidebar();
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', bootstrap);
	} else {
		bootstrap();
	}
})();
