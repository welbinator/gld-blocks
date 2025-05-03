<?php

add_action('wp_ajax_nopriv_filter_properties', 'gld_blocks_handle_ajax_filter');
add_action('wp_ajax_filter_properties', 'gld_blocks_handle_ajax_filter');

/**
 * Render a single property card.
 */
function gld_blocks_render_property_card($post_id) {
	$title    = esc_html(get_the_title($post_id));
	$url      = esc_url(get_permalink($post_id));
	$img      = get_the_post_thumbnail_url($post_id, 'large') ?: 'https://via.placeholder.com/600x400?text=No+Image';
	$price    = get_post_meta($post_id, 'property_price', true);
	$display_price = $price ? esc_html($price) : 'N/A';
	$size     = esc_html(get_post_meta($post_id, 'square_footage', true));
	$address  = esc_html(get_post_meta($post_id, 'property_address', true));
	$saleType = wp_get_post_terms($post_id, 'sale_type');
	$propType = wp_get_post_terms($post_id, 'property_type');

	$type_label = !empty($propType) ? esc_html($propType[0]->name) : '';
    $type_icon  = '<svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path><path d="M10 6h4"></path><path d="M10 10h4"></path><path d="M10 14h4"></path><path d="M10 18h4"></path></svg>';

    switch (strtolower($type_label)) {
        case 'industrial':
            $type_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-warehouse h-4 w-4 mr-2"><path d="M22 8.35V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8.35A2 2 0 0 1 3.26 6.5l8-3.2a2 2 0 0 1 1.48 0l8 3.2A2 2 0 0 1 22 8.35Z"></path><path d="M6 18h12"></path><path d="M6 14h12"></path><rect width="12" height="12" x="6" y="10"></rect></svg>';
            break;
        case 'retail':
            $type_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-store h-4 w-4 mr-2"><path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"></path><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"></path><path d="M2 7h20"></path><path d="M22 7v3a2 2 0 0 1-2 2v0a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 16 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 12 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 8 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 4 12v0a2 2 0 0 1-2-2V7"></path></svg>';
            break;
        case 'office':
            $type_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building h-4 w-4 mr-2"><rect width="16" height="20" x="4" y="2" rx="2" ry="2"></rect><path d="M9 22v-4h6v4"></path><path d="M8 6h.01"></path><path d="M16 6h.01"></path><path d="M12 6h.01"></path><path d="M12 10h.01"></path><path d="M12 14h.01"></path><path d="M16 10h.01"></path><path d="M16 14h.01"></path><path d="M8 10h.01"></path><path d="M8 14h.01"></path></svg>';
            break;
    }

	ob_start();
	?>
	<div class="rounded-lg border bg-card text-card-foreground shadow-sm overflow-hidden transition-all duration-300 hover:shadow-lg">
		<div class="relative h-64">
			<img src="<?php echo esc_url($img); ?>" alt="<?php echo $title; ?>" class="object-cover w-full h-full" />
			<?php if (!empty($saleType)) : ?>
				<div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold text-white absolute top-4 left-4 bg-red-600 hover:bg-red-700">
					<?php echo esc_html($saleType[0]->name); ?>
				</div>
			<?php endif; ?>
			<?php if (get_post_meta($post_id, 'property_featured', true)) : ?>
				<div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold text-white absolute top-4 right-4 bg-gray-900">
					Featured
				</div>
			<?php endif; ?>
		</div>
		<div class="p-6 pt-6">
			<h3 class="text-xl font-semibold mb-2 line-clamp-2"><?php echo $title; ?></h3>

			<div class="flex items-center text-gray-600 mb-2">
				<svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
				<span class="text-sm line-clamp-1"><?php echo $address; ?></span>
			</div>

			<?php if (!empty($type_label)) : ?>
				<div class="flex items-center text-gray-600 mb-2">
					<?php echo $type_icon; ?>
					<span class="text-sm"><?php echo $type_label; ?></span>
				</div>
			<?php endif; ?>

			<div class="flex items-center text-gray-600 mb-2">
				<svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/></svg>
				<span class="text-sm"><?php echo $size; ?> SF</span>
			</div>

			<div class="mt-4">
				<p class="text-xl font-bold text-red-600"><?php echo $display_price; ?></p>
			</div>

			<?php $excerpt = get_the_excerpt($post_id); if ($excerpt) : ?>
				<p class="mt-3 text-gray-600 text-sm line-clamp-2"><?php echo esc_html($excerpt); ?></p>
			<?php endif; ?>
		</div>
		<div class="flex items-center p-6 pt-0">
			<a href="<?php echo $url; ?>" class="inline-flex items-center justify-center h-10 px-4 py-2 w-full bg-gray-900 hover:bg-gray-800 text-white rounded-md text-sm font-medium">
				View Details
			</a>
		</div>
	</div>
	<?php
	return ob_get_clean();
}




/**
 * Block render callback.
 */
function gld_blocks_render_filter_properties($attributes, $content) {
	ob_start();
	?>
	<div id="gld-filter-properties-wrapper">
		<main class="min-h-screen">
			<div class="bg-white min-h-screen">
				
				<div class="container mx-auto px-4 py-12">
					<div class="flex flex-col lg:flex-row gap-8">
						<!-- Sidebar filters -->
						<div class="lg:w-1/4">
							<div class="bg-white border border-gray-200 rounded-lg p-6">
								<h2 class="text-xl font-bold mb-6">Filter Properties</h2>
								<?php
								foreach ([
									'sale_type'      => 'Sale Type',
									'property_type'  => 'Property Type',
									'property_area'  => 'Area',
								] as $taxonomy => $label) {
									$terms = get_terms(['taxonomy' => $taxonomy, 'hide_empty' => false]);
									if (!is_wp_error($terms) && !empty($terms)) {
										echo "<div class='border-b pb-4 mb-4'><h3 class='text-lg font-semibold mb-2'>{$label}</h3><div class='space-y-2'>";
										foreach ($terms as $term) {
											$slug = esc_attr($term->slug);
											$name = esc_html($term->name);
											echo "<div class='flex items-center'><input type='checkbox' class='filter-taxonomy' data-tax='{$taxonomy}' data-slug='{$slug}' id='{$taxonomy}-{$slug}' /><label for='{$taxonomy}-{$slug}' class='ml-2 text-gray-700'>{$name}</label></div>";
										}
										echo "</div></div>";
									}
								}
								?>
								<div class="mt-8 space-y-4">
									<button class="apply-filters w-full h-10 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md text-sm font-medium">Apply Filters</button>
									<button class="reset-filters w-full h-10 px-4 py-2 border border-input bg-background hover:bg-accent text-sm font-medium rounded-md">Reset Filters</button>
								</div>
							</div>
						</div>
						<!-- Property Grid -->
						<div class="lg:w-3/4">
							<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
								
								<div class="flex items-center">
									<label for="sort" class="mr-2 text-gray-700">Sort by:</label>
									<select id="sort" class="border border-gray-300 rounded-md px-3 py-1.5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-red-600">
										<option value="newest">Newest</option>
										<option value="price-high">Price (High to Low)</option>
										<option value="price-low">Price (Low to High)</option>
										<option value="size-high">Size (High to Low)</option>
										<option value="size-low">Size (Low to High)</option>
									</select>
								</div>
							</div>
							<div class="gld-property-results grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
								<?php
								$initial_query = new WP_Query([
									'post_type'      => 'gld_property',
									'post_status'    => 'publish',
									'posts_per_page' => 6,
								]);
								if ($initial_query->have_posts()) {
									while ($initial_query->have_posts()) {
										$initial_query->the_post();
										echo gld_blocks_render_property_card(get_the_ID());
									}
									wp_reset_postdata();
								} else {
									echo '<p class="text-gray-600">No properties found.</p>';
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			if (typeof gldPropertyFiltersInit === 'function') {
				gldPropertyFiltersInit();
			}
		});
	</script>
	<?php
	return ob_get_clean();
}

/**
 * AJAX handler.
 */
function gld_blocks_handle_ajax_filter() {
	$paged = isset($_POST['page']) ? max(1, intval($_POST['page'])) : 1;
	$args = [
		'post_type'      => 'gld_property',
		'post_status'    => 'publish',
		'posts_per_page' => 6,
		'paged'          => $paged,
		'meta_query'     => [],
		'tax_query'      => [],
	];

	foreach (['sale_type', 'property_type', 'property_area'] as $taxonomy) {
		if (!empty($_POST[$taxonomy])) {
			$args['tax_query'][] = [
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => array_map('sanitize_text_field', $_POST[$taxonomy]),
			];
		}
	}

	foreach (['price' => 'property_price', 'size' => 'square_footage'] as $key => $meta_key) {
		$min = $_POST["min_$key"] ?? null;
		$max = $_POST["max_$key"] ?? null;
		if ($min || $max) {
			$range = ['key' => $meta_key, 'type' => 'NUMERIC'];
			if ($min) $range['value'][] = floatval($min);
			if ($max) $range['value'][] = floatval($max);
			$range['compare'] = count($range['value']) === 2 ? 'BETWEEN' : (isset($min) ? '>=' : '<=');
			$args['meta_query'][] = $range;
		}
	}

	$query = new WP_Query($args);
	ob_start();

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			echo gld_blocks_render_property_card(get_the_ID());
		}
		$total_pages = $query->max_num_pages;
		echo '<div class="flex justify-center mt-12"><div class="flex items-center space-x-2">';
		for ($i = 1; $i <= $total_pages; $i++) {
			printf(
				'<button class="gld-pagination-btn inline-flex items-center justify-center border border-gray-300 text-sm px-4 py-2 rounded-md %s" data-page="%d">%d</button>',
				($i === $paged ? 'bg-red-600 text-white' : ''),
				$i,
				$i
			);
		}
		echo '</div></div>';
	} else {
		echo '<p class="text-gray-600">No properties found matching your filters.</p>';
	}

	wp_reset_postdata();
	wp_send_json_success(ob_get_clean());
}
