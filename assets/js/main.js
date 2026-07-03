(function () {
	const toggle = document.querySelector('.nav-toggle');
	const nav = document.querySelector('.primary-nav');
	if (toggle && nav) {
		toggle.addEventListener('click', function () {
			const open = toggle.getAttribute('aria-expanded') === 'true';
			toggle.setAttribute('aria-expanded', String(!open));
			nav.classList.toggle('is-open', !open);
		});
	}

	const header = document.querySelector('.site-header');
	const setHeaderState = function () {
		if (!header) {
			return;
		}
		header.classList.toggle('has-scrolled', window.scrollY > 24);
	};
	setHeaderState();
	window.addEventListener('scroll', setHeaderState, { passive: true });

	document.querySelectorAll('[data-slider-button]').forEach(function (button) {
		button.addEventListener('click', function () {
			const target = document.querySelector(button.getAttribute('data-slider-button'));
			if (!target) {
				return;
			}
			const direction = button.getAttribute('data-direction') === 'prev' ? -1 : 1;
			target.scrollBy({ left: direction * Math.round(target.clientWidth * 0.85), behavior: 'smooth' });
		});
	});
})();
