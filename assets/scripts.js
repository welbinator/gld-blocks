function gldPropertyFiltersInit() {
	const wrapper = document.getElementById('gld-filter-properties-wrapper');
	if (!wrapper) {
		console.error('Missing #gld-filter-properties-wrapper');
		return;
	}

	console.log('gldPropertyFiltersInit loaded');

	const resultsContainer = wrapper.querySelector('.gld-property-results');

	let filters = {
		sale_type: [],
		property_type: [],
		property_area: [],
		min_price: null,
		max_price: null,
		min_size: null,
		max_size: null,
		page: 1,
	};

	function updateFiltersFromUI() {
		filters.sale_type = [];
		filters.property_type = [];
		filters.property_area = [];

		const checkedBoxes = wrapper.querySelectorAll('.filter-taxonomy:checked');
		checkedBoxes.forEach(cb => {
			const tax = cb.dataset.tax;
			const slug = cb.dataset.slug;
			if (filters[tax]) {
				filters[tax].push(slug);
			}
		});

		filters.min_price = wrapper.querySelector('#min-price')?.value || null;
		filters.max_price = wrapper.querySelector('#max-price')?.value || null;
		filters.min_size = wrapper.querySelector('#min-size')?.value || null;
		filters.max_size = wrapper.querySelector('#max-size')?.value || null;
	}

	function fetchProperties() {
		console.log('Fetching properties with filters:', filters);

		resultsContainer.innerHTML = '<p class="text-gray-600">Loading...</p>';

		const formData = new FormData();
		Object.entries(filters).forEach(([key, val]) => {
			if (Array.isArray(val)) {
				val.forEach(v => formData.append(`${key}[]`, v));
			} else if (val !== null && val !== '') {
				formData.append(key, val);
			}
		});
		formData.append('action', 'filter_properties');

		fetch(gld_ajax.ajaxurl, {
			method: 'POST',
			body: formData,
		})
			.then(res => res.json())
			.then(data => {
				console.log('AJAX response:', data);
				if (data.success) {
					resultsContainer.innerHTML = data.data;

					const pageButtons = resultsContainer.querySelectorAll('.gld-pagination-btn');
					pageButtons.forEach(btn => {
						btn.addEventListener('click', e => {
							e.preventDefault();
							const page = parseInt(btn.dataset.page);
							if (!isNaN(page)) {
								filters.page = page;
								fetchProperties();
							}
						});
					});
				} else {
					resultsContainer.innerHTML = '<p class="text-gray-600">No results found.</p>';
				}
			})
			.catch(err => {
				console.error('AJAX fetch failed:', err);
			});
	}

	const applyBtn = wrapper.querySelector('.apply-filters');
	const resetBtn = wrapper.querySelector('.reset-filters');

	applyBtn?.addEventListener('click', e => {
		e.preventDefault();
		console.log('Apply button clicked');
		filters.page = 1;
		updateFiltersFromUI();
		fetchProperties();
	});

	resetBtn?.addEventListener('click', e => {
		e.preventDefault();
		console.log('Reset button clicked');
		wrapper.querySelectorAll('input[type="checkbox"]').forEach(cb => (cb.checked = false));
		filters = {
			sale_type: [],
			property_type: [],
			property_area: [],
			min_price: null,
			max_price: null,
			min_size: null,
			max_size: null,
			page: 1,
		};
		fetchProperties();
	});

	// Initial load
	fetchProperties();
}
