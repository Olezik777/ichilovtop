(function () {
	'use strict';

	var MOBILE_QUERY = '(max-width: 860px)';
	var FOCUSABLE_SELECTOR = 'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])';

	function initHeaderNavigation() {
		var header = document.querySelector('[data-site-header]');
		if (!header) {
			return;
		}

		var toggle = header.querySelector('[data-mobile-menu-toggle]');
		var drawer = header.querySelector('[data-mobile-menu]');
		var closeButton = header.querySelector('[data-mobile-menu-close]');
		var overlay = header.querySelector('[data-mobile-menu-overlay]');

		if (!toggle || !drawer || !closeButton || !overlay) {
			return;
		}

		var mediaQuery = window.matchMedia(MOBILE_QUERY);
		var lastFocusedElement = null;

		function isMobile() {
			return mediaQuery.matches;
		}

		function setDrawerAvailability() {
			var shouldHide = isMobile() && !header.classList.contains('is-mobile-menu-open');

			if (shouldHide) {
				drawer.setAttribute('aria-hidden', 'true');
				if ('inert' in drawer) {
					drawer.inert = true;
				}
			} else {
				drawer.removeAttribute('aria-hidden');
				if ('inert' in drawer) {
					drawer.inert = false;
				}
			}
		}

		function focusFirstMenuItem() {
			var focusable = drawer.querySelectorAll(FOCUSABLE_SELECTOR);
			if (focusable.length) {
				focusable[0].focus();
			}
		}

		function trapFocus(event) {
			var focusable = Array.prototype.slice.call(drawer.querySelectorAll(FOCUSABLE_SELECTOR));
			if (!focusable.length) {
				event.preventDefault();
				return;
			}

			var first = focusable[0];
			var last = focusable[focusable.length - 1];

			if (!drawer.contains(document.activeElement)) {
				event.preventDefault();
				first.focus();
				return;
			}

			if (event.shiftKey && document.activeElement === first) {
				event.preventDefault();
				last.focus();
			} else if (!event.shiftKey && document.activeElement === last) {
				event.preventDefault();
				first.focus();
			}
		}

		function openMenu() {
			if (!isMobile()) {
				return;
			}

			lastFocusedElement = document.activeElement;
			header.classList.add('is-mobile-menu-open');
			document.body.classList.add('mobile-menu-open');
			toggle.setAttribute('aria-expanded', 'true');
			toggle.setAttribute('aria-label', toggle.getAttribute('data-close-label') || 'Закрыть меню');
			setDrawerAvailability();
			window.setTimeout(focusFirstMenuItem, 60);
		}

		function closeMenu(restoreFocus) {
			header.classList.remove('is-mobile-menu-open');
			document.body.classList.remove('mobile-menu-open');
			toggle.setAttribute('aria-expanded', 'false');
			toggle.setAttribute('aria-label', toggle.getAttribute('data-open-label') || 'Открыть меню');
			setDrawerAvailability();

			if (restoreFocus && lastFocusedElement && typeof lastFocusedElement.focus === 'function') {
				lastFocusedElement.focus();
			}
		}

		function toggleMenu() {
			if (header.classList.contains('is-mobile-menu-open')) {
				closeMenu(true);
			} else {
				openMenu();
			}
		}

		function handleMediaChange() {
			if (!isMobile()) {
				closeMenu(false);
			}
			setDrawerAvailability();
		}

		toggle.setAttribute('data-open-label', toggle.getAttribute('aria-label'));
		toggle.setAttribute('data-close-label', closeButton.getAttribute('aria-label'));

		toggle.addEventListener('click', toggleMenu);
		closeButton.addEventListener('click', function () {
			closeMenu(true);
		});
		overlay.addEventListener('click', function () {
			closeMenu(true);
		});

		drawer.addEventListener('click', function (event) {
			var link = event.target.closest('a');
			if (link && drawer.contains(link)) {
				closeMenu(false);
			}
		});

		document.addEventListener('keydown', function (event) {
			if (!header.classList.contains('is-mobile-menu-open')) {
				return;
			}

			if (event.key === 'Escape') {
				closeMenu(true);
			} else if (event.key === 'Tab') {
				trapFocus(event);
			}
		});

		if (typeof mediaQuery.addEventListener === 'function') {
			mediaQuery.addEventListener('change', handleMediaChange);
		} else if (typeof mediaQuery.addListener === 'function') {
			mediaQuery.addListener(handleMediaChange);
		}

		setDrawerAvailability();
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initHeaderNavigation);
	} else {
		initHeaderNavigation();
	}
})();
