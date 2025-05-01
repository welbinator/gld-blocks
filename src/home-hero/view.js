document.addEventListener('DOMContentLoaded', function() {
	const heroBackground = document.querySelector('.home-hero-background');
	const heroContent = document.querySelector('.home-hero-content');

	if (!heroBackground || !heroContent) return;

	window.addEventListener('scroll', function() {
		const scrollY = window.scrollY;
		heroBackground.style.transform = `translateY(${scrollY * 0.15}px)`;
		heroContent.style.transform = `translateY(${scrollY * 0.05}px)`;
	});
});
