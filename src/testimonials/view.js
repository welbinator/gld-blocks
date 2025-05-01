document.addEventListener('DOMContentLoaded', function () {
	const slides = document.querySelectorAll('.testimonial-slide');
	const dots = document.querySelectorAll('.testimonial-dot');
	let current = 0;

	if (!slides.length) return;

	function showSlide(index) {
        slides.forEach((slide, i) => {
            if (i === index) {
                slide.classList.add('active');
            } else {
                slide.classList.remove('active');
            }
            dots[i].classList.toggle('bg-red-600', i === index);
            dots[i].classList.toggle('bg-gray-600', i !== index);
        });
    }
    

	function startRotation() {
		setInterval(() => {
			current = (current + 1) % slides.length;
			showSlide(current);
		}, 7000);
	}

	dots.forEach((dot, i) => {
		dot.addEventListener('click', () => {
			current = i;
			showSlide(current);
		});
	});

	showSlide(current);
	startRotation();
});
