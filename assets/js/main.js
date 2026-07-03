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
})();

